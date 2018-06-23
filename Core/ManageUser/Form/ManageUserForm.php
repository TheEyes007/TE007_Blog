<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 11:16
 */

namespace Core\ManageUser\Form;

use Core\Form\FormType;

class ManageUserForm
{
    public function NewUser()
    {
        $form = new FormType();
        $register = [];
        $register [] = $form->input('login','text','Saisissez votre login','form-control','login','Login','form-group','');
        $register [] = $form->input_other('password','Saisissez votre mot de passe', 'password','form-control','Mot de passe','Mot de passe','form-group','Mot de passe','Mot de passe','form-group');
        $register [] = $form->input_other('password','Confirmer votre mot de passe','confirm_password','form-control','Confirmer votre mot de passe','Confirmation','form-group');
        $register [] = $form->input_other('mail','Saisissez votre adresse mail','email','form-control','Email','Email','form-group');
        $register [] = $form->submit('adduser','btn btn-success');
        return $register;
    }

    public function ConnectUser()
    {
        $form = new FormType();
        $login = [];
        $login [] = $form->input('login','text','Saisissez votre login','form-control','login','Login','form-group','');
        $login [] = $form->input_other('password','Saisissez votre mot de passe', 'password','form-control','Mot de passe','Mot de passe','form-group','Mot de passe','Mot de passe','form-group');
        $login [] = $form->submit('loginuser','btn btn-success');
        return $login;
    }

    public function EditUser($name,$email)
    {
        $form = new FormType();
        $edit = [];
        $edit [] = $form->input('login','text','Saisissez votre login','form-control','login','Login','form-group',$name);
        $edit [] = $form->input('password','password', 'Saisissez votre mot de passe','form-control','Mot de passe','Mot de passe','form-group','');
        $edit [] = $form->input('confirm_password','password','Confirmer votre mot de passe','form-control','Confirmer votre mot de passe','Confirmation','form-group','');
        $edit [] = $form->input('email','Saisissez votre adresse mail','email','form-control','Email','Email','form-group',$email);
        $edit [] = $form->submit('edituser','btn btn-success');
        return $edit;
    }

    public function EditComment($titre,$contain){
        $form = new FormType();
        $form_edit = [];
        $form_edit [] = $form->input('titre','text','Titre de votre commentaire','form-control','titre','Titre du commentaire','form-group',$titre);
        $form_edit [] = $form->textArea('commentaires','commentaires','form-control',10,50,$contain,'commentaires','Saisir votre commentaire','form-group');
        $form_edit [] = $form->submit('editcomments','btn btn-success');
        return $form_edit;
    }

}