<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gender}}`.
 */
class m211020_054754_add_name_ru_column_name_en_column_name_cyrl_column_to_gender_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%gender}}', 'name_ru', $this->string());
        $this->addColumn('{{%gender}}', 'name_en', $this->string());
        $this->addColumn('{{%gender}}', 'name_cyrl', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%gender}}', 'name_ru');
        $this->dropColumn('{{%gender}}', 'name_en');
        $this->dropColumn('{{%gender}}', 'name_cyrl');
    }
}
