<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%myhistory}}`.
 */
class m210924_085401_create_myhistory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%myhistory}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%myhistory}}');
    }
}
