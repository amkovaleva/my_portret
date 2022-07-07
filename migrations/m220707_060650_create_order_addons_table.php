<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_addons}}`.
 */
class m220707_060650_create_order_addons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_addons}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull()->defaultValue(0),
            'addon_id' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk-order_addons-order_id',
            '{{%order_addons}}',
            'order_id',
            '{{%orders}}',
            'id'
        );

        $this->addForeignKey(
            'fk-order_addons-addon_id',
            '{{%order_addons}}',
            'addon_id',
            '{{%addons}}',
            'id'
        );

        $this->dropColumn('{{%orders}}', 'cost');
        $this->dropColumn('{{%orders}}', 'cost_usd');
        $this->dropColumn('{{%orders}}', 'cost_eur');
        $this->dropColumn('{{%orders}}', 'language');
        $this->dropColumn('{{%orders}}', 'user_cookie');
        $this->dropColumn('{{%orders}}', 'address');
        $this->renameColumn('{{%orders}}', 'fio', 'first_name');
        $this->addColumn('{{%orders}}', 'last_name', $this->string());
        $this->addColumn('{{%orders}}', 'middle_name', $this->string());
        $this->addColumn('{{%orders}}', 'city', $this->string());
        $this->addColumn('{{%orders}}', 'street', $this->string());
        $this->addColumn('{{%orders}}', 'house', $this->string());
        $this->addColumn('{{%orders}}', 'apartment', $this->string());
        $this->addColumn('{{%orders}}', 'cart_item_id', $this->integer()->notNull()->defaultValue(0));


        $this->addForeignKey(
            'fk-orders-cart_item_id',
            '{{%orders}}',
            'cart_item_id',
            '{{%cart_items}}',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_addons}}');
    }
}
