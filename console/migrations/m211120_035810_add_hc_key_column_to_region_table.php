<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%region}}`.
 */
class m211120_035810_add_hc_key_column_to_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%region}}', 'hc_key', $this->string(10)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%region}}', 'hc_key');
    }
}
