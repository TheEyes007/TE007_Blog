<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 20:32
 */

namespace App\Config;

use Core\Database\dbConnect;

class Parameters
{
    public function getConnectDb(){
        $dbconnect = new dbConnect();
        $dbconnect->getPDO();
        return $dbconnect;
    }

}