<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%language}}`.
 */
class m211028_095136_create_language_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%language}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(35)->notNull(),
            'name_ru' => $this->string(35)->notNull(),
            'name_en' => $this->string(35)->notNull(),
            'name_cyrl' => $this->string(35)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }
}
