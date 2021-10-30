<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%labor_activity}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%worker}}`
 */
class m211029_145519_create_labor_activity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%labor_activity}}', [
            'id' => $this->primaryKey(),
            'worker_id' => $this->integer(),
            'company_name' => $this->string(),
            'position' => $this->integer(),
            'form_date' => $this->timestamp(),
            'to_date' => $this->timestamp(),
        ]);

        // creates index for column `worker_id`
        $this->createIndex(
            '{{%idx-labor_activity-worker_id}}',
            '{{%labor_activity}}',
            'worker_id'
        );

        // add foreign key for table `{{%worker}}`
        $this->addForeignKey(
            '{{%fk-labor_activity-worker_id}}',
            '{{%labor_activity}}',
            'worker_id',
            '{{%worker}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%worker}}`
        $this->dropForeignKey(
            '{{%fk-labor_activity-worker_id}}',
            '{{%labor_activity}}'
        );

        // drops index for column `worker_id`
        $this->dropIndex(
            '{{%idx-labor_activity-worker_id}}',
            '{{%labor_activity}}'
        );

        $this->dropTable('{{%labor_activity}}');
    }
}
