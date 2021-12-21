<?php

use yii\db\Migration;

/**
 * Class m211221_143200_add_translation_to_tables
 */
class m211221_143200_add_translation_to_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%colours}}', 'name_en', $this->string());
        $this->execute('UPDATE colours SET name_en = name');
        $this->alterColumn('{{%colours}}', 'name_en', $this->string()->notNull()->unique()->defaultValue('White'));

        $this->addColumn('{{%bg_materials}}', 'name_en', $this->string());
        $this->execute('UPDATE bg_materials SET name_en = name');
        $this->alterColumn('{{%bg_materials}}', 'name_en', $this->string()->notNull()->unique()->defaultValue('Paper'));

        $this->addColumn('{{%paint_materials}}', 'name_en', $this->string());
        $this->execute('UPDATE paint_materials SET name_en = name');
        $this->alterColumn('{{%paint_materials}}', 'name_en', $this->string()->notNull()->unique()->defaultValue('Pencil'));

        $this->addColumn('{{%portrait_types}}', 'name_en', $this->string());
        $this->execute('UPDATE portrait_types SET name_en = name');
        $this->alterColumn('{{%portrait_types}}', 'name_en', $this->string()->notNull()->unique()->defaultValue('Hyperrealism'));


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%colours}}', 'name_en');
        $this->dropColumn('{{%bg_materials}}', 'name_en');
        $this->dropColumn('{{%paint_materials}}', 'name_en');
        $this->dropColumn('{{%portrait_types}}', 'name_en');
    }

}
