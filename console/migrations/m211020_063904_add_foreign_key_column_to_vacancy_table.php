<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vacancy}}`.
 */
class m211020_063904_add_foreign_key_column_to_vacancy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            '{{%idx-vacancy-gender_id}}',
            '{{%vacancy}}',
            'gender'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-vacancy-gender_id}}',
            '{{%vacancy}}',
            'gender',
            '{{%gender}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            '{{%fk-vacancy-gender_id}}',
            '{{%vacancy}}'
        );
        $this->dropIndex(
            '{{%idx-vacancy-gender_id}}',
            '{{%vacancy}}'
        );
    }
}
