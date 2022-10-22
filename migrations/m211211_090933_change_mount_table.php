<?php

use yii\db\Migration;

/**
 * Class m211211_090933_change_mount_table
 */
class m211211_090933_change_mount_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%frame_mount_images}}', 'portrait_format_id', 'int(11)  not null');
        $this->addColumn('{{%frame_mount_images}}', 'colour_id', 'int(11)  not null');

        $this->addForeignKey(
            'fk-frame_mount_images-colour_id',
            '{{%frame_mount_images}}',
            'colour_id',
            '{{%colours}}',
            'id'
        );

        $this->addForeignKey(
            'fk-frame_mount_images-portrait_format_id',
            '{{%frame_mount_images}}',
            'portrait_format_id',
            '{{%formats}}',
            'id'
        );

        $this->execute('UPDATE frame_mount_images fmi
INNER JOIN mounts m ON fmi.mount_id = m.id
SET fmi.portrait_format_id = m.portrait_format_id, fmi.colour_id = m.colour_id');

        $this->dropForeignKey(
            'fk-frame_mount_images-mount_id',
            '{{%frame_mount_images}}'
        );
        $this->dropForeignKey(
            'fk-frame_mount_images-frame_id',
            '{{%frame_mount_images}}'
        );
        $this->dropIndex(
            'ind-frame_mount_images-unique',
            '{{%frame_mount_images}}'
        );

        $this->dropForeignKey(
            'fk-cart_items-mount_id',
            '{{%cart_items}}'
        );

        $this->dropColumn(
            '{{%frame_mount_images}}',
            'mount_id'
        );

        $this->createIndex(
            'ind-frame_mount_images-unique',
            '{{%frame_mount_images}}',
            ['portrait_format_id', 'colour_id', 'frame_id'],
            true
        );


        $this->addForeignKey(
            'fk-frame_mount_images-frame_id',
            '{{%frame_mount_images}}',
            'frame_id',
            '{{%frames}}',
            'id'
        );

        $this->dropTable('{{%mounts}}');
        $this->renameTable('{{%frame_mount_images}}', '{{%mounts}}');

        $this->addForeignKey(
            'fk-cart_items-mount_id',
            '{{%cart_items}}',
            'mount_id',
            '{{%mounts}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211211_090933_change_mount_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211211_090933_change_mount_table cannot be reverted.\n";

        return false;
    }
    */
}
