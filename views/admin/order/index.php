<?php

use app\models\OrderConsts;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;

?>

<?= GridView::widget(['dataProvider' => $dataProvider, 'filterModel' => $searchModel,
    'columns' => [
        ['attribute' => 'photo', 'content' => function ($model, $key, $index, $column) {
            $preview = $model->previewPhotoUrl;
            $full = $model->fullPhotoUrl;

            return sprintf("<a href='%s'><img src='%s' class='photo_preview'></a>", $full, $preview);

        },], ['attribute' => 'portrait_base_info', 'content' => function ($model, $key, $index, $column) {
            $options = $model->getPortraitOptions(true);
            $rows = ['<dl>'];
            foreach ($options as $key => $option) {
                if(!$option)
                    $rows[] = '<hr>';
                else
                    $rows[] = sprintf('<dt> %s:</dt> <dd> %s; </dd>', $key, $option);
            }
            $rows[] = '</dl>';
            return implode($rows);

        },], ['attribute' => 'contact_info', 'content' => function ($model, $key, $index, $column) {
            $options = $model->contactInfo;
            $rows = ['<dl>'];
            foreach ($options as $key => $option) {
                $rows[] = sprintf('<dt> %s:</dt> <dd> %s; </dd>', $key, $option);
            }
            $rows[] = '</dl>';
            return implode($rows);

        },], ['attribute' => 'state', 'value' => 'stateName',
            'filter' => Select2::widget(['name' => 'SearchOrder[state]', 'data' => OrderConsts::stateNames(), 'value' => $searchModel->state,
                'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
                'pluginOptions' => ['allowClear' => false],])],
        ['attribute' => 'created_at', 'value' => 'cartItem.created_at', 'format' => ['date', 'php:d-m-Y H:i'],

        ],[
            'class' => 'yii\grid\ActionColumn',
            'template' => '{edit}',
            'contentOptions' => ['class' => 'action-column'],
            'buttons' => [
                'edit' => function ($url, $model, $key) {
                    return Html::a('&#9998;', $url);
                },
            ],
        ]]]); ?>
