<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%formats}}`.
 */
class m211108_121706_create_formats_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%colours}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue('Белый'),
            'code' => $this->string()->notNull()->unique()->defaultValue('#fff')
        ]);

        $this->createTable('{{%formats}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue('A4'),
            'length' => $this->smallInteger(2)->notNull()->defaultValue(40),
            'width' => $this->smallInteger(2)->notNull()->defaultValue(30),
            'max_faces' => $this->smallInteger(2)->notNull()->defaultValue(1),
        ]);
        $this->createIndex(
            'ind-formats-unique',
            '{{%formats}}',
            ['length', 'width'],
            true
        );

        $arr = array(['Белый', '#fff'], ['Черный', '#000'], ['Серый', '#ABACAC '], ['Темно-серый', '#3A3939']);
        foreach ($arr as &$value) {
            $this->insert(
                '{{%colours}}',
                ['name' => $value[0], 'code' => $value[1]]
            );
        }
        $this->insert(
            '{{%formats}}',
            ['name' => 'A4', 'length' => 30, 'width' => 21, 'max_faces' => 2]
        );
        $this->insert(
            '{{%formats}}',
            ['name' => 'A3', 'length' => 40, 'width' => 30 , 'max_faces' => 4]
        );
        $this->insert(
            '{{%formats}}',
            ['name' => 'A2', 'length' => 50, 'width' => 40 , 'max_faces' => 4]
        );
        $this->insert(
            '{{%formats}}',
            ['name' => 'A1', 'length' => 70, 'width' => 50 , 'max_faces' => 0]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%formats}}');
        $this->dropTable('{{%colours}}');
    }
}
