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
            'name' => $this->string()->notNull()->unique()->defaultValue('Белый')
        ]);

        $this->createTable('{{%formats}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue('A4'),
            'length' => $this->smallInteger(2)->notNull()->defaultValue(40),
            'width' => $this->smallInteger(2)->notNull()->defaultValue(30)
        ]);
        $this->createIndex(
            'ind-formats-unique',
            '{{%formats}}',
            ['length', 'width'],
            true
        );

        $arr = array('Белый', 'Черный', 'Светло-серый', 'Темно-серый');
        foreach ($arr as &$value) {
            $this->insert(
                '{{%colours}}',
                ['name' => $value]
            );
        }
        $this->insert(
            '{{%formats}}',
            ['name' => 'A4', 'length' => 30, 'width' => 21 ]
        );
        $this->insert(
            '{{%formats}}',
            ['name' => 'A3', 'length' => 40, 'width' => 30 ]
        );
        $this->insert(
            '{{%formats}}',
            ['name' => 'A2', 'length' => 50, 'width' => 40 ]
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
