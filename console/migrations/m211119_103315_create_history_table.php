<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m211119_103315_create_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'table_name' => $this->string(50)->notNull(),
            'message' => $this->string(),
            'date' => $this->timestamp()->defaultExpression('NOW()'),
        ]);

        // creates index for column `userId`
        $this->createIndex(
            '{{%idx-history-userId}}',
            '{{%history}}',
            'userId'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-history-userId}}',
            '{{%history}}',
            'userId',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-history-userId}}',
            '{{%history}}'
        );

        // drops index for column `userId`
        $this->dropIndex(
            '{{%idx-history-userId}}',
            '{{%history}}'
        );

        $this->dropTable('{{%history}}');
    }
}
