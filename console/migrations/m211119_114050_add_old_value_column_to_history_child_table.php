<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%history_child}}`.
 */
class m211119_114050_add_old_value_column_to_history_child_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%history_child}}', 'old_value', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%history_child}}', 'old_value');
    }
}
