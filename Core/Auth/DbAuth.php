<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 15/06/2018
 * Time: 15:15
 */
namespace Core\Auth;

class DbAuth
{
    private $db;

    public function __construct(\Core\Database\dbConnect $db)
    {
        $this->db = $db;
    }

    public function login($username){
        $user = $this->db->getPDO()->prepare('SELECT * FROM blog_users WHERE username = ?',[$username], null, true);
    }

    public function logged(){
        return isset($_SESSION['auth']);
    }

    public function forbidden(){
        header('HTTP/1.0 403 forbidden');
        die('Accès interdit');
    }
}