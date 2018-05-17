<?php
/**
 * Created by PhpStorm.
 * User: Wenbo
 * Date: 2018/5/17
 * Time: 10:59
 */

class comment{
    private $conn;
    private $twig;

    public function __construct($db_conn, $twig)
    {
        $this->conn = $db_conn;
        $this->twig = $twig;
    }

    public function submitMethod(){
        $mid=$_POST['mid'];
        $content=$_POST['content'];
        $result=$this->conn->insertComment($mid,$content);

        header('Access-Control-Allow-Origin:*');
        header('Content-Type:application/json;charset=UTF-8');
        if ($result){
            $message=array(
                'code'=>200,
                'message'=>'Comments added successfully'
            );
            echo json_encode($message);
        }else{
            $message=array(
                'code'=>400,
                'message'=>'Failed, try again'
            );
            echo json_encode($message);
        }

    }
}