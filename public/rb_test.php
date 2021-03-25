<?php
require '../vendor/libs/RedBeanPHP5_6_2/rb.php';

$db = require  '../config/config_db.php';

R::setup($db['dsn'], $db['user'], $db['pass']);
R::freeze(true);
//var_dump(R::testConnection());

//Create
/*$cat = R::dispense('category');
$cat->title = 'Категория 2';
$id = R::store($cat);*/

//Read
/*$cat = R::load('category', 2);
echo $cat->title;
echo $cat['title'];*/

//Update
/*$cat = R::load('category', 2);
echo $cat->title;
$cat->title = 'Категория 2';
R::store($cat);*/

/*$cat = R::dispense('category');
$cat->title = 'Категория 3';
$cat->id = 2;
R::store($cat);*/

//Delete
/*$cat = R::load('category', 2);
R::trash($cat);*/
R::wipe('category');