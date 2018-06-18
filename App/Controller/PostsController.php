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
        $request = new PostsRepository();
        $data = $request->allPosts('blog_posts');
        $this->render('frontend.home', compact('data'));
    }

    public function postsAction(){
        $this->render('frontend.post');
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

        if (isset($_POST['addcomments'])) {
            if (!empty($_POST['titre']) AND !empty($_POST['commentaires'])) {
                $request_comment->addComments(1, $id, htmlspecialchars(addslashes($_POST['titre'])), htmlspecialchars(addslashes($_POST['commentaires'])), 'blog_comments');
                $routing->redirectToRoute('posts/'.$id);
            } else {
                echo "Vous n'avez pas saisi tous les champs du formulaires.";
                $this->render('frontend.articles', compact('data','data_comments','data_alert'));
            }
        } else {
            $this->render('frontend.articles', compact('data','data_comments','data_alert'));
        }

    }

    public function alertComments($id)
    {
        $routing = New \Core\Router\Routing();
        $request_comment = new CommentsRepository();

        $request_comment->countAlertComments($id,'blog_comments');
        $routing->redirectPreviousRoute();
    }

    public function registerAction()
    {
        $registerUser = new \Core\ManageUser\Controller\ManageUserController();
        $user_request = $registerUser->register();
    }
}