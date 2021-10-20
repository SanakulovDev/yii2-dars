<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gender}}`.
 */
class m211020_054051_create_gender_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gender}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%gender}}');
    }
}
