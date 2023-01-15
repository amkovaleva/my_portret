<?php

use yii\db\Migration;

/**
 * Class m230115_090751_add_server_col
 */
class m230115_090751_add_server_col extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'server', $this->string());
        $this->update('{{%orders}}', ['server' => 'sekatski.com']);
        $this->alterColumn('{{%orders}}', 'server', $this->string()->notNull()->defaultValue('sekatski.ru'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230115_090751_add_server_col cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230115_090751_add_server_col cannot be reverted.\n";

        return false;
    }
    */
}
