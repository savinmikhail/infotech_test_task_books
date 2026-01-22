<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    protected function tearDown(): void
    {
        if (Yii::app()->hasComponent('user')) {
            Yii::app()->user->logout(false);
        }
        parent::tearDown();
    }

    public function testLoginSuccess()
    {
        $email = 'user@yii-it.tech';
        $password = getenv('DEFAULT_SITE_USER_PASSWORD') ?: 'Yii1User01*';

        $model = new LoginForm();
        $model->username = $email;
        $model->password = $password;

        $this->assertTrue($model->validate());
        $this->assertTrue($model->login());
        $this->assertFalse(Yii::app()->user->isGuest);
    }
}
