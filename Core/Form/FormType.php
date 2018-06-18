<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 11:18
 */

namespace Core\Form;


class FormType
{
    private $tag = 'p';

    private function surround($labels,$html, $tag,$class)
    {
        if ($tag === '')
            return ('<' . $this->tag . ' class="'. $class .'">' . $labels . $html . '</' . $this->tag . '>');
        else
            return ('<' . $tag . ' class="'. $class .'">' . $html . '<' . $tag . '>');
    }

    private function labels($for,$content){
        return ('<label for="'. $for .'">'. $content .'</label>');
    }

    public function input($name, $type,$placeholder = '',$class_input, $for,$content,$class,$value)
    {
        return $this->surround($this->labels($for,$content),
            '<input type="' . $type . '" name="' . $name . '" placeholder="'. $placeholder .'" class="'. $class_input .'" value="'. $value.'" />',
            '',$class);
    }

    //Input pour les mails, téléphones et autres qui n'ont pas d'attributs name.
    public function input_other($type,$placeholder,$name,$class_input,$for,$content,$class)
    {
        return $this->surround($this->labels($for,$content),
            '<input name = "'. $name .'" placeholder="'. $placeholder .'" class="'. $class_input .'" type="' . $type . '"/>',
            '',$class);
    }

    public function textArea($id,$textarea,$class_input,$row = 10,$cols = 50,$defaut_contain,$for,$content,$class)
    {
        return $this->surround($this->labels($for,$content),'<textarea  id="' . $id . '" name="' . $textarea . '" row="' . $row . '" cols="' . $cols . '" class="'. $class_input .'">'. $defaut_contain .'</textarea>', '',$class);
    }

    public function choice($choice, $type = "checkbox")
    {
        return ('<input type="' . $type . '" name="' . $choice . '"/>');
    }

    public function submit($name,$class)
    {
        return ('<input type="submit" name="' . $name . '" class="' . $class . '"/>');
    }
}