<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%worker}}`.
 */
class m211007_135955_create_worker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%worker}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer(),
            'firstname' => $this->string(),
            'lastname' => $this->string(),
            'patronymic' => $this->string(),
            'birthdate' => $this->date(),
            'gender' => $this->integer(),
            'nationality_id' => $this->integer(),
            'address' => $this->string(),
            'phone' => $this->string(),
            'photo' => $this->string(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%worker}}');
    }
}
