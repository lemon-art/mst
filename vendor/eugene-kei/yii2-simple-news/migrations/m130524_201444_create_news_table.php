<?php

use yii\db\Migration;
use yii\db\Schema;

class m130524_201444_create_news_table extends Migration
{

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%news}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(100) NOT NULL',
            'annonce' => Schema::TYPE_TEXT . ' NOT NULL DEFAULT ""',
            'content' => Schema::TYPE_TEXT . ' NOT NULL DEFAULT ""',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00"',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT "0000-00-00 00:00:00"',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        // Foreign Keys
        $this->addForeignKey('FK_news_user', '{{%news}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        // Indexes
        $this->createIndex('status', '{{%news}}', 'status');
        $this->createIndex('created_at', '{{%news}}', 'created_at');
        $this->createIndex('updated_at', '{{%news}}', 'updated_at');
    }

    public function down()
    {
        $this->dropTable('{{%news}}');
    }
}
