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
use Core\ManageUser\Form\ManageUserForm;


class ManageUserController extends AppManageUserController
{

    public function login()
    {
        $request = new UserRepository();
        $routing = New \Core\Router\Routing();


        if (isset($_POST['loginuser'])) {
            if (!empty($_POST['login']) AND !empty($_POST['password'])) {
                $data = $request->loginUser(htmlspecialchars(addslashes($_POST['login'])),'blog_users');
                if (empty($data) === false)
                {
                    $password = $data[0]->password;
                    $salt = $data[0]->salt;
                    $active = $data[0]->active;

                    if($active === '1') {
                        if ($password === crypt(htmlspecialchars(addslashes($_POST['password'])), $salt)) {
                            if (!session_id()) {
                                    session_start();
                                $_SESSION['id'] = session_id();
                                $_SESSION['user_key'] = htmlspecialchars(addslashes($data[0]->id));
                                $_SESSION['login'] = htmlspecialchars(addslashes($data[0]->name));
                                $_SESSION['ROLE'] = htmlspecialchars(addslashes($data[0]->status));
                            }
                            $routing->redirectToRoute('');
                        } else {
                            echo '<div class="alert alert-warning text-center">Votre mot de passe est incorrect.</div>';
                            $this->render('frontend.login');

                        }
                    }else{
                        echo '<div class="alert alert-warning text-center">Votre compte n\'a pas été validé par l\'administrateur.</div>';
                        $this->render('frontend.login');
                    }
                }else{
                    echo '<div class="alert alert-warning text-center">Votre login est incorrect.</div>';
                    $this->render('frontend.login');
                }
            } else {
                echo '<div class="alert alert-warning text-center">Vous n\'avez pas saisi tous les champs du formulaires.</div>';
                $this->render('frontend.login');
            }
        }
        else
        {
            $this->render('frontend.login');
        }
    }

    public function register()
    {
        $request = new UserRepository();
        $routing = New \Core\Router\Routing();

        if (isset($_POST['adduser'])) {
            if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['confirm_password']) AND !empty($_POST['email']))
            {
                $data = $request->loginControlUser(htmlspecialchars(addslashes(strtolower($_POST['login']))),'blog_users');
                $nb_login = intval($data[0]->nb_login);
                if($nb_login === 0)
                {
                    if (htmlspecialchars(addslashes($_POST['password'])) === htmlspecialchars(addslashes($_POST['confirm_password']))) {
                        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                            echo '<div class="alert alert-warning text-center">Votre adresse n\'est pas conforme.</div>';
                            $this->render('frontend.register');
                        } else {
                            $request->addUser(
                                htmlspecialchars(addslashes($_POST['login'])),
                                htmlspecialchars(addslashes(strtolower($_POST['login']))),
                                htmlspecialchars(addslashes($_POST['email'])),
                                0,
                                0,
                                htmlspecialchars(addslashes($_POST['password'])),
                                sha1(microtime(true)),
                                'blog_users');
                            $routing->redirectToRoute('');
                        }
                    } else {
                        echo '<div class="alert alert-warning text-center">Vos mots de passe ne sont pas identiques.</div>';
                        $this->render('frontend.register');
                    }
                }
                else{
                    echo '<div class="alert alert-warning text-center">Votre nom est déjà utilisé.</div>';
                    $this->render('frontend.register');
                }

            } else {
                echo '<div class=\"alert alert-warning text-center\">Vous n\'avez pas saisi tous les champs du formulaires.</div>';
                $this->render('frontend.register');
            }
        } else {
            $this->render('frontend.register');
        }
    }

    public function logout()
    {
        $routing = New \Core\Router\Routing();

        if(!session_id()){
            session_start();
        }
            $_SESSION = array();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();

        $routing->redirectToRoute('');
    }

    public function UserAccount()
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                    $request = new UserRepository();
                    $data = $request->oneUser($_SESSION['user_key'], 'blog_users');
                    $this->render('backend.oneUser', compact('data'));

            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function UserAccountEdit()
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                $request = new UserRepository();
                $data_form = $request->oneUser(intval($_SESSION['user_key']), 'blog_users');

                if (isset($_POST['edituser'])) {
                    if (!empty($_POST['login']) AND !empty($_POST['password']) AND !empty($_POST['confirm_password']) AND !empty($_POST['email']))
                    {
                            if (htmlspecialchars(addslashes($_POST['password'])) === htmlspecialchars(addslashes($_POST['confirm_password']))) {
                                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                                    echo '<div class="alert alert-warning text-center">Votre adresse n\'est pas conforme.</div>';
                                    $this->render('frontend.register');
                                } else {
                                    $request->updateUser(
                                        htmlspecialchars(addslashes($_POST['login'])),
                                        htmlspecialchars(addslashes(strtolower($_POST['login']))),
                                        htmlspecialchars(addslashes($_POST['email'])),
                                        htmlspecialchars(addslashes($_POST['password'])),
                                        sha1(microtime(true)),
                                        'blog_users',$_SESSION['user_key']);
                                    $routing->redirectToRoute('');
                                }
                            } else {
                                echo '<div class="alert alert-warning text-center">Vos mots de passe ne sont pas identiques.</div>';
                                foreach ($data_form as $ligne) {
                                    $form = new ManageUserForm();
                                    $user_form = $form->EditUser($ligne->name, $ligne->email);
                                }
                                $this->render('backend.edit',compact('user_form'));
                            }
                    } else {
                        echo '<div class="alert alert-warning text-center">Vous n\'avez pas saisi tous les champs du formulaires.</div>';
                        foreach ($data_form as $ligne) {
                            $form = new ManageUserForm();
                            $user_form = $form->EditUser($ligne->name, $ligne->email);
                        }
                        $this->render('backend.edit',compact('user_form'));
                    }
                } else {
                    foreach ($data_form as $ligne) {
                        $form = new ManageUserForm();
                        $user_form = $form->EditUser($ligne->name, $ligne->email);
                    }
                    $this->render('backend.edit',compact('user_form'));
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function UserAccountDelete()
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] != '1') {
                    $request = new UserRepository();
                    $request->deleteUser(htmlspecialchars($_SESSION['user_key']), 'blog_users');
                    $this->logout();
                    $routing->redirectToRoute('');
                } else {
                    $routing->redirectToRoute('security');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function CommentsByUser()
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                $request = new UserRepository();
                $data = $request->allCommentsByUser($_SESSION['user_key']);
                $this->render('backend.usercomments', compact('data'));
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function CommentsDeleteByUser($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                    $request = new UserRepository();
                    $request->deleteComments($id,'blog_comments',$_SESSION['user_key']);
                    $routing->redirectToRoute('myaccount/comments');
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function CommentsViewByUser($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                    $request = new UserRepository();
                    $data = $request->oneCommentsByUser($id,$_SESSION['user_key']);
                    $this->render('backend.onecommentsuser', compact('data'));
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function CommentsEditByUser($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] != '1') {
                    $request = new UserRepository();
                    $data = $request->oneCommentsByUser($id,$_SESSION['user_key'] ,'blog_posts');

                    if (isset($_POST['editcomments'])) {
                        if (!empty($_POST['titre']) AND !empty($_POST['commentaires'])) {
                            $request->updateComments(htmlspecialchars(addslashes($_POST['titre'])), htmlspecialchars(addslashes($_POST['commentaires'])), 'blog_comments', $id,intval($_SESSION['user_key']));
                            $routing->redirectToRoute('backoffice');
                        } else {
                            echo "Vous n'avez pas saisi tous les champs du formulaires.";
                            $this->render('backend.onecommentsuseredit');
                        }
                    } else {
                        foreach ($data as $ligne) {
                            $form = new ManageUserForm();
                            $comments_form = $form->EditComment($ligne->title, $ligne->contains);
                        }
                        $this->render('backend.onecommentsuseredit', compact('comments_form'));
                    }
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }
}