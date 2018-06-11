<?php
/**
 * Created by PhpStorm.
 * User: Wenbo
 * Date: 2018/5/16
 * Time: 10:39
 */

class movie
{

    private $conn;
    private $twig;

    public function __construct($db_conn, $twig)
    {
        $this->conn = $db_conn;
        $this->twig = $twig;
    }


    public function indexMethod()
    {
        echo 'this is movie\'s index';
    }

    public function getMethod($id)
    {

        $games=$this->conn->getAllMovies();
        $movie=$this->conn->getMovieById($id);
        $categories=$this->conn->getAllCategories();

        $new_category=array();
        foreach ($categories as $category){
            $new_category += array(
                $category['id']=>$category['name']
            );
        }

        $comments=$this->conn->getCommentById($id);
        try {
            echo $this->twig->render('movie.html.twig',
                array('movie' => $movie,
                    'games'=>$games,
                    'categories'=>$new_category,
                    'comments'=>$comments
                ));
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}