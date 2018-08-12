<?php

require __DIR__ . '/../vendor/autoload.php';


$code = <<<'PHP'
return $user->lastName . ' ' . $user->firstName;
PHP;
$method = new \PhpCodeMaker\PhpClass\Method;
$method
    ->setName('getFullName')
    ->setDescription('Полное имя пользователя')
    ->setCode($code);

$phpClass = new \PhpCodeMaker\PhpClass;
$phpClass
    ->setName('User')
    ->setDescription('Класс для управлением пользователя')
    ->makePrivateProperty('lastName', 'Фамилия')
    ->makePrivateProperty('firstName', 'Имя')
    ->makePrivateProperty('middleName', 'Отчество')
    ->addMethod($method);

echo $phpClass;
