<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m211001_161224_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'name' => $this->string(35),
            'director_name' => $this->string(50),
            'regionId' => $this->integer(),
            'cityId' => $this->integer(),
            'address' => $this->string(),
            'phone' => $this->string(30),
            'logo' => $this->string(),
            'status' => $this->integer(),
            'date' => $this->timestamp(),
            'created_At' => $this->datetime(),
            'updated_At' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company}}');
    }
}
