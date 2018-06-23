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

    public function deleteUser($id,$table)
    {
        $this->table = $table;
        $req = 'DELETE FROM '.$table.' WHERE id = ' .$id .';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function allCommentsByUser($userid)
    {
        $req = 'SELECT blog_comments.id,blog_comments.title_comments,blog_comments.contains,alert,blog_comments.date_create,blog_comments.date_update,blog_users.name,blog_posts.title FROM blog_comments ';
        $req .= 'left join blog_posts on blog_posts.id = blog_comments.fk_posts ';
        $req .= 'left join blog_users on blog_users.id = blog_comments.fk_user ';
        $req .= 'WHERE blog_users.id = '. $userid .' ';
        $req .= 'Order by alert DESC,blog_comments.date_update DESC ,blog_comments.date_create DESC;';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function deleteComments($id,$table,$user)
    {
        $this->table = $table;
        $req = 'DELETE FROM '.$table.' WHERE id = ' .$id .' AND fk_user = '. $user .';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function oneCommentsByUser($id,$userid)
    {
        $req = 'SELECT blog_comments.id,blog_comments.title_comments,blog_comments.contains,alert,blog_comments.date_create,blog_comments.date_update,blog_users.name,blog_posts.title FROM blog_comments ';
        $req .= 'left join blog_posts on blog_posts.id = blog_comments.fk_posts ';
        $req .= 'left join blog_users on blog_users.id = blog_comments.fk_user ';
        $req .= 'WHERE blog_users.id = '. $userid .' AND blog_comments.id = '. $id .' ';
        $req .= 'Order by alert DESC,blog_comments.date_update DESC ,blog_comments.date_create DESC;';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function updateComments($titre,$contain,$table,$id,$userid)
    {
        $this->table = $table;
        $req = 'UPDATE '.$table.' set fk_user = '.$userid.', title_comments = '.'\''.$titre.'\', contains = '.'\''.$contain.'\' where id = '.$id.';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }
}