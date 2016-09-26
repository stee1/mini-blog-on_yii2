<?php

use yii\db\Migration;

/**
 * Handles the creation for table `comments_v2`.
 */
class m160926_100853_create_comments_v2_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('comments_v2', [
            'id' => $this->primaryKey(),
            'id_record' => $this->integer(11)->notNull(),
            'author' => $this->string(30)->notNull(),
            'date' => $this->dateTime()->notNull(),
            'text' => $this->text()->notNull()
        ]);

        $this->addForeignKey("fk_record_id", "comments_v2", "id_record", "records_v2", "id", "CASCADE", "CASCADE");
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk_record_id", "comments_v2");

        $this->dropTable('comments_v2');
    }
}
