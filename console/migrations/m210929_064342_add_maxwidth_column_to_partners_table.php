<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%partners}}`.
 */
class m210929_064342_add_maxwidth_column_to_partners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%partners}}', 'maxwidth', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%partners}}', 'maxwidth');
    }
}
