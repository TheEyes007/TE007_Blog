<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 20:23
 */

namespace Core\Database;

use \PDO;


class dbConnect
{
    private $pdo;

    public function getPDO(){
        if($this->pdo === NULL) {
            $pdo = new PDO('mysql:host=localhost;dbname=blog', 'blog', 'Ma83sy57ni78');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            return $pdo;
        }
        return $this->pdo;
    }

    public function getQuery($statement){
        $req = $this->getPDO()->query($statement);
        $datas = $req->fetchAll(PDO::FETCH_OBJ);
        return $datas;

    }

    public function getPrepare($statement){
        $req = $this->getPDO()->prepare($statement);
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_OBJ);
        return $datas;

    }
}
