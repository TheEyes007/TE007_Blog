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
        $request = new PostsRepository();
        $data = $request->allPosts('blog_posts');
        $this->render('backend.liste_articles', compact('data'));
    }

    public function addPostAction()
    {
        $request = new PostsRepository();
        $routing = New \Core\Router\Routing();

        if (isset($_POST['addposts'])) {
            if (!empty($_POST['titre']) AND !empty($_POST['articles'])) {
                $request->addPosts(1, htmlspecialchars(addslashes($_POST['titre'])), htmlspecialchars(addslashes($_POST['articles'])), 'blog_posts');
                $routing->redirectToRoute('backoffice');
            } else {
                echo "Vous n'avez pas saisi tous les champs du formulaires.";
                $this->render('backend.addArticles');
            }
        } else {
            $this->render('backend.addArticles');
        }
    }

    public function deletePostAction($id)
    {
        $request = new PostsRepository();
        $request->deletePosts(htmlspecialchars($id), 'blog_posts');
        $routing = New \Core\Router\Routing();
        $routing->redirectToRoute('backoffice');
    }

    public function editPostAction($id)
    {
        $request = new PostsRepository();
        $routing = New \Core\Router\Routing();
        $form = new PostsForm();
        $data = $request->onePosts($id, 'blog_posts');

        if (isset($_POST['editposts'])) {
            if (!empty($_POST['titre']) AND !empty($_POST['articles'])) {
                $request->editPosts(1, htmlspecialchars(addslashes($_POST['titre'])), htmlspecialchars(addslashes($_POST['articles'])), 'blog_posts',$id);
                $routing->redirectToRoute('backoffice');
            } else {
                echo "Vous n'avez pas saisi tous les champs du formulaires.";
                $this->render('backend.editArticles');
            }
        } else {
            foreach($data as $ligne){
                $form = new PostsForm();
                $comments_form = $form->EditPost($ligne->title,$ligne->contains);
            }
            $this->render('backend.editArticles', compact('comments_form'));
        }

    }

    public function onePostAction($id)
    {
        $request = new PostsRepository();
        $data = $request->onePosts($id, 'blog_posts');
        $this->render('backend.one_article', compact('data'));

    }
}