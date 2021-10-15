<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%city}}`.
 */
class m211012_142038_add_nameCyrl_column_to_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%city}}', 'nameCyrl', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%city}}', 'nameCyrl');
    }
}
