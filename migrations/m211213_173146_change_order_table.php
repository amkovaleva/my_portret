<?php

use yii\db\Migration;

/**
 * Class m211213_173146_change_order_table
 */
class m211213_173146_change_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cancel_reasons}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue(''),
            'description' => $this->text()->notNull(),
            'description_en' => $this->text()->notNull(),
        ]);
        $this->insert(
            '{{%cancel_reasons}}',
            [
                'name' =>'Плохое фото',
                'description' => 'Вы прислали фото недостаточно хорошего качества',
                'description_en' => 'You send photo with not good enough quality',
            ]
        );

        $this->createTable('{{%pay_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue(''),
            'name_en' => $this->string()->notNull()->defaultValue(''),
            'description' => $this->text()->notNull(),
            'description_en' => $this->text()->notNull(),
            'for_ru' => $this->boolean()->defaultValue(true),
            'for_not_ru' => $this->boolean()->defaultValue(true),
        ]);
        $this->insert(
            '{{%pay_types}}',
            [
                'name' => 'Карта Сбербанк',
                'name_en' => 'Sberbank card',
                'description' => 'Для оплаты переведите деньги на карту',
                'description_en' => 'For payment transfer money on card with number',
                'for_ru' => true,
                'for_not_ru' => false,
            ]
        );
        $this->insert(
            '{{%pay_types}}',
            [
                'name' => 'Перевод на счет',
                'name_en' => 'Transfer on bank account',
                'description' => 'Для оплаты переведите деньги на счет по реквизитам',
                'description_en' => 'For payment transfer money on account number',
                'for_ru' => true,
                'for_not_ru' => false,
            ]
        );

        $this->createTable('{{%delivery_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->defaultValue(''),
            'name_en' => $this->string()->notNull()->defaultValue(''),
            'for_ru' => $this->boolean()->defaultValue(true),
            'for_not_ru' => $this->boolean()->defaultValue(true),
        ]);

        $this->insert(
            '{{%delivery_types}}',
            [
                'name' => 'Почта России',
                'name_en' => 'Russia mail',
                'for_ru' => true,
                'for_not_ru' => true,
            ]
        );

        $this->insert(
            '{{%delivery_types}}',
            [
                'name' => 'SDEC',
                'name_en' => 'SDEC',
                'for_ru' => true,
                'for_not_ru' => false,
            ]
        );

        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'pay_type_id' => $this->integer()->notNull()->defaultValue(1),
            'delivery_type_id' => $this->integer()->notNull()->defaultValue(1),
            'state' => $this->integer()->notNull()->defaultValue(1),

            'fio' => $this->string()->notNull()->defaultValue(''),
            'email' => $this->string()->notNull()->defaultValue(''),
            'index' => $this->string()->notNull()->defaultValue(''),
            'country' => $this->string()->notNull()->defaultValue(''),
            'address' => $this->string()->notNull()->defaultValue(''),
            'phone' => $this->string(),
            'user_comment' => $this->text(),

            'track_info' => $this->text(),
            'cancel_reason_id' => $this->integer(),
            'shop_comment' => $this->text(),
            'feedback' => $this->text(),


            'cost' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'cost_usd' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'cost_eur' => $this->decimal(10, 2)->notNull()->defaultValue(0),

            'language' => $this->string()->notNull()->defaultValue('ru'),
            'user_cookie' => $this->string()->notNull()->defaultValue(''),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-orders-cancel_reason_id',
            '{{%orders}}',
            'cancel_reason_id',
            '{{%cancel_reasons}}',
            'id'
        );
        $this->addForeignKey(
            'fk-orders-pay_type_id',
            '{{%orders}}',
            'pay_type_id',
            '{{%pay_types}}',
            'id'
        );
        $this->addForeignKey(
            'fk-orders-delivery_type_id',
            '{{%orders}}',
            'delivery_type_id',
            '{{%delivery_types}}',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('orders');
        $this->dropTable('cancel_reasons');
        $this->dropTable('pay_types');
        $this->dropTable('delivery_types');
    }
}
