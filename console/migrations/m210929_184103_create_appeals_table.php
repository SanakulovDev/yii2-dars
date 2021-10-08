<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appeals}}`.
 */
class m210929_184103_create_appeals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appeals}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(35),
            'lastname' => $this->string(35),
            'email' => $this->string(255),
            'subject' => $this->string(255),
            'message' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%appeals}}');
    }
}
