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
        $data_comments = $request->commentsByArticle($id);
        $data = $request->onePosts($id, 'blog_posts');
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if (isset($_POST['addcomments'])) {
                    if (!empty($_POST['titre']) AND !empty($_POST['commentaires'])) {
                        $request_comment->addComments($_SESSION['user_key'], $id, htmlspecialchars(addslashes($_POST['titre'])), htmlspecialchars(addslashes($_POST['commentaires'])), 'blog_comments');
                        $routing->redirectToRoute('posts/' . $id);
                    } else {
                        echo "Vous n'avez pas saisi tous les champs du formulaires.";
                        $this->render('frontend.articles', compact('data', 'data_comments', 'data_alert'));
                    }
                } else {
                    $this->render('frontend.articles', compact('data', 'data_comments', 'data_alert'));
                }
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
                $verifComments = $request_comment->alertControlCountComments($id, $_SESSION['user_key']);
                $countAlert = $request_comment->alertSelectComments($id);
                if (intval($verifComments[0]->nbalertcomments) === 0) {
                    $request_comment->addAlertComments($id,$_SESSION['user_key'],'blog_warningcomments');
                    if(intval($countAlert[0]->nb_alert) === 0){
                        $request_comment->alertComments('1',$id,'blog_comments');
                    }
                } else {
                    if(intval($countAlert[0]->nb_alert) === 1) {
                        $request_comment->deleteAlertComments($id,$_SESSION['user_key'],'blog_warningcomments');
                        $request_comment->InitDeleteAlertComments();
                        $request_comment->alertComments('0', $id, 'blog_comments');
                    }
                    else{
                        $request_comment->deleteAlertComments($id,$_SESSION['user_key'],'blog_warningcomments');
                    }
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