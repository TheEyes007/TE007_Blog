<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/05/2018
 * Time: 20:20
 */

namespace App\Controller;

use \App;
use App\Repository\CommentsRepository;

class ManageCommentsController extends AppController
{

    public function indexAction()
    {
        $request = new CommentsRepository();
        $data = $request->allComments();
        $this->render('backend.liste_commentaires', compact('data'));
    }

    public function deleteCommentsAction($id)
    {
        $request = new CommentsRepository();
        $request->deleteComments(htmlspecialchars($id), 'blog_comments');
        $routing = New \Core\Router\Routing();
        $routing->redirectToRoute('backoffice/comments');
    }

    public function alertCommentsAction($id)
    {
        $request = new CommentsRepository();
        $data = $request->alertSelectComments(htmlspecialchars($id),'blog_comments');

        if ($data[0]->alert === '0')
            {
                $request->alertComments('1', htmlspecialchars($id), 'blog_comments');
            }
        else
            {
                $request->alertComments('0', htmlspecialchars($id), 'blog_comments');
            }

        $routing = New \Core\Router\Routing();
        $routing->redirectToRoute('backoffice/comments');
    }

    public function onePostAction($id)
    {
        $request = new CommentsRepository();
        $data = $request->oneComments($id, 'blog_comments');
        $this->render('backend.one_commentaire', compact('data'));

    }
}