<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart_items}}`.
 */
class m211123_194014_create_cart_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart_items}}', [
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
            'user_cookie' => $this->string()->notNull()->defaultValue(''),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-cart_items-background_color_id',
            '{{%cart_items}}',
            'background_color_id',
            '{{%background_colors}}',
            'id'
        );

        $this->addForeignKey(
            'fk-cart_items-mount_id',
            '{{%cart_items}}',
            'mount_id',
            '{{%mounts}}',
            'id'
        );

        $this->addForeignKey(
            'fk-cart_items-frame_id',
            '{{%cart_items}}',
            'frame_id',
            '{{%frames}}',
            'id'
        );

        $this->addForeignKey(
            'fk-cart_items-base_id',
            '{{%cart_items}}',
            'base_id',
            '{{%bg_materials}}',
            'id'
        );
        $this->addForeignKey(
            'fk-cart_items-material_id',
            '{{%cart_items}}',
            'material_id',
            '{{%paint_materials}}',
            'id'
        );
        $this->addForeignKey(
            'fk-cart_items-portrait_type_id',
            '{{%cart_items}}',
            'portrait_type_id',
            '{{%portrait_types}}',
            'id'
        );
        $this->addForeignKey(
            'fk-cart_items-format_id',
            '{{%cart_items}}',
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
        $this->dropTable('{{%cart_items}}');
    }
}
