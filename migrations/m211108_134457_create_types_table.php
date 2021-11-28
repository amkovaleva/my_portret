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
        $this->insert('{{%bg_materials}}', ['name' => 'Холст', 'is_mount' => false]);

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
        $this->insert('{{%portrait_types}}', ['name' => 'Набросок']);


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

        $prices = [
            [ //Гиперреализм
                'portrait_type_id' => 1,
                'items' => [
                    [ //Масло бумага
                        'paint_material_id' => 2,
                        'bg_material_id' => 1,
                        'items' => [
                            [ //format_id
                                'format_id' => 1,
                                'price' => 30000,
                                'price_usd' => 430,
                                'price_eur' => 380
                            ],
                            [ //format_id
                                'format_id' => 2,
                                'price' => 40000,
                                'price_usd' => 600,
                                'price_eur' => 540
                            ],
                            [ //format_id
                                'format_id' => 3,
                                'price' => 60000,
                                'price_usd' => 910,
                                'price_eur' => 810
                            ],
                        ]
                    ],
                    [ //Масло холст
                        'paint_material_id' => 2,
                        'bg_material_id' => 2,
                        'items' => [
                            [ //format_id
                                'format_id' => 1,
                                'price' => 33000,
                                'price_usd' => 480,
                                'price_eur' => 430
                            ],
                            [ //format_id
                                'format_id' => 2,
                                'price' => 47000,
                                'price_usd' => 670,
                                'price_eur' => 600
                            ],
                            [ //format_id
                                'format_id' => 3,
                                'price' => 70000,
                                'price_usd' => 1000,
                                'price_eur' => 900
                            ],
                        ]
                    ],
                    [ //Карандаш бумага
                        'paint_material_id' => 1,
                        'bg_material_id' => 1,
                        'items' => [
                            [ //format_id
                                'format_id' => 1,
                                'price' => 16000,
                                'price_usd' => 240,
                                'price_eur' => 210
                            ],
                            [ //format_id
                                'format_id' => 2,
                                'price' => 20000,
                                'price_usd' => 340,
                                'price_eur' => 300
                            ],
                            [ //format_id
                                'format_id' => 3,
                                'price' => 30000,
                                'price_usd' => 510,
                                'price_eur' => 460
                            ],
                        ]
                    ],
                ],
            ],
            [ //Фотореализм
                'portrait_type_id' => 2,
                'items' => [
                    [ //Масло бумага
                        'paint_material_id' => 2,
                        'bg_material_id' => 1,
                        'items' => [
                            [ //format_id
                                'format_id' => 1,
                                'price' => 18000,
                                'price_usd' => 270,
                                'price_eur' => 240
                            ],
                            [ //format_id
                                'format_id' => 2,
                                'price' => 25000,
                                'price_usd' => 380,
                                'price_eur' => 340
                            ],
                            [ //format_id
                                'format_id' => 3,
                                'price' => 38000,
                                'price_usd' => 570,
                                'price_eur' => 510
                            ],
                        ]
                    ],
                    [ //Масло холст
                        'paint_material_id' => 2,
                        'bg_material_id' => 2,
                        'items' => [
                            [ //format_id
                                'format_id' => 1,
                                'price' => 21000,
                                'price_usd' => 300,
                                'price_eur' => 270
                            ],
                            [ //format_id
                                'format_id' => 2,
                                'price' => 29000,
                                'price_usd' => 420,
                                'price_eur' => 370
                            ],
                            [ //format_id
                                'format_id' => 3,
                                'price' => 44000,
                                'price_usd' => 630,
                                'price_eur' => 560
                            ],
                        ]
                    ],
                    [ //Карандаш бумага
                        'paint_material_id' => 1,
                        'bg_material_id' => 1,
                        'items' => [
                            [ //format_id
                                'format_id' => 1,
                                'price' => 10000,
                                'price_usd' => 150,
                                'price_eur' => 130
                            ],
                            [ //format_id
                                'format_id' => 2,
                                'price' => 15000,
                                'price_usd' => 210,
                                'price_eur' => 190
                            ],
                            [ //format_id
                                'format_id' => 3,
                                'price' => 22000,
                                'price_usd' => 320,
                                'price_eur' => 290
                            ],
                        ]
                    ],
                ]
            ],
            [ //Набросок
                'portrait_type_id' => 3,
                'items' => [
                    [ //Масло бумага
                        'paint_material_id' => 2,
                        'bg_material_id' => 1,
                        'items' => [
                            [ //format_id
                                'format_id' => 1,
                                'price' => 10000,
                                'price_usd' => 130,
                                'price_eur' => 120
                            ],
                            [ //format_id
                                'format_id' => 2,
                                'price' => 14000,
                                'price_usd' => 180,
                                'price_eur' => 160
                            ],
                        ]
                    ],
                    [ //Карандаш бумага
                        'paint_material_id' => 1,
                        'bg_material_id' => 1,
                        'items' => [
                            [ //format_id
                                'format_id' => 1,
                                'price' => 5000,
                                'price_usd' => 70,
                                'price_eur' => 60
                            ],
                            [ //format_id
                                'format_id' => 2,
                                'price' => 7000,
                                'price_usd' => 100,
                                'price_eur' => 90
                            ]
                        ]
                    ],
                ]

            ],

        ];


        foreach ($prices as &$portrait_type) {
            $portrait_type_id = $portrait_type['portrait_type_id'];
            foreach ($portrait_type['items'] as &$portrait_material) {
                $paint_material_id = $portrait_material['paint_material_id'];
                $bg_material_id = $portrait_material['bg_material_id'];

                foreach ($portrait_material['items'] as &$portrait_format) {
                    $this->insert(
                        '{{%prices}}',
                        [
                            'bg_material_id' => $bg_material_id,
                            'paint_material_id' => $paint_material_id,
                            'portrait_type_id' => $portrait_type_id,
                            'format_id' => $portrait_format['format_id'],
                            'price' => $portrait_format['price'],
                            'price_usd' => $portrait_format['price_usd'],
                            'price_eur' => $portrait_format['price_eur'],
                        ]
                    );
                }
            }
        }
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
