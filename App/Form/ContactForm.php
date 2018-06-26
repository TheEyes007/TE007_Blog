<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 03/06/2018
 * Time: 11:16
 */

namespace App\Form;

use Core\Form\FormType;

class ContactForm
{
    public function NewContact(){
        $form = new FormType();
        $form_new = [];
        $form_new [] = $form->input('nom','text','Saisissez votre nom','form-control','nom','Votre nom','form-group','');
        $form_new [] = $form->input('mail','text','Saisissez votre email','form-control','email','Votre mail','form-group','');
        $form_new [] = $form->textArea('message','messge','form-control',10,50,'Vous pouvez saisir votre message','message','Saisir votre message','form-group');
        $form_new [] = $form->submit('addmessage','btn btn-success');
        return $form_new;
    }
}