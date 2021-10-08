<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%city}}`.
 */
class m210927_171943_add_nameRu_column_nameEn_column_to_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%city}}', 'nameEn', $this->string());
        $this->addColumn('{{%city}}', 'nameRu', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%city}}', 'nameEn');
        $this->dropColumn('{{%city}}', 'nameRu');
    }
}
