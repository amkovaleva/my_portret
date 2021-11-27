<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%count_faces}}`.
 */
class m211123_100125_create_count_faces_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%count_faces}}', [
            'id' => $this->primaryKey(),
            'min' => $this->smallInteger(),
            'max' => $this->smallInteger(),
            'coefficient' => $this->decimal(5, 2),
        ]);

        $this->insert('{{%count_faces}}', [
            'min' => 1,
            'max' => 1,
            'coefficient' => 1,
        ]);
        $this->insert('{{%count_faces}}', [
            'min' => 2,
            'max' => 2,
            'coefficient' => 1.5,
        ]);
        $this->insert('{{%count_faces}}', [
            'min' => 3,
            'max' => 3,
            'coefficient' => 1.8,
        ]);
        $this->insert('{{%count_faces}}', [
            'min' => 4,
            'max' => 4,
            'coefficient' => 2,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%count_faces}}');
    }
}
