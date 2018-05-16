<?php
/**
 * Created by PhpStorm.
 * User: Wenbo
 * Date: 2018/5/14
 * Time: 10:13
 */

class DBConnection {
    protected $conn;

    public function getConnInstant(){
        if (!isset($this->conn)){
            $this->conn = new PDO(
                'mysql:host=localhost;dbname=movie;charset=utf8mb4',
                'root',
                'root'
            );
        }

        return $this->conn;
    }

    public function getAllMovies(){
        $stmt=$this->getConnInstant()->query('SELECT * FROM movie ORDER BY date DESC');
        $movie=$stmt->fetchAll(PDO::FETCH_ASSOC);

        return $movie;
    }

    public function getAllCategories(){
        $stmt=$this->getConnInstant()->query('SELECT * FROM categories');
        $categories=$stmt->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    public function getMovieById($id){
        $stmt=$this->getConnInstant()->prepare('SELECT * FROM movie WHERE id=:id');
        $result=$stmt->execute(
            array(
                ':id'=>$id
            )
        );
        $result=$stmt->fetch();
        return $result;
    }

    public function getCommentById($id){
        $stmt=$this->getConnInstant()->prepare('SELECT * FROM comments WHERE m_id=:id');
        $result=$stmt->execute(
            array(
                ':id'=>$id
            )
        );
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getCategoryById($cid){
        $stmt=$this->getConnInstant()->prepare('SELECT * FROM movie WHERE genre LIKE :id ORDER BY date DESC ');
        $result=$stmt->execute(
            array(
                ':id'=>'%'.$cid.'%'
            )
        );
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

//$db=new DBConnection();
//var_dump($db->getCategoryById(3));