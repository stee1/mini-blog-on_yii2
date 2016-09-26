<?php

use yii\db\Migration;

/**
 * Handles the creation for table `records_v2`.
 */
class m160926_092858_create_records_v2_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('records_v2', [
            'id' => $this->primaryKey(),
            'author' => $this->string(30)->notNull(),
            'date' => $this->dateTime()->notNull(),
            'text' => $this->text()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('records_v2');
    }
}
