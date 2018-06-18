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
}