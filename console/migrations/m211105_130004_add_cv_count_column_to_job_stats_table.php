<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_stats}}`.
 */
class m211105_130004_add_cv_count_column_to_job_stats_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_stats}}', 'cv_count', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_stats}}', 'cv_count');
    }
}
