<?php
/**
 * Created by PhpStorm.
 * User: Wenbo
 * Date: 2018/5/12
 * Time: 21:08
 */

require_once ('./vendor/autoload.php');
require_once ('./DBConnection.php');

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);

$db_conn=new DBConnection();
$movies=$db_conn->getAllMovies();
$categories=$db_conn->getAllCategories();

$new_category=array();
foreach ($categories as $category){
    $new_category += array(
        $category['id']=>$category['name']
    );
}
try {
    echo $twig->render('index.html.twig',
        array('name' => 'ShineMovie',
            'movies'=>$movies,
            'categories'=>$new_category
        ));
} catch (Exception $e){
    echo $e->getMessage();
}

