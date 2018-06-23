<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 11:16
 */

namespace App\Form;

use Core\Form\FormType;

class CommentsForm
{
    public function NewComment(){
        $form = new FormType();
        $form_new = [];
        $form_new [] = $form->input('titre','text','Titre de votre commentaire','form-control','titre','Titre du commentaire','form-group','');
        $form_new [] = $form->textArea('commentaires','commentaires','form-control',10,50,'Vous pouvez saisir votre commentaire','commentaires','Saisir votre commentaire','form-group');
        $form_new [] = $form->submit('addcomments','btn btn-success');
        return $form_new;
    }

}