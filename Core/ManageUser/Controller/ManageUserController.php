<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/05/2018
 * Time: 20:20
 */

namespace Core\ManageUser\Controller;

use \Core;
use Core\ManageUser\Repository\UserRepository;


class ManageUserController extends AppManageUserController
{

    public function register()
    {
        $request = new UserRepository();
        $routing = New \Core\Router\Routing();

        if (isset($_POST['adduser'])) {
            if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['confirm_password']) AND !empty($_POST['email']))
            {
                if(htmlspecialchars(addslashes($_POST['password'])) === htmlspecialchars(addslashes($_POST['confirm_password'])))
                {
                    if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) === false)
                    {
                        echo "Votre adresse email n'est pas conforme.";
                        $this->render('frontend.register');
                    }
                    else{
                    $request->addUser(
                        htmlspecialchars(addslashes($_POST['login'])),
                        htmlspecialchars(addslashes(strtolower ($_POST['login']))),
                        htmlspecialchars(addslashes($_POST['email'])),
                        0,
                        0,
                        htmlspecialchars(addslashes($_POST['password'])),
                        sha1(microtime(true)),
                        'blog_users');
                    $routing->redirectToRoute('');
                    }
                }
                else
                {
                    echo "Vos mots de passe ne sont pas identiques.";
                    $this->render('frontend.register');
                }

            } else {
                echo "Vous n'avez pas saisi tous les champs du formulaires.";
                $this->render('frontend.register');
            }
        } else {
            $this->render('frontend.register');
        }
    }
}