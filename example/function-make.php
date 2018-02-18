<?php

require __DIR__ . '/../bootstrap.php';

$phpFunction = new \PhpCodeMaker\PhpFunction();

$code = <<<'PHP'
return $user->lastName . ' ' . $user->firstName;
PHP;

$phpFunction
    ->setName('getFullName')
    ->makeParam('user', 'User', 'Очень важный пользователь')
    ->setDescription('Получение полного имени пользователя')
    ->setCode($code);

echo $phpFunction;


