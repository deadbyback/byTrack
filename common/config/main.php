<?php

$config = [
    'id' => 'byTrack',
    'name' => 'byTrack',
];

return [
    'name' => 'byTrack',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
/*            'defaultRoles' => ['user','manager','admin'],*/
        ],
    ],
];
