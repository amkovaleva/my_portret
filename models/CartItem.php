<?php

namespace app\models;

use app\models\base\BackgroundColour;
use app\models\base\BackgroundMaterial;
use app\models\base\BaseImage;
use app\models\base\Colour;
use app\models\base\CountFace;
use app\models\base\Format;
use app\models\base\Frame;
use app\models\base\Mount;
use app\models\base\PaintMaterial;
use app\models\base\PortraitType;
use app\models\base\Price;
use Yii;
use yii\helpers\ArrayHelper;


class CartItem extends BaseImage
{
    const UPLOAD_FOLDER = 'uploads/orders/';

    const DEFAULT_PORTRAIT_COLOUR = 1;

    public $frame_format_id;
    public $crop_data;

    // <editor-fold state="collapsed" desc="base model description">

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{cart_items}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['portrait_type_id', 'format_id', 'material_id', 'base_id', 'background_color_id',
                'imageFile', 'cost', 'currency', 'faces_count', 'user_cookie'], 'required'],
            [['frame_id', 'mount_id', 'frame_format_id', 'crop_data'], 'safe'],
            [['cost', 'faces_count'], 'number'],
            [['currency'], 'string'],
            [['created_at'], 'datetime'],
            [['image'], 'file', 'extensions' => 'JPG, JPEG, PNG, BMP, WebP', //mimeTypes' => 'image/*',
                 'maxSize' => 1024 * 1024 * 15], //15 Mb
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        $lan_dir = 'app/orders';
        return [
            'portrait_type_id' => Yii::t($lan_dir, 'portrait_type'),
            'material_id' => Yii::t($lan_dir, 'material'),
            'base_id' => Yii::t($lan_dir, 'base'),
            'format_id' => Yii::t($lan_dir, 'format'),
            'frame_id' => Yii::t($lan_dir, 'frame'),
            'faces_count' => Yii::t($lan_dir, 'faces_count'),
            'frame_format_id' => Yii::t($lan_dir, 'frame_format'),
            'mount_id' => Yii::t($lan_dir, 'mount'),
            'background_color_id' => Yii::t($lan_dir, 'background_color'),
            'cost' => Yii::t($lan_dir, 'cost'),
            'currency' => Yii::t($lan_dir, 'currency'),
        ];
    }
    // </editor-fold>

    // <editor-fold state="collapsed" desc="load relative objects">

    public function getMount()
    {
        return $this->hasOne(Mount::class, ['id' => 'mount_id']);
    }

    public function getFrame()
    {
        return $this->hasOne(Frame::class, ['id' => 'frame_id']);
    }

    public function getFormat()
    {
        return $this->hasOne(Format::class, ['id' => 'format_id']);
    }

    public function getBackgroundMaterial()
    {
        return $this->hasOne(BackgroundMaterial::class, ['id' => 'base_id']);
    }

    public function getPaintMaterial()
    {
        return $this->hasOne(PaintMaterial::class, ['id' => 'material_id']);
    }

    public function getPortraitType()
    {
        return $this->hasOne(PortraitType::class, ['id' => 'portrait_type_id']);
    }

    public function getBackgroundColour()
    {
        return $this->hasOne(BackgroundColour::class, ['id' => 'background_color_id']);
    }

    public function getFrameImageUrl()
    {
        if (!$this->frame_id)
            return '';

        if(!$this->mount_id)
            return Yii::$app->request->baseUrl . '/' . Frame::UPLOAD_FOLDER . $this->frame_id . '.svg';

        return Yii::$app->request->baseUrl . '/' . Mount::UPLOAD_FOLDER .  $this->mount_id . '.svg';
    }


    public function getPriceStr(){
        return Price::getPriceStr($this->cost, $this->currency) ;
    }

    public function getImgName()
    {
        return $this->user_cookie . '_' . (!$this->id ? '0' : $this->id);
    }

    // </editor-fold>

    public function fillDefaultModel($portrait_type_id)
    {

        $this->user_cookie = Yii::$app->params['cookie_value'];

        $price = Price::find()->where(['id' => Yii::$app->params['prices_by_default'][$portrait_type_id - 1]])
            ->with(['backgroundMaterial', 'portraitType'])->one();
        $this->portrait_type_id = $price->portrait_type_id;
        $this->base_id = $price->bg_material_id;
        $this->material_id = $price->paint_material_id;
        $this->format_id = $price->format_id;
        $this->currency = Price::getDefaultCurrency();
        $this->cost = $price->getLocalPrice($this->currency);
        $this->faces_count = 1;

        $this->background_color_id = CartItem::DEFAULT_PORTRAIT_COLOUR;

        $mount_info = Mount::getDefaultOrderObject($this->format_id);
        if(!$mount_info)
            return;

        $this->frame_format_id = $mount_info['frame_format_id'];
        $this->frame_id = $mount_info['frame_id'];
        $this->mount_id = $mount_info['id'];
    }

    // <editor-fold state="collapsed" desc="load of available order options">


    private function getFirstKey($list)
    {
        foreach ($list as $key => $value) {
            return $key;
        }
        return null;
    }

    public function fillDownFrom($changeField, $value)
    {

        $prop = OrderConsts::FIELD_NAMES[$changeField];
        $this->$prop = $value;
        $isCountFacesChanged = $changeField == OrderConsts::FACES;

        $changeField++;

        $res = ['object' => null, 'items' => []];
        if (!$isCountFacesChanged)
            while ($changeField <= OrderConsts::MOUNT) {
                $prop = OrderConsts::FIELD_NAMES[$changeField];
                $loadMethod = OrderConsts::FIELD_LOAD_NAMES[$changeField];
                $list = $this->$loadMethod;

                $res['items'][] = ['id' => $prop, 'items' => $list, 'type' => OrderConsts::FIELD_TYPES[$changeField],
                    'prompt' => OrderConsts::getFieldPrompt($changeField),
                    'is_colour' => OrderConsts::FIELD_IS_COLOUR[$changeField]];

                if (!isset($list[$this->$prop]) && ($this->$prop || !OrderConsts::getFieldPrompt($changeField)))
                    $this->$prop = $this->getFirstKey($list);

                $changeField++;
            }
        $price = Price::find()->where([
            'portrait_type_id' => $this->portrait_type_id,
            'paint_material_id' => $this->material_id,
            'bg_material_id' => $this->base_id,
            'format_id' => $this->format_id,
        ])->one();

        if ($price) {
            $this->cost = $price->getLocalPrice($this->currency);
            if ($this->faces_count > 1) {
                $coeff = CountFace::getCoefficient($this->faces_count);
                $this->cost *= $coeff;
            }
        }
        $res['object'] = $this->attributes;
        $res['object']['frame_format_id'] = $this->frame_format_id;
        $res['object']['frame_img'] = $this->frameImageUrl;

        return $res;
    }

    public function getAvailablePortraitTypes()
    {
        $list = PortraitType::find()->joinWith('prices', false, 'INNER JOIN')->all();
        return $this->translateList($list);
    }

    public function getAvailableMaterials()
    {

        $list = PaintMaterial::find()->joinWith('prices', false, 'INNER JOIN')
            ->where([
                'prices.portrait_type_id' => $this->portrait_type_id,
            ])->all();

        return $this->translateList($list);
    }

    public function getAvailableBases()
    {

        $list = BackgroundMaterial::find()->joinWith('prices', false, 'INNER JOIN')
            ->where([
                'prices.portrait_type_id' => $this->portrait_type_id,
                'prices.paint_material_id' => $this->material_id,
            ])->all();

        return $this->translateList($list);
    }

    private  function translateList($list){
        $res = [];
        foreach ($list as &$item)
            $res[$item->id] = $item->transName;
        return $res;
    }

    public function getAvailableFormats()
    {
        $cur = $this->currency;
        $priceField = Price::CURRENCY_PROP[$cur];
        $list = Format::find()->joinWith('prices', false, 'INNER JOIN')
            ->where([
                'prices.portrait_type_id' => $this->portrait_type_id,
                'prices.paint_material_id' => $this->material_id,
                'prices.bg_material_id' => $this->base_id,
            ])//->groupBy([Format::tableName().'.id', 'prices.portrait_type_id', 'prices.paint_material_id', 'prices.bg_material_id'])
            ->select([Format::tableName().'.id', 'width', 'length', 'max_faces',
                $priceField. ' as price'])
            ->asArray()->all();

        $res = [];
        foreach($list as & $format){
            $coeff = CountFace::getCoefficient($format['max_faces']);

            $res[$format['id']] =  $format['width'] . 'x' . $format['length']
                . ' - ('. Price::getPriceStr(1 * $format['price'], $cur) . ' - '. Price::getPriceStr($coeff * $format['price'], $cur)
                . ') - '. Yii::t('app/orders', 'faces_to', $format['max_faces']);
        }
        return $res;
    }

    public function getAvailableFacesCounts()
    {
        $format = Format::find()->joinWith('prices', false, 'INNER JOIN')
            ->where([
                'prices.portrait_type_id' => $this->portrait_type_id,
                'prices.paint_material_id' => $this->material_id,
                'prices.bg_material_id' => $this->base_id,
                Format::tableName().'.id' => $this->format_id,
            ])
            ->select(['max_faces',  Price::CURRENCY_PROP[$this->currency]. ' as price'])
            ->asArray()->one();

        $coefs = CountFace::find()->where('max <= '.$format['max_faces'])->asArray()->all();
        $res = [];
        for ($i = 1; $i <= $format['max_faces']; $i++) {
            foreach ($coefs as &$coef){
                if($coef['max'] == $i){
                    $res[$i] = $i . ' - ' . Price::getPriceStr($coef['coefficient'] * $format['price'], $this->currency);
                    break;
                }
            }
        }
        return $res;
    }

    public function getAvailableBgColours()
    {
        $list = BackgroundColour::find()->joinWith('colour', false)
            ->select([BackgroundColour::tableName() . '.id id', Colour::tableName() . '.code code'])->asArray()->all();

        return ArrayHelper::map($list, 'id', 'code');
    }

    public function getAvailableFrameFormats()
    {
        $withoutMount = Format::findOne($this->format_id);
        $list = [];
        if ($this->backgroundMaterial->is_mount)
            $list = Mount::find()->joinWith(['frame.format ff'], false, 'INNER JOIN')
                ->where(['portrait_format_id' => $this->format_id])
                ->select(['ff.id id', 'ff.width width', 'ff.length length'])->asArray()->all();

        array_unshift($list, ['id' => $withoutMount->id, 'width' => $withoutMount->width, 'length' => $withoutMount->length]);

        return ArrayHelper::map($list, 'id', function ($model) {
            return $model['width'] . 'x' . $model['length'];
        });
    }

    public function getAvailableFrames()
    {
        if (!$this->frame_format_id || $this->frame_format_id == 0)
            return [];

        $with_mount = $this->frame_format_id != $this->format_id;

        if (!$with_mount)
            $list = Frame::find()->joinWith('colour', false, 'INNER JOIN')
                ->joinWith('colour', false, 'INNER JOIN')
                ->where(['format_id' => $this->frame_format_id])
                ->select([Frame::tableName() . '.id id', Colour::tableName() . '.code code'])->asArray()->all();
        else
            $list = Mount::find()->joinWith('frame.colour', false, 'INNER JOIN')
                ->where(['format_id' => $this->frame_format_id])
                ->select([Frame::tableName() . '.id id', Colour::tableName() . '.code code'])->asArray()->all();

        return ArrayHelper::map($list, 'id', 'code');
    }

    public function getAvailableMounts()
    {

        if (!$this->frame_format_id)
            return [];

        $with_mount = $this->frame_format_id != $this->format_id;
        if (!$with_mount)
            return [];

        $list = Mount::find()->joinWith('colour', false, 'INNER JOIN')
            ->joinWith('frame', false, 'INNER JOIN')
            ->where(['frame_id' => $this->frame_id, 'portrait_format_id' => $this->format_id, 'format_id' => $this->frame_format_id])
            ->select([Mount::tableName() . '.id id', Colour::tableName() . '.code code'])->asArray()->all();


        return ArrayHelper::map($list, 'id', 'code');
    }


    // </editor-fold>

    public static function getCartItemsForMenu(){

        if(!isset(Yii::$app->params['cookie_value']))
            return null;

        $count = CartItem::find()->where(['user_cookie' => Yii::$app->params['cookie_value']])->count();
        if(!$count)
            return null;
        return [ 'count' => $count];
    }

    public static function getCartItemsForUser(){
        return CartItem::find()->where(['user_cookie' => Yii::$app->params['cookie_value']])
            ->with(['frame.colour', 'frame.format', 'mount.colour', 'format', 'portraitType', 'backgroundMaterial', 'paintMaterial', 'backgroundColour.colour'])->all();
    }
}
