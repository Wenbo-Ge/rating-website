<?php
/**
 * Created by PhpStorm.
 * User: Wenbo
 * Date: 2018/5/16
 * Time: 18:59
 */

class genre{
    private $conn;
    private $twig;
    public function __construct($conn,$twig){
        $this->conn=$conn;
        $this->twig=$twig;
    }

    public function getMethod($cid){
        $movies=$this->conn->getCategoryById($cid);
        $categories=$this->conn->getAllCategories();

        $new_category=array(
            0=>'All'
        );
        foreach ($categories as $category){
            $new_category += array(
                $category['id']=>$category['name']
            );
        }
        try {
            echo $this->twig->render('index.html.twig',
                array('name' => 'ShineMovie',
                    'movies'=>$movies,
                    'categories'=>$new_category,
                    'c_id'=>$cid
                ));
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
}