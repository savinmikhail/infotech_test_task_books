<?php

class m250308_000001_create_user_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => 'pk',
            'email' => 'string NOT NULL',
            'password_hash' => 'string NOT NULL',
            'created_at' => 'integer NOT NULL',
            'updated_at' => 'integer NOT NULL',
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');

        $this->createIndex('idx_user_email', 'user', 'email', true);

        $password = getenv('DEFAULT_SITE_USER_PASSWORD') ?: 'Yii1User01*';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $now = time();
        $this->insert('user', [
            'email' => 'user@yii-it.tech',
            'password_hash' => $hash,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
