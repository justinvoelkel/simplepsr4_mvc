<?php
/**
 * Created by PhpStorm.
 * User: justinvoelkel
 * Date: 3/16/15
 * Time: 8:53 PM
 */
namespace simplepsr4\Database;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
$capsule->addConnection(
    [
        'driver'=>'mysql',
        'host'=>'127.0.0.1',
        'username'=>'root',
        'password'=>'123',
        'database'=>'simplepsr4',
        'charset'=>'utf8',
        'collation'=>'utf8_unicode_ci',
        'prefix'=>''
    ]
);

$capsule->bootEloquent();