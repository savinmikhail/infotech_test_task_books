<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../../vendor/yiisoft/yii/framework/yii.php';
$config = dirname(__FILE__) . '/../config/test.php';

require_once($yii);

Yii::createWebApplication($config);
if (Yii::app()->hasComponent('sms')) {
    Yii::app()->sms->apiKey = '';
}
