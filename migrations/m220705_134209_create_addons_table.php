<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%addons}}`.
 */
class m220705_134209_create_addons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%addons}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue(''),
            'name_en' => $this->string()->notNull()->unique()->defaultValue(''),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'price_usd' => $this->decimal()->notNull()->defaultValue(0),
            'price_eur' => $this->decimal()->notNull()->defaultValue(0),
        ]);

        $this->insert('{{%addons}}',
            [
                'name' => 'Drawing Process Video',
                'name_en' => 'Drawing Process Video',
                'price' => 150,
                'price_usd' => 150,
                'price_eur' => 150
            ]);
        $this->insert('{{%addons}}',
            [
                'name' => 'Scanned Drawing Animation',
                'name_en' => 'Scanned Drawing Animation',
                'price' => 50,
                'price_usd' => 50,
                'price_eur' => 50,
            ]);
        $this->insert('{{%addons}}',
            [
                'name' => 'High Quality Scanned Drawing',
                'name_en' => 'High Quality Scanned Drawing',
                'price' => 20,
                'price_usd' => 20,
                'price_eur' => 20,
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%addons}}');
    }
}
