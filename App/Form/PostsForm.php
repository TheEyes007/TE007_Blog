<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 11:16
 */

namespace App\Form;

use Core\Form\FormType;
use App\Repository\PostsRepository;

class PostsForm
{
    public function NewComment(){
        $form = new FormType();
        $form_new = [];
        $form_new [] = $form->input('titre','text','Titre de votre article','form-control','titre','Titre de l\'article','form-group','');
        $form_new [] = $form->textArea('articles','articles','form-control',10,50,'Vous pouvez saisir votre article','articles','Saisir votre article','form-group');
        $form_new [] = $form->submit('addposts','btn btn-success');
        return $form_new;
    }

    public function EditComment($titre,$contain){
        $form = new FormType();
        $form_edit = [];
        $form_edit [] = $form->input('titre','text','Titre de votre article','form-control','titre','Titre de l\'article','form-group',$titre);
        $form_edit [] = $form->textArea('articles','articles','form-control',10,50,$contain,'articles','Saisir votre article','form-group');
        $form_edit [] = $form->submit('editposts','btn btn-success');
        return $form_edit;
    }
}