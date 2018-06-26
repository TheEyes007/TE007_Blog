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
use App\Repository\CommentsRepository;


class PostsController extends AppController
{
    public function indexAction()
    {
        if (!session_id()) {
            session_start();
            $request = new PostsRepository();
            $data = $request->allPosts('blog_posts');
            $this->render('frontend.home', compact('data'));
        }
    }


    public function contactsAction(){
        $this->render('frontend.contacts');
    }

    public function articlesAction($id)
    {
        $request = new PostsRepository();
        $request_comment = new CommentsRepository();
        $routing = New \Core\Router\Routing();
        $data = $request->onePosts($id, 'blog_posts');
        $data_comments = $request->commentsByArticle($id);
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if (isset($_POST['addcomments'])) {
                    if (!empty($_POST['titre']) AND !empty($_POST['commentaires'])) {
                        $request_comment->addComments(htmlspecialchars($_SESSION['user_key']), htmlspecialchars($id), htmlspecialchars(addslashes($_POST['titre'])), htmlspecialchars(addslashes($_POST['commentaires'])), 'blog_comments');
                        $routing->redirectToRoute('posts/' . $id);
                    } else {
                        echo "Vous n'avez pas saisi tous les champs du formulaires.";
                        $this->render('frontend.articles', compact('data', 'data_comments'));
                    }
                } else {
                    $this->render('frontend.articles', compact('data', 'data_comments'));
                }
            }else{
                $this->render('frontend.articles', compact('data', 'data_comments'));
            }
        }
    }

    public function alertComments($id)
    {
        $routing = New \Core\Router\Routing();

        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                $request_comment = new CommentsRepository();
                $countComments = $request_comment->alertControlCountComments(htmlspecialchars($id), htmlspecialchars($_SESSION['user_key']));
                $nbNbAlert = $request_comment->alertSelectComments(htmlspecialchars($id));
                if (intval($countComments[0]->nbalertcomments) > 0) {
                    if(intval($nbNbAlert[0]->nb_alert) === 1) {
                        $request_comment->alertComments('0', htmlspecialchars($id), 'blog_comments');
                        $request_comment->deleteAlertComments(htmlspecialchars($id),htmlspecialchars($_SESSION['user_key']),'blog_warningcomments');
                        $request_comment->deleteNbAlertComments();
                    }
                    else{
                        $request_comment->deleteAlertComments(htmlspecialchars($id),htmlspecialchars($_SESSION['user_key']),'blog_warningcomments');
                    }
                } else {
                    $request_comment->addAlertComments(htmlspecialchars($id),htmlspecialchars($_SESSION['user_key']),'blog_warningcomments');
                    $request_comment->alertComments('1',htmlspecialchars($id),'blog_comments');
                }
            }
        }
        $routing->redirectPreviousRoute();
    }

    public function registerAction()
    {
        $registerUser = new \Core\ManageUser\Controller\ManageUserController();
        $user_request = $registerUser->register();
    }

    public function loginAction()
    {
        $loginUser = new \Core\ManageUser\Controller\ManageUserController();
        $user_request = $loginUser->login();
    }

    public function logoutAction()
    {
        $loginUser = new \Core\ManageUser\Controller\ManageUserController();
        $user_request = $loginUser->logout();
    }
}