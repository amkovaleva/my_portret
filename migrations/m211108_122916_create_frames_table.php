<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%frames}}`.
 */
class m211108_122916_create_frames_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%frames}}', [
            'id' => $this->primaryKey(),
            'colour_id' => $this->integer()->notNull()->defaultValue(1),
            'format_id' => $this->integer()->notNull()->defaultValue(1),
            'width' => $this->smallInteger()->notNull()->defaultValue(2),
            'imageFile' => $this->string()->notNull()->defaultValue('')
        ]);
        $this->addForeignKey(
            'fk-frames-colour_id',
            '{{%frames}}',
            'colour_id',
            '{{%colours}}',
            'id'
        );
        $this->addForeignKey(
            'fk-frames-format_id',
            '{{%frames}}',
            'format_id',
            '{{%formats}}',
            'id'
        );

        $format_ids = array(1, 2, 3);
        $colour_ids = array(1, 2);
        $i = 1;
        foreach ($format_ids as &$f_id) {
            foreach ($colour_ids as &$c_id) {
                $this->insert('frames', ['format_id' => $f_id, 'colour_id' => $c_id, 'width' => 2, 'imageFile' => $i.'.png']);
                $i++;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('{{%frames}}');
    }
}
