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
}

//$db=new DBConnection();
//var_dump($db->getAllMovies());