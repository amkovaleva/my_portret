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
            'colour_id' => $this->integer()->notNull()->defaultValue(1),
            'portrait_format_id' => $this->integer()->notNull()->defaultValue(1),
            'frame_format_id' => $this->integer()->notNull()->defaultValue(1),
            'add_length' => $this->decimal(5, 2)->notNull()->defaultValue(1),
            'add_width' => $this->decimal(5, 2)->notNull()->defaultValue(1)
        ]);

        $this->createIndex(
            'ind-mounts-unique',
            '{{%mounts}}',
            ['colour_id', 'portrait_format_id', 'frame_format_id'],
            true
        );
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
            'colour_id' => $this->integer()->unique()->notNull()->defaultValue(1)
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


        $this->createTable('{{%frame_mount_images}}', [
            'id' => $this->primaryKey(),
            'mount_id' => $this->integer()->notNull()->defaultValue(1),
            'frame_id' => $this->integer()->notNull()->defaultValue(1),
            'imageFile' => $this->string()->notNull()->defaultValue('')
        ]);

        $this->createIndex(
            'ind-frame_mount_images-unique',
            '{{%frame_mount_images}}',
            ['mount_id', 'frame_id'],
            true
        );

        $this->addForeignKey(
            'fk-frame_mount_images-mount_id',
            '{{%frame_mount_images}}',
            'mount_id',
            '{{%mounts}}',
            'id'
        );
        $this->addForeignKey(
            'fk-frame_mount_images-frame_id',
            '{{%frame_mount_images}}',
            'frame_id',
            '{{%frames}}',
            'id'
        );
        $this->insert( '{{%frame_mount_images}}', [ 'frame_id' => 6, 'mount_id' => 2, 'imageFile' => '6_2.png']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%frame_mount_images}}');
        $this->dropTable('{{%mounts}}');
        $this->dropTable('{{%background_colors}}');
    }
}
