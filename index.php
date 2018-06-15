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

/*
 * route form here
 *
 */

if (array_key_exists('url',$_GET)){
    $url=$_GET['url'];
}else{
    $url="genre/get/0";
}

$p_array=explode('/',$url);
if (!file_exists($p_array[0].'.php')){
    echo 'Sorry, wrong route';
    exit;
}
require_once ($p_array[0].'.php');

$handle_obj=new $p_array[0]($db_conn,$twig);
if (array_key_exists(1,$p_array)){
    $method=$p_array[1].'Method';
}else{
    $method='indexMethod';
}

if (array_key_exists(2,$p_array)){
    $handle_obj->$method($p_array[2]);
}else{
    $handle_obj->$method();
}
exit();


?>


<?php
/*
 * Main page generation(repetition from genre.php)
 */

/*$movies=$db_conn->getAllMovies();
$categories=$db_conn->getAllCategories();

$new_category=array(
    0=>'All'
);
foreach ($categories as $category){
    $new_category += array(
        $category['id']=>$category['name']
    );
}
try {
    echo $twig->render('index.html.twig',
        array('name' => 'Game Rating',
            'movies'=>$movies,
            'games'=>$movies,
            'categories'=>$new_category,
            'c_id'=>0
        ));
} catch (Exception $e){
    echo $e->getMessage();
}*/

