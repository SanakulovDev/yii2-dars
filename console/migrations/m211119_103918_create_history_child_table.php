<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history_child}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%history}}`
 */
class m211119_103918_create_history_child_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history_child}}', [
            'id' => $this->primaryKey(),
            'history_id' => $this->integer()->notNull(),
            'message' => $this->string(),
        ]);

        // creates index for column `history_id`
        $this->createIndex(
            '{{%idx-history_child-history_id}}',
            '{{%history_child}}',
            'history_id'
        );

        // add foreign key for table `{{%history}}`
        $this->addForeignKey(
            '{{%fk-history_child-history_id}}',
            '{{%history_child}}',
            'history_id',
            '{{%history}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%history}}`
        $this->dropForeignKey(
            '{{%fk-history_child-history_id}}',
            '{{%history_child}}'
        );

        // drops index for column `history_id`
        $this->dropIndex(
            '{{%idx-history_child-history_id}}',
            '{{%history_child}}'
        );

        $this->dropTable('{{%history_child}}');
    }
}
