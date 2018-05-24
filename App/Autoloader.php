<?php

namespace App;
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/05/2018
 * Time: 17:14
 */

class Autoloader{

    /**
     * Définir l'autoloader pour permettre l'ajout d'autres éventuels
     */

    static function register(){
        spl_autoload_register(array(__CLASS__,'autoload'));
    }

    /*
     * Fonction pour appeler les classes de l'application
     * @params $class string
     */

    static function autoload($class){
        if(strpos($class, __NAMESPACE__.'\\') === 0){
            $class = str_replace(__NAMESPACE__.'\\','',$class);
            $class = str_replace('\\','/',$class);
            require __DIR__ .'/'. $class.'.php';
        }
    }

}