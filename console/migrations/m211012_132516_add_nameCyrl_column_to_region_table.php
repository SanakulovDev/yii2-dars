<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%region}}`.
 */
class m211012_132516_add_nameCyrl_column_to_region_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%region}}', 'nameCyrl', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%region}}', 'nameCyrl');
    }
}
