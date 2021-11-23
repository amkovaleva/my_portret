<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%types}}`.
 */
class m211108_134457_create_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bg_materials}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue('Бумага'),
            'is_mount' => $this->boolean()->notNull()->defaultValue(true)
        ]);
        $this->insert('{{%bg_materials}}', ['name' => 'Бумага', 'is_mount' => true]);
        $this->insert('{{%bg_materials}}', ['name' => 'Холст с подрамником', 'is_mount' => false]);

        $this->createTable('{{%paint_materials}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue('Карандаш')
        ]);

        $this->insert('{{%paint_materials}}', ['name' => 'Карандаш']);
        $this->insert('{{%paint_materials}}', ['name' => 'Масло']);

        $this->createTable('{{%portrait_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue('Портрет')
        ]);

        $this->insert('{{%portrait_types}}', ['name' => 'Гиперреализм']);
        $this->insert('{{%portrait_types}}', ['name' => 'Фотореализм']);
        $this->insert('{{%portrait_types}}', ['name' => 'Скетч']);


        $this->createTable('{{%prices}}', [
            'id' => $this->primaryKey(),
            'bg_material_id' => $this->integer()->notNull()->defaultValue(1),
            'paint_material_id' => $this->integer()->notNull()->defaultValue(1),
            'portrait_type_id' => $this->integer()->notNull()->defaultValue(1),
            'format_id' => $this->integer()->notNull()->defaultValue(1),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'price_usd' => $this->decimal()->notNull()->defaultValue(0),
            'price_eur' => $this->decimal()->notNull()->defaultValue(0),
        ]);


        $this->createIndex(
            'index-prices-unique',
            '{{%prices}}',
            ['bg_material_id', 'paint_material_id', 'portrait_type_id', 'format_id'],
            true
        );
        $this->addForeignKey(
            'fk-prices-format_id',
            '{{%prices}}',
            'format_id',
            '{{%formats}}',
            'id'
        );
        $this->addForeignKey(
            'fk-prices-portrait_type_id',
            '{{%prices}}',
            'portrait_type_id',
            '{{%portrait_types}}',
            'id'
        );
        $this->addForeignKey(
            'fk-prices-bg_material_id',
            '{{%prices}}',
            'bg_material_id',
            '{{%bg_materials}}',
            'id'
        );
        $this->addForeignKey(
            'fk-prices-paint_material_id',
            '{{%prices}}',
            'paint_material_id',
            '{{%paint_materials}}',
            'id'
        );

        $this->insert(
            '{{%prices}}',
            [
                'bg_material_id' => 1,
                'paint_material_id' => 2,
                'portrait_type_id' => 1,
                'format_id' => 1,
                'price' => 22000,
                'price_usd' => 300,
                'price_eur' => 250
            ]
        );
        $this->insert(
            '{{%prices}}',
            [
                'bg_material_id' => 1,
                'paint_material_id' => 2,
                'portrait_type_id' => 1,
                'format_id' => 2,
                'price' => 37000,
                'price_usd' => 500,
                'price_eur' => 420
            ]
        );
        $this->insert(
            '{{%prices}}',
            [
                'bg_material_id' => 2,
                'paint_material_id' => 2,
                'portrait_type_id' => 1,
                'format_id' => 1,
                'price' => 24000,
                'price_usd' => 330,
                'price_eur' => 280
            ]
        );
        $this->insert(
            '{{%prices}}',
            [
                'bg_material_id' => 2,
                'paint_material_id' => 2,
                'portrait_type_id' => 1,
                'format_id' => 2,
                'price' => 40000,
                'price_usd' => 550,
                'price_eur' => 470
            ]
        );
        $this->insert(
            '{{%prices}}',
            [
                'bg_material_id' => 1,
                'paint_material_id' => 1,
                'portrait_type_id' => 1,
                'format_id' => 1,
                'price' => 13000,
                'price_usd' => 180,
                'price_eur' => 150
            ]
        );
        $this->insert(
            '{{%prices}}',
            [
                'bg_material_id' => 1,
                'paint_material_id' => 1,
                'portrait_type_id' => 1,
                'format_id' => 2,
                'price' => 22000,
                'price_usd' => 300,
                'price_eur' => 250
            ]
        );
        $this->insert(
            '{{%prices}}',
            [
                'bg_material_id' => 1,
                'paint_material_id' => 1,
                'portrait_type_id' => 2,
                'format_id' => 2,
                'price' => 7000,
                'price_usd' => 100,
                'price_eur' => 85
            ]
        );
        $this->insert(
            '{{%prices}}',
            [
                'bg_material_id' => 1,
                'paint_material_id' => 1,
                'portrait_type_id' => 2,
                'format_id' => 1,
                'price' => 4000,
                'price_usd' => 60,
                'price_eur' => 50
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prices}}');
        $this->dropTable('{{%bg_materials}}');
        $this->dropTable('{{%paint_materials}}');
        $this->dropTable('{{%portrait_types}}');
    }
}
