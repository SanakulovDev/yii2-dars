<?php

use yii\db\Migration;

/**
 * Class m211020_151655_add_foreign_key_vacancy_table
 */
class m211020_151655_add_foreign_key_vacancy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            '{{%idx-vacancy-company_id}}',
            '{{%vacancy}}',
            'company_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-vacancy-company_id}}',
            '{{%vacancy}}',
            'company_id',
            '{{%company}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-vacancy-region_id}}',
            '{{%vacancy}}',
            'region_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-vacancy-region_id}}',
            '{{%vacancy}}',
            'region_id',
            '{{%region}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-vacancy-city_id}}',
            '{{%vacancy}}',
            'city_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-vacancy-city_id}}',
            '{{%vacancy}}',
            'city_id',
            '{{%city}}',
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
            '{{%fk-vacancy-region_id}}',
            '{{%vacancy}}'
        );
        $this->dropIndex(
            '{{%idx-vacancy-region_id}}',
            '{{%vacancy}}'
        );
        $this->dropForeignKey(
            '{{%fk-vacancy-city_id}}',
            '{{%vacancy}}'
        );
        $this->dropIndex(
            '{{%idx-vacancy-city_id}}',
            '{{%vacancy}}'
        );

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211020_151655_add_foreign_key_vacancy_table cannot be reverted.\n";

        return false;
    }
    */
}
