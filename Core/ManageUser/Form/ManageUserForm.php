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

}