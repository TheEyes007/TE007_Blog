<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 20:19
 */

namespace App\Repository;

use App\Config\Parameters;

class CommentsRepository
{
    private $table;

    public function allComments()
    {
        $req = 'SELECT blog_comments.id,blog_comments.title,blog_comments.contains,alert,blog_comments.date_create,blog_comments.date_update,blog_users.name,blog_posts.title FROM blog_comments ';
        $req .= 'left join blog_posts on blog_posts.id = blog_comments.fk_posts ';
        $req .= 'left join blog_users on blog_users.id = blog_comments.fk_user ';
        $req .= 'Order by alert DESC,blog_comments.date_update DESC ,blog_comments.date_create DESC;';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function alertComments($value,$id,$table)
    {
        $this->table = $table;
        $req = 'UPDATE '.$table.' set alert = '.$value.' WHERE id = ' .$id .';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function alertSelectComments($id)
    {
        $req = 'SELECT alert FROM blog_comments WHERE id = '.$id .';';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function addComments($user = 1, $post_id, $titre,$contain,$table)
    {
        $this->table = $table;
        $req = 'INSERT INTO '.$table.'(fk_user,fk_posts,title,contains) VALUE (' . '\'' . $user . '\',\''. $post_id . '\',\'' . $titre . '\',\'' .  $contain .'\');';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function deleteComments($id,$table)
    {
        $this->table = $table;
        $req = 'DELETE FROM '.$table.' WHERE id = ' .$id .';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function editComments($user = 1,$titre,$contain,$table,$id)
    {
        $this->table = $table;
        $req = 'UPDATE '.$table.' set fk_user = '.$user.', title = '.'\''.$titre.'\', contains = '.'\''.$contain.'\', date_update = NOW() where id = '.$id.';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function oneComments($id,$table)
    {
        $this->table = $table;
        $req = 'SELECT * FROM '.$table.' where id = '.$id.';';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    /*
    public function InsertAlertComments($table,$fk_user,$fk_comments,$table)
    {
        $this->table = $table;
        $req = 'INSERT INTO'. $table.'(fk_user,fk_comments,nb) VALUE ('.$fk_user.','.$fk_comments.',1);';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function DeleteAlertComments($table,$id)
    {
        $this->table = $table;
        $req = 'DELETE FROM '.$table.' WHERE id = '. $id .';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }
    */

}