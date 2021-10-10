<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%worker}}`.
 */
class m211009_200742_add_regionId_column_cityId_column_to_worker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%worker}}', 'regionId', $this->integer());
        $this->addColumn('{{%worker}}', 'cityId', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%worker}}', 'regionId');
        $this->dropColumn('{{%worker}}', 'cityId');
    }
}
