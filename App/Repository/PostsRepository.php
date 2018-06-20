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

    public function addPosts($user,$titre,$contain,$table)
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
        $req = 'UPDATE '.$table.' set fk_user = '.$user.', title = '.'\''.$titre.'\', contains = '.'\''.$contain.'\' where id = '.$id.';';
        $db_connect = new Parameters();
        $db_connect->getConnectDb()->getPDO()->query($req);
    }

    public function onePosts($id,$table)
    {
        $this->table = $table;
        $req = 'SELECT * FROM '.$table.' INNER JOIN blog_users ON fk_user = blog_users.id where blog_posts.id = '.$id.';';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }

    public function commentsByArticle($id)
    {
        $req = 'SELECT blog_comments.id,blog_comments.title,blog_comments.contains,alert,blog_comments.date_create,blog_comments.date_update,blog_users.name,blog_posts.title FROM blog_comments ';
        $req .= 'left join blog_posts on blog_posts.id = blog_comments.fk_posts ';
        $req .= 'left join blog_users on blog_users.id = blog_comments.fk_user ';
        $req .= 'WHERE blog_comments.fk_posts = \''. $id .'\' ';
        $req .= 'Order by alert DESC,blog_comments.date_update DESC ,blog_comments.date_create DESC;';
        $db_connect = new Parameters();
        $response = $db_connect->getConnectDb()->getQuery($req);
        return $response;
    }
}