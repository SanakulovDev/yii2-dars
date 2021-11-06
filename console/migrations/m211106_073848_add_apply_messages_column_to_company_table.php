<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company}}`.
 */
class m211106_073848_add_apply_messages_column_to_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company}}', 'apply_messages', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company}}', 'apply_messages');
    }
}
