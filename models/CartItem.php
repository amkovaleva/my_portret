<?php

namespace app\models;

use app\models\base\Addon;
use app\models\base\BackgroundColour;
use app\models\base\BackgroundMaterial;
use app\models\base\BaseImage;
use app\models\base\Colour;
use app\models\base\CountFace;
use app\models\base\Currency;
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

    const DEFAULT_PORTRAIT_COLOUR = 3;

    public $frame_format_id;
    public $crop_data;
    public $addon_ids;

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
            [['frame_id', 'mount_id', 'frame_format_id', 'crop_data', 'addon_ids'], 'safe'],
            [['cost', 'faces_count'], 'number'],
            [['currency'], 'string'],
            [['created_at'], 'datetime','on'=>'insert'],
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
            'portrait_type_id' => Yii::t($lan_dir, 'portrait_type_id'),
            'material_id' => Yii::t($lan_dir, 'material_id'),
            'base_id' => Yii::t($lan_dir, 'base_id'),
            'format_id' => Yii::t($lan_dir, 'format_id'),
            'frame_id' => Yii::t($lan_dir, 'frame'),
            'faces_count' => Yii::t($lan_dir, 'faces_count'),
            'frame_format_id' => Yii::t($lan_dir, 'frame_format'),
            'mount_id' => Yii::t($lan_dir, 'mount'),
            'background_color_id' => Yii::t($lan_dir, 'background_color_id'),
            'cost' => Yii::t($lan_dir, 'cost'),
            'currency' => Yii::t($lan_dir, 'currency'),
        ];
    }
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $choose_addon_ids = $this->addon_ids;

        foreach ($this->addons as $addon){

            if(!in_array($addon->id, $choose_addon_ids))
                $addon->delete();
            else
                unset($choose_addon_ids[array_search($addon->id, $choose_addon_ids)]);
        }

        foreach ($choose_addon_ids as $addon_id){
            $link = new OrderAddon();
            $link->cart_item_id = $this->id;
            $link->addon_id = $addon_id;
            $link->save();
        }
    }

    // </editor-fold>

    // <editor-fold state="collapsed" desc="load relative objects">

    public function getAddons()
    {
        return $this->hasMany(Addon::class, ['id' => 'addon_id'])->viaTable(OrderAddon::tableName(), ['cart_item_id' => 'id']);
    }

    public function getAddonsString()
    {
        return implode( ArrayHelper::getColumn(ArrayHelper::toArray($this->addons), 'name'),'; ');
    }


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

        if (!$this->mount_id)
            return Yii::$app->request->baseUrl . '/' . Frame::UPLOAD_FOLDER . $this->frame_id . '.svg';

        return Yii::$app->request->baseUrl . '/' . Mount::UPLOAD_FOLDER . $this->mount_id . '.svg';
    }


    public function getPriceStr()
    {
        return Currency::getPriceStr($this->cost, $this->currency);
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
        $this->currency = Currency::getDefaultCurrency();
        $this->cost = Currency::getLocalPrice($price, $this->currency);
        $this->faces_count = 1;

        $this->background_color_id = CartItem::DEFAULT_PORTRAIT_COLOUR;
        $this->frame_format_id = $this->format_id;
        $this->mount_id = 0;

        if ($this->backgroundMaterial->is_mount) {
            $mount_info = Mount::getDefaultOrderObject($this->format_id);
            if ($mount_info) {
                $this->frame_format_id = $mount_info['frame_format_id'];
                $this->frame_id = $mount_info['frame_id'];
                $this->mount_id = $mount_info['id'];
                return;
            }
        }
        $this->frame_id = Frame::find()->where(['format_id' => $this->frame_format_id])->orderBy('colour_id DESC')->one()->id;
    }

    // <editor-fold state="collapsed" desc="load of available order options">


    private function getKey($list, $is_first = true)
    {
        $array = $is_first ? $list : array_reverse($list, true);

        foreach ($array as $key => $value) {
            return $key;
        }
        return null;
    }

    private function translateList($list)
    {
        $res = [];
        foreach ($list as &$item)
            $res[$item->id] = $item->transName;
        return $res;
    }

    public function fillDownFrom($changeField, $value)
    {

        $prop = OrderConsts::FIELD_NAMES[$changeField];
        $this->$prop = $value;
        $isCountFacesChanged = $changeField == OrderConsts::FACES;

        $changeField++;

        $res = ['render' => []];
        if (!$isCountFacesChanged)
            while ($changeField <= OrderConsts::MOUNT) {
                $prop = OrderConsts::FIELD_NAMES[$changeField];
                $loadMethod = OrderConsts::FIELD_LOAD_NAMES[$changeField];
                $list = $this->$loadMethod;

                $res['render'][] = [
                    'list' => $list,
                    'field_index' => $changeField,
                    ];

                if (!isset($list[$this->$prop]))
                    $this->$prop = $this->getKey($list, !in_array($changeField, [OrderConsts::FRAME_FORMAT, OrderConsts::FRAME]));


                $changeField++;
            }
        $price = Price::getPriceForCartItem($this);

        if ($price) {
            $this->cost = Currency::getLocalPrice($price, $this->currency);
            if ($this->faces_count > 1) {
                $coeff = CountFace::getCoefficient($this->faces_count);
                $this->cost *= $coeff;
            }
        }
        $res['model'] = $this;
        $res['object'] = $this->attributes;
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

    public function getAvailableFormats()
    {
        $cur = $this->currency;
        $list = Format::find()->joinWith('prices', false, 'INNER JOIN')
            ->where([
                'prices.portrait_type_id' => $this->portrait_type_id,
                'prices.paint_material_id' => $this->material_id,
                'prices.bg_material_id' => $this->base_id,
            ])//->groupBy([Format::tableName().'.id', 'prices.portrait_type_id', 'prices.paint_material_id', 'prices.bg_material_id'])
            ->select([Format::tableName() . '.id', 'width', 'length', 'max_faces', 'price', 'price_usd', 'price_eur'])
            ->asArray()->all();

        $res = [];
        foreach ($list as & $format) {
            $coeff = CountFace::getCoefficient($format['max_faces']);

            $res[$format['id']] = [$format['width'] . 'x' . $format['length'] . ' cm'];

            $prices = array_map(function ($currency) use ($format, $coeff) {
                $price = $format[Currency::CURRENCY_PROP[$currency]];
                return Currency::getPriceStr(1 * $price, $currency) . ' - ' . Currency::getPriceStr($coeff * $price, $currency);
            }, Currency::CURRENCIES);
            $prices = array_combine(Currency::CURRENCIES, $prices);

            $res[$format['id']][] = $prices[$cur];
            $res[$format['id']][] = $prices;
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
                Format::tableName() . '.id' => $this->format_id,
            ])
            ->select(['max_faces', 'price', 'price_usd', 'price_eur'])
            ->asArray()->one();

        $coefs = CountFace::find()->where('max <= ' . $format['max_faces'])->asArray()->all();
        $res = [];
        for ($i = 1; $i <= $format['max_faces']; $i++) {
            foreach ($coefs as &$coef) {
                if ($coef['max'] == $i) {
                    $coefficient = $coef['coefficient'];
                    $res[$i] = [$i];

                    $prices = array_map(function ($currency) use ($format, $coefficient) {
                        return Currency::getPriceStr($coefficient * $format[Currency::CURRENCY_PROP[$currency]], $currency);
                    }, Currency::CURRENCIES);
                    $prices = array_combine(Currency::CURRENCIES, $prices);

                    $res[$i][] = $prices[$this->currency];
                    $res[$i][] = $prices;
                    break;
                }
            }
        }
        return $res;
    }

    public function getAvailableBgColours()
    {
        $list = BackgroundColour::find()->joinWith('colour')->all();
        return Colour::prepareListForView($list);
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
        array_unshift($list, ['id' => 0, 'width' => 0, 'length' => 0]);

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
            $list = Frame::find()->joinWith('colour', true, 'INNER JOIN')
                ->joinWith('colour', false, 'INNER JOIN')
                ->where(['format_id' => $this->frame_format_id])->all();
        else
            $list = Mount::find()->joinWith('frame.colour', true, 'INNER JOIN')
                ->where(['format_id' => $this->frame_format_id])->all();

        return Colour::prepareListForView($list, $with_mount ? 'frame_id' : 'id');

    }

    public function getAvailableMounts()
    {

        if (!$this->frame_format_id)
            return [];

        $with_mount = $this->frame_format_id != $this->format_id;
        if (!$with_mount)
            return [];

        $list = Mount::find()->joinWith('colour', true, 'INNER JOIN')
            ->joinWith('frame', false, 'INNER JOIN')
            ->where(['frame_id' => $this->frame_id, 'portrait_format_id' => $this->format_id, 'format_id' => $this->frame_format_id])->all();


        return Colour::prepareListForView($list);
    }


    // </editor-fold>


    public static function getCartItemsForUser()
    {
        $item = CartItem::find()->where(['user_cookie' => Yii::$app->params['cookie_value']])
            ->with(['frame.colour', 'frame.format', 'mount.colour', 'format', 'portraitType', 'backgroundMaterial', 'paintMaterial', 'backgroundColour.colour'])
            ->orderBy(CartItem::tableName(). '.id DESC')->one();

        if(Order::find()->where(['cart_item_id' => $item->id])->exists())
            return null;
        return $item;
    }


    public function getPortraitOptions($for_admin = false){
        $trans_dir = 'app/carts';
        $item = $this;
        $format_field_name = $for_admin ? 'name' : 'sizesStr';

        $options = [
            Yii::t($trans_dir, 'portrait_type_id') => $item->portraitType->transName,
            Yii::t($trans_dir, 'material_id') => $item->paintMaterial->transName,
            Yii::t($trans_dir, 'base_id') => $item->backgroundMaterial->transName,
            Yii::t($trans_dir, 'format_id') => $item->format->$format_field_name,
            Yii::t($trans_dir, 'background_color_id') => $item->backgroundColour->colour->transName,
            Yii::t($trans_dir, 'faces_count') => $item->faces_count
        ];
        if($for_admin)
            $options[] = null;

        if($item->frame){
            $options[Yii::t($trans_dir, 'frame_format_id')] = $item->frame->format->$format_field_name;
            $options[Yii::t($trans_dir, 'frame_id')] = $item->frame->colour->transName;

            if($item->mount){
                $options[Yii::t($trans_dir, 'mount_id')] = $item->mount->colour->transName;
            }
        }
        else
            $options[Yii::t($trans_dir, 'frame_format_id')] = Yii::t($trans_dir, 'no_frame');

        if($for_admin)
            $options[] = null;

        $addons = $item->addons;
        foreach ($addons as $addon) {
            $options[$addon->transName] = Currency::getPriceStr(Currency::getLocalPrice($addon), $item->currency);
        }
        return $options;
    }

}
