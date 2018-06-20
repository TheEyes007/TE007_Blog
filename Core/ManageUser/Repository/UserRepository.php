<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 20:19
 */

namespace Core\ManageUser\Repository;

use App\Config\Parameters;

class UserRepository
{
    private $table;

    public function addUser($name,$name_canonical,$email,$status,$active,$password,$salt,$table)
    {
        $this->table = $table;
        $req = 'INSERT INTO '.$table.'(name,name_canonical,email,status,active,password,salt) VALUE (' . '\'' . $name . '\',\''. $name_canonical . '\',\'' .  $email . '\',\'' . $status . '\',\'' . $active . '\',\'' .  crypt ($password,$salt). '\',\'' . $salt .'\');';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function loginUser($login,$table)
    {
        $this->table = $table;
        $req = 'SELECT id,name, password, salt,status,active FROM '.$table.' WHERE name = \''.$login.'\';';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function loginControlUser($login,$table)
    {
        $this->table = $table;
        $req = 'SELECT count(name_canonical) as nb_login FROM '.$table.' WHERE name_canonical = \''.$login.'\';';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function oneUser($id,$table)
    {
        $this->table = $table;
        $req = 'SELECT * FROM '.$table.' where id = '.$id.';';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function updateUser($name,$name_canonical,$email,$password,$salt,$table,$id)
    {
        $this->table = $table;
        $req = "UPDATE ".$table." set name = '". $name ."',name_canonical = '". $name_canonical ."',email = '". $email  ."',password = '";
        $req .= crypt ($password,$salt)."',salt = '".$salt."' WHERE id = ". $id .";";
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }
}