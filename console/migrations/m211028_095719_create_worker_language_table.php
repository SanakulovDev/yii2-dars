<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%worker_language}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%worker}}`
 * - `{{%language}}`
 */
class m211028_095719_create_worker_language_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%worker_language}}', [
            'id' => $this->primaryKey(),
            'worker_id' => $this->integer(),
            'language_id' => $this->integer(),
            'other_lang' => $this->string(35),
            'rate' => $this->integer(),
        ]);

        // creates index for column `worker_id`
        $this->createIndex(
            '{{%idx-worker_language-worker_id}}',
            '{{%worker_language}}',
            'worker_id'
        );

        // add foreign key for table `{{%worker}}`
        $this->addForeignKey(
            '{{%fk-worker_language-worker_id}}',
            '{{%worker_language}}',
            'worker_id',
            '{{%worker}}',
            'id',
            'CASCADE'
        );

        // creates index for column `language_id`
        $this->createIndex(
            '{{%idx-worker_language-language_id}}',
            '{{%worker_language}}',
            'language_id'
        );

        // add foreign key for table `{{%language}}`
        $this->addForeignKey(
            '{{%fk-worker_language-language_id}}',
            '{{%worker_language}}',
            'language_id',
            '{{%language}}',
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
            '{{%fk-worker_language-worker_id}}',
            '{{%worker_language}}'
        );

        // drops index for column `worker_id`
        $this->dropIndex(
            '{{%idx-worker_language-worker_id}}',
            '{{%worker_language}}'
        );

        // drops foreign key for table `{{%language}}`
        $this->dropForeignKey(
            '{{%fk-worker_language-language_id}}',
            '{{%worker_language}}'
        );

        // drops index for column `language_id`
        $this->dropIndex(
            '{{%idx-worker_language-language_id}}',
            '{{%worker_language}}'
        );

        $this->dropTable('{{%worker_language}}');
    }
}
