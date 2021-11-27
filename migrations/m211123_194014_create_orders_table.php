<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m211123_194014_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'portrait_type_id' => $this->integer()->notNull()->defaultValue(1),
            'format_id' => $this->integer()->notNull()->defaultValue(1),
            'material_id' => $this->integer()->notNull()->defaultValue(1),
            'base_id' => $this->integer()->notNull()->defaultValue(1),
            'frame_id' => $this->integer(),
            'faces_count' => $this->smallInteger(2)->notNull()->defaultValue(1),
            'mount_id' => $this->integer(),
            'background_color_id' => $this->integer()->notNull()->defaultValue(1),
            'imageFile' => $this->string()->notNull()->defaultValue(''),
            'cost' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'currency' => $this->string()->notNull()->defaultValue('ru'),
        ]);

        $this->addForeignKey(
            'fk-orders-background_color_id',
            '{{%orders}}',
            'background_color_id',
            '{{%background_colors}}',
            'id'
        );

        $this->addForeignKey(
            'fk-orders-mount_id',
            '{{%orders}}',
            'mount_id',
            '{{%mounts}}',
            'id'
        );

        $this->addForeignKey(
            'fk-orders-frame_id',
            '{{%orders}}',
            'frame_id',
            '{{%frames}}',
            'id'
        );

        $this->addForeignKey(
            'fk-orders-base_id',
            '{{%orders}}',
            'base_id',
            '{{%bg_materials}}',
            'id'
        );
        $this->addForeignKey(
            'fk-orders-material_id',
            '{{%orders}}',
            'material_id',
            '{{%paint_materials}}',
            'id'
        );
        $this->addForeignKey(
            'fk-orders-portrait_type_id',
            '{{%orders}}',
            'portrait_type_id',
            '{{%portrait_types}}',
            'id'
        );
        $this->addForeignKey(
            'fk-orders-format_id',
            '{{%orders}}',
            'format_id',
            '{{%formats}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}
