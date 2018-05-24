<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 21/05/2018
 * Time: 12:41
 */

namespace Core\Router;


class Route
{
    private $path;
    private $callable;
    private $matches;

    public function __construct($path,$callable){
        $this->path = trim($path,'/');
        $this->callable = $callable;
    }

    public function match($url){

        // Enlever le /
        $url = trim($url,'/');

        // Transformer l'url en modifiant le paramètre par une expression régulière sauf le /
        // Remplacer le : + tout caractère alphanumérique par toute expression régulier sauf /
        $path = preg_replace('#:([\w]+)#','([^/]+)',$this->path);

        // Transformer en expression régulière pour vérifier toute l'url, le drapeau i pour la casse
        $regex = "#^$path$#i";

        // valeur à matcher pour les deux premieres, resultat à stocker pour la troisieme
        if(!preg_match($regex,$url,$matches))
        {
            return false;
        }
        //enlever la position 0 du tableau
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function call()
    {
        return call_user_func_array($this->callable, $this->matches);
    }

}