<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacancy}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%profession}}`
 * - `{{%job_type}}`
 */
class m211019_061150_create_vacancy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancy}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'profession_id' => $this->integer()->notNull(),
            'description_uz' => $this->text()->notNull(),
            'description_ru' => $this->text()->notNull(),
            'description_en' => $this->text()->notNull(),
            'description_cyrl' => $this->text()->notNull(),
            'job_type_id' => $this->integer()->defaultValue(0),
            'region_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'image' => $this->string(100)->notNull(),
            'count_vacancy' => $this->integer()->notNull(),
            'salary' => $this->integer(),
            'gender' => $this->integer(),
            'experience' => $this->string(250)->defaultValue(Null),
            'telegram' => $this->string(70),
            'address' => $this->string(150),
            'views' => $this->integer(),
            'status' => $this->integer()->defaultValue(1),
            'deadline' => $this->date(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->date (),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-vacancy-user_id}}',
            '{{%vacancy}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-vacancy-user_id}}',
            '{{%vacancy}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `profession_id`
        $this->createIndex(
            '{{%idx-vacancy-profession_id}}',
            '{{%vacancy}}',
            'profession_id'
        );

        // add foreign key for table `{{%profession}}`
        $this->addForeignKey(
            '{{%fk-vacancy-profession_id}}',
            '{{%vacancy}}',
            'profession_id',
            '{{%profession}}',
            'id',
            'CASCADE'
        );

        // creates index for column `job_type_id`
        $this->createIndex(
            '{{%idx-vacancy-job_type_id}}',
            '{{%vacancy}}',
            'job_type_id'
        );

        // add foreign key for table `{{%job_type}}`
        $this->addForeignKey(
            '{{%fk-vacancy-job_type_id}}',
            '{{%vacancy}}',
            'job_type_id',
            '{{%job_type}}',
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
            '{{%fk-vacancy-user_id}}',
            '{{%vacancy}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-vacancy-user_id}}',
            '{{%vacancy}}'
        );

        // drops foreign key for table `{{%profession}}`
        $this->dropForeignKey(
            '{{%fk-vacancy-profession_id}}',
            '{{%vacancy}}'
        );

        // drops index for column `profession_id`
        $this->dropIndex(
            '{{%idx-vacancy-profession_id}}',
            '{{%vacancy}}'
        );

        // drops foreign key for table `{{%job_type}}`
        $this->dropForeignKey(
            '{{%fk-vacancy-job_type_id}}',
            '{{%vacancy}}'
        );

        // drops index for column `job_type_id`
        $this->dropIndex(
            '{{%idx-vacancy-job_type_id}}',
            '{{%vacancy}}'
        );

        $this->dropTable('{{%vacancy}}');
    }
}
