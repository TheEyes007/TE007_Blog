<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 20:19
 */

namespace App\Repository;

use App\Config\Parameters;

class PostsRepository
{
    private $table;


    public function allPosts($table)
    {
        $this->table = $table;
        $req = 'SELECT * FROM '.$table.';';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function addPosts($user = 1,$titre,$contain,$table)
    {
        $this->table = $table;
        $req = 'INSERT INTO '.$table.'(fk_user,title,contains) VALUE (' . '\'' . $user . '\',\''. $titre . '\',\'' .  $contain .'\');';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function deletePosts($id,$table)
    {
        $this->table = $table;
        $req = 'DELETE FROM '.$table.' WHERE id = ' .$id .';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function editPosts($user = 1,$titre,$contain,$table,$id)
    {
        $this->table = $table;
        $req = 'UPDATE '.$table.' set fk_user = '.$user.', title = '.'\''.$titre.'\', contains = '.'\''.$contain.'\', date_update = NOW() where id = '.$id.';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function onePosts($id,$table)
    {
        $this->table = $table;
        $req = 'SELECT * FROM '.$table.' where id = '.$id.';';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }


}