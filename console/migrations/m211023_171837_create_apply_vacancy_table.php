<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apply_vacancy}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%vacancy}}`
 * - `{{%company}}`
 */
class m211023_171837_create_apply_vacancy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apply_vacancy}}', [
            'id' => $this->primaryKey(),
            'vacancy_id' => $this->integer()->notNull(),
            'company_id' => $this->integer()->notNull(),
            'firstname' => $this->string()->notNull(),
            'lastname' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'rezume' => $this->string()->notNull(),
            'purpose' => $this->text(),
        ]);

        // creates index for column `vacancy_id`
        $this->createIndex(
            '{{%idx-apply_vacancy-vacancy_id}}',
            '{{%apply_vacancy}}',
            'vacancy_id'
        );

        // add foreign key for table `{{%vacancy}}`
        $this->addForeignKey(
            '{{%fk-apply_vacancy-vacancy_id}}',
            '{{%apply_vacancy}}',
            'vacancy_id',
            '{{%vacancy}}',
            'id',
            'CASCADE'
        );

        // creates index for column `company_id`
        $this->createIndex(
            '{{%idx-apply_vacancy-company_id}}',
            '{{%apply_vacancy}}',
            'company_id'
        );

        // add foreign key for table `{{%company}}`
        $this->addForeignKey(
            '{{%fk-apply_vacancy-company_id}}',
            '{{%apply_vacancy}}',
            'company_id',
            '{{%company}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%vacancy}}`
        $this->dropForeignKey(
            '{{%fk-apply_vacancy-vacancy_id}}',
            '{{%apply_vacancy}}'
        );

        // drops index for column `vacancy_id`
        $this->dropIndex(
            '{{%idx-apply_vacancy-vacancy_id}}',
            '{{%apply_vacancy}}'
        );

        // drops foreign key for table `{{%company}}`
        $this->dropForeignKey(
            '{{%fk-apply_vacancy-company_id}}',
            '{{%apply_vacancy}}'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            '{{%idx-apply_vacancy-company_id}}',
            '{{%apply_vacancy}}'
        );

        $this->dropTable('{{%apply_vacancy}}');
    }
}
