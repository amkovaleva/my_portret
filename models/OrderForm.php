<?php

namespace app\models;

use app\models\base\BackgroundColour;
use app\models\base\BackgroundMaterial;
use app\models\base\BaseImage;
use app\models\base\Colour;
use app\models\base\Format;
use app\models\base\Frame;
use app\models\base\FrameMountImage;
use app\models\base\Mount;
use app\models\base\PaintMaterial;
use app\models\base\PortraitType;
use app\models\base\Price;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * ContactForm is the model behind the contact form.
 */
class OrderForm extends BaseImage
{
    const UPLOAD_FOLDER = 'uploads/orders';

    const DEFAULT_PRICE = 1;
    const DEFAULT_PORTRAIT_COLOUR = 1;

    public $isMountPossible;
    public $frame_format_id;

    // <editor-fold state="collapsed" desc="base model description">

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{orders}}';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['portrait_type_id', 'format_id', 'material_id', 'base_id', 'background_color_id', 'imageFile', 'cost'], 'required'],
            [['frame_id', 'mount_id', 'frame_format_id'], 'integer'],
            [['cost'], 'number'],
            [['image'], 'file', 'mimeTypes' => 'image/*', 'maxSize' => 1024 * 1024 * 15], //15 Mb
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
            'mount_id' => Yii::t($lan_dir, 'mount'),
            'background_color_id' => Yii::t($lan_dir, 'background_color'),
            'cost' => Yii::t($lan_dir, 'cost'),
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

    // </editor-fold>

    /*
     * Приоритет заполнения данных
     * 1. portrait_type_id  - вид портрета
     * 2. base_id - на чем рисовать портрет
     * 3. material_id - чем рисовать
     * 4. format_id - какого размера рисунок
     * 5. Базовая стоимость
     * 6. frame_id && mount_id - по умолчанию без рамы => без паспарту.
     * 7. Итоговая стоимость
     * 8. background_color_id - цвет портрета - не зависит от других опций
     */
    public function fillDefaultModel()
    {
        $price = Price::find()->where(['id' => OrderForm::DEFAULT_PRICE])->with('backgroundMaterial')->one();
        $this->portrait_type_id = $price->portrait_type_id;
        $this->base_id = $price->bg_material_id;
        $this->material_id = $price->paint_material_id;
        $this->format_id = $price->format_id;
        $this->frame_format_id = $price->format_id;
        $this->cost = $price->price;
        $this->isMountPossible = $price->backgroundMaterial->is_mount;

        $this->background_color_id = OrderForm::DEFAULT_PORTRAIT_COLOUR;
    }

    // <editor-fold state="collapsed" desc="load of available order options">


    private function getFirstKey($list){
        foreach ($list as $key => $value) {
            return $key;
        }
        return null;
    }

    public function fillDownFrom($changeField, $value){

        $prop = OrderConsts::FIELD_NAMES[$changeField];
        $this->$prop = $value;

        $changeField++;

        $res = ['price' => 0, 'items' => []];
        while($changeField <= OrderConsts::FORMAT) {
            $prop = OrderConsts::FIELD_NAMES[$changeField];
            $loadMethod = OrderConsts::FIELD_LOAD_NAMES[$changeField];
            $list = $this->$loadMethod;

            $res['items'][] = ['id' => $prop, 'items' => $list, 'type' => OrderConsts::FIELD_TYPES[$changeField], 'prompt' => false];

            if (!isset($list[$this->$prop]))
                $this->$prop = $this->getFirstKey($list);

            $changeField++;
        }
        $price = Price::find()->where([
            'portrait_type_id' => $this->portrait_type_id,
            'paint_material_id' => $this->material_id,
            'bg_material_id' => $this->base_id,
            'format_id' => $this->format_id,
        ])->one();

        if($price)
            $res['price'] = $price->localPrice;
        return $res;
    }

    public function getAvailablePortraitTypes()
    {
        $list = PortraitType::find()->joinWith('prices', false, 'INNER JOIN')->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    public function getAvailableMaterials()
    {

        $list = PaintMaterial::find()->joinWith('prices', false, 'INNER JOIN')
            ->where([
                'prices.portrait_type_id' => $this->portrait_type_id,
            ])->asArray()->all();

        return ArrayHelper::map($list, 'id', 'name');
    }

    public function getAvailableBases()
    {

        $list = BackgroundMaterial::find()->joinWith('prices', false, 'INNER JOIN')
            ->where([
                'prices.portrait_type_id' => $this->portrait_type_id,
                'prices.paint_material_id' => $this->material_id,
            ])->asArray()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    public function getAvailableFormats()
    {

        $list = Format::find()->joinWith('prices', false, 'INNER JOIN')
            ->where([
                'prices.portrait_type_id' => $this->portrait_type_id,
                'prices.paint_material_id' => $this->material_id,
                'prices.bg_material_id' => $this->base_id,
            ])->asArray()->all();

        return ArrayHelper::map($list, 'id', function ($model) {
            return $model['width'] . 'x' . $model['length'];
        });
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
        $list = FrameMountImage::find()->joinWith(['frame.format ff', 'mount m'], false, 'INNER JOIN')
            ->where(['m.portrait_format_id' => $this->format_id])
            ->select(['ff.id id', 'ff.width width', 'ff.length length'])->asArray()->all();

        array_unshift($list, ['id' => $withoutMount->id, 'width' => $withoutMount->width, 'length' => $withoutMount->length ]);

        return ArrayHelper::map($list, 'id', function ($model) {
            return $model['width'] . 'x' . $model['length'];
        });
    }

    public function getAvailableMounts()
    {
        $list = Mount::find()->joinWith('colour', false, 'INNER JOIN')->where(['portrait_format_id' => $this->format_id])
            ->select([Mount::tableName() . '.id id', Colour::tableName() . '.code code'])->asArray()->all();

        return ArrayHelper::map($list, 'id', 'code');
    }

    public function getAvailableFrames()
    {

        $list = Frame::find()->joinWith('colour', false, 'INNER JOIN')
            ->where(['format_id' => isset($this->frame_format_id) && $this->frame_format_id
                ? $this->frame_format_id : ( $this->mount_id ? $this->mount->frame_format_id : $this->format_id)])
            ->select([Frame::tableName() . '.id id', Colour::tableName() . '.code code'])->asArray()->all();

        return ArrayHelper::map($list, 'id', 'code');
    }

    // </editor-fold>

}
