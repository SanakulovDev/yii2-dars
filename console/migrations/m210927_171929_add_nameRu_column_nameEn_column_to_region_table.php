<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%region}}`.
 */
class m210927_171929_add_nameRu_column_nameEn_column_to_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%region}}', 'nameEn', $this->string());
        $this->addColumn('{{%region}}', 'nameRu', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%region}}', 'nameEn');
        $this->dropColumn('{{%region}}', 'nameRu');
    }
}
