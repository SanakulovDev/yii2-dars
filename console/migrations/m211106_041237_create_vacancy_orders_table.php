<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacancy_orders}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%company}}`
 * - `{{%vacancy}}`
 * - `{{%worker}}`
 */
class m211106_041237_create_vacancy_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy_orders}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'vacancy_id' => $this->integer()->notNull(),
            'worker_id' => $this->integer(),
            'status' => $this->integer()->notNull(),
            'company_view' => $this->integer(),
            'worker_view' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('NOW()'),
            'date_approval' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE NOW()'),
        ]);

        // creates index for column `company_id`
        $this->createIndex(
            '{{%idx-vacancy_orders-company_id}}',
            '{{%vacancy_orders}}',
            'company_id'
        );

        // add foreign key for table `{{%company}}`
        $this->addForeignKey(
            '{{%fk-vacancy_orders-company_id}}',
            '{{%vacancy_orders}}',
            'company_id',
            '{{%company}}',
            'id',
            'CASCADE'
        );

        // creates index for column `vacancy_id`
        $this->createIndex(
            '{{%idx-vacancy_orders-vacancy_id}}',
            '{{%vacancy_orders}}',
            'vacancy_id'
        );

        // add foreign key for table `{{%vacancy}}`
        $this->addForeignKey(
            '{{%fk-vacancy_orders-vacancy_id}}',
            '{{%vacancy_orders}}',
            'vacancy_id',
            '{{%vacancy}}',
            'id',
            'CASCADE'
        );

        // creates index for column `worker_id`
        $this->createIndex(
            '{{%idx-vacancy_orders-worker_id}}',
            '{{%vacancy_orders}}',
            'worker_id'
        );

        // add foreign key for table `{{%worker}}`
        $this->addForeignKey(
            '{{%fk-vacancy_orders-worker_id}}',
            '{{%vacancy_orders}}',
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
        // drops foreign key for table `{{%company}}`
        $this->dropForeignKey(
            '{{%fk-vacancy_orders-company_id}}',
            '{{%vacancy_orders}}'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            '{{%idx-vacancy_orders-company_id}}',
            '{{%vacancy_orders}}'
        );

        // drops foreign key for table `{{%vacancy}}`
        $this->dropForeignKey(
            '{{%fk-vacancy_orders-vacancy_id}}',
            '{{%vacancy_orders}}'
        );

        // drops index for column `vacancy_id`
        $this->dropIndex(
            '{{%idx-vacancy_orders-vacancy_id}}',
            '{{%vacancy_orders}}'
        );

        // drops foreign key for table `{{%worker}}`
        $this->dropForeignKey(
            '{{%fk-vacancy_orders-worker_id}}',
            '{{%vacancy_orders}}'
        );

        // drops index for column `worker_id`
        $this->dropIndex(
            '{{%idx-vacancy_orders-worker_id}}',
            '{{%vacancy_orders}}'
        );

        $this->dropTable('{{%vacancy_orders}}');
    }
}
