<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%worker}}`.
 */
class m211106_081606_add_apply_messages_column_to_worker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%worker}}', 'apply_messages', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%worker}}', 'apply_messages');
    }
}
