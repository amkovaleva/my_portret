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
            'width' => $this->decimal(5, 2)->notNull()->defaultValue(2),
            'name' => $this->string()->notNull()->defaultValue('')->unique(),
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

        $format_ids = array(1, 2, 3, 4);
        $format_names = array('A4', 'A3', 'A2', 'A1');
        $colour_ids = array(1, 2);
        $colour_names = array('Белая', 'Черная');
        $i = 1;
        foreach ($format_ids as &$f_id) {
            foreach ($colour_ids as &$c_id) {
                $this->insert('frames',
                    ['format_id' => $f_id, 'colour_id' => $c_id, 'width' => 1.5, 'imageFile' => $i.'.svg',
                        'name' => $colour_names[$c_id - 1] . ' ' . $format_names[$f_id - 1]]);
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
