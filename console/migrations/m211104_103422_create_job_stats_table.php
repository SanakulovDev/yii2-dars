<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_stats}}`.
 */
class m211104_103422_create_job_stats_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_stats}}', [
            'id' => $this->primaryKey(),
            'company_number' => $this->integer()->notNull(),
            'job_post_number' => $this->integer()->notNull(),
            'user_number' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%job_stats}}');
    }
}
