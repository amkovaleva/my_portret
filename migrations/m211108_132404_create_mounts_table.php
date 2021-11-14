<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mounts}}`.
 */
class m211108_132404_create_mounts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mounts}}', [
            'id' => $this->primaryKey(),
            'colour_id' => $this->integer()->notNull(),
            'portrait_format_id' => $this->integer()->notNull()->defaultValue(1),
            'frame_format_id' => $this->integer()->notNull()->defaultValue(1),
            'add_length' => $this->smallInteger(2)->notNull(),
            'add_width' => $this->smallInteger(2)->notNull()
        ]);
        $this->addForeignKey(
            'fk-mounts-colour_id',
            '{{%mounts}}',
            'colour_id',
            '{{%colours}}',
            'id'
        );
        $this->addForeignKey(
            'fk-mounts-format_id',
            '{{%mounts}}',
            'portrait_format_id',
            '{{%formats}}',
            'id'
        );
        $this->addForeignKey(
            'fk-mounts-frame_format_id',
            '{{%mounts}}',
            'frame_format_id',
            '{{%formats}}',
            'id'
        );

        $this->insert(
            '{{%mounts}}',
            [
                'colour_id' => 1,
                'portrait_format_id' => 2,
                'frame_format_id' => 3,
                'add_length' => 5,
                'add_width' => 5
            ]
        );
        $this->insert(
            '{{%mounts}}',
            [
                'colour_id' => 2,
                'portrait_format_id' => 2,
                'frame_format_id' => 3,
                'add_length' => 5,
                'add_width' => 5
            ]
        );


        $this->createTable('{{%background_colors}}', [
            'id' => $this->primaryKey(),
            'colour_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-background_colors-colour_id',
            '{{%background_colors}}',
            'colour_id',
            '{{%colours}}',
            'id'
        );

        $this->insert( '{{%background_colors}}', [ 'colour_id' => 1]);
        $this->insert( '{{%background_colors}}', [ 'colour_id' => 3]);
        $this->insert( '{{%background_colors}}', [ 'colour_id' => 4]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mounts}}');
        $this->dropTable('{{%background_colors}}');
    }
}
