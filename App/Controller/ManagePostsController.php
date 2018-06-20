<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/05/2018
 * Time: 20:20
 */

namespace App\Controller;

use \App;
use App\Repository\PostsRepository;
use App\Form\PostsForm;

class ManagePostsController extends AppController
{
    public function indexAction()
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new PostsRepository();
                    $data = $request->allPosts('blog_posts');
                    $this->render('backend.liste_articles', compact('data'));
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function addPostAction()
    {

        $routing = New \Core\Router\Routing();

        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new PostsRepository();
                    if (isset($_POST['addposts'])) {
                        if (!empty($_POST['titre']) AND !empty($_POST['articles'])) {
                            $request->addPosts(intval($_SESSION['user_key']), htmlspecialchars(addslashes($_POST['titre'])), htmlspecialchars(addslashes($_POST['articles'])), 'blog_posts');
                            $routing->redirectToRoute('backoffice');
                        } else {
                            echo "Vous n'avez pas saisi tous les champs du formulaires.";
                            $this->render('backend.addArticles');
                        }
                    } else {
                        $this->render('backend.addArticles');
                    }
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function deletePostAction($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new PostsRepository();
                    $request->deletePosts(htmlspecialchars($id), 'blog_posts');
                    $routing->redirectToRoute('backoffice');
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function editPostAction($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new PostsRepository();
                    $data = $request->onePosts($id, 'blog_posts');

                    if (isset($_POST['editposts'])) {
                        if (!empty($_POST['titre']) AND !empty($_POST['articles'])) {
                            $request->editPosts(intval($_SESSION['user_key']), htmlspecialchars(addslashes($_POST['titre'])), htmlspecialchars(addslashes($_POST['articles'])), 'blog_posts', $id);
                            $routing->redirectToRoute('backoffice');
                        } else {
                            echo "Vous n'avez pas saisi tous les champs du formulaires.";
                            $this->render('backend.editArticles');
                        }
                    } else {
                        foreach ($data as $ligne) {
                            $form = new PostsForm();
                            $comments_form = $form->EditPost($ligne->title, $ligne->contains);
                        }
                        $this->render('backend.editArticles', compact('comments_form'));
                    }
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function onePostAction($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new PostsRepository();
                    $data = $request->onePosts($id, 'blog_posts');
                    $this->render('backend.one_article', compact('data'));
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function accountAction()
    {
        $accountUser = new \Core\ManageUser\Controller\ManageUserController();
        $user_request = $accountUser->UserAccount();
    }

    public function accountEditAction()
    {
        $accountUser = new \Core\ManageUser\Controller\ManageUserController();
        $user_request = $accountUser->UserAccountEdit();
    }
}