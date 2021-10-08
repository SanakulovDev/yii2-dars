<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%appeals}}`.
 */
class m211001_075629_add_created_at_column_to_appeals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%appeals}}', 'created_at', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%appeals}}', 'created_at');
    }
}
