<?php

self::$link = mysqli_connect($HOST, $LOGIN, $PASSWORD, $DBNAME)
        or die (mysqli_connect_errno());

/*Alternative*/
//if (!$link)
//{
//    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
//    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
//    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
//    exit;
//}

mysqli_set_charset(self::$link, 'utf8');

