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
        $routing = New \Core\Router\Routing();
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new CommentsRepository();
                    $data = $request->allComments();
                    $this->render('backend.liste_commentaires', compact('data'));
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
    }

    public function deleteCommentsAction($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new CommentsRepository();
                    $request->deleteComments(htmlspecialchars($id), 'blog_comments');
                    $routing->redirectToRoute('backoffice/comments');
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function alertCommentsAction($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new CommentsRepository();
                    $data = $request->alertSelectComments(htmlspecialchars($id),'blog_comments');
                    $verifComments = $request->alertControlCountComments(htmlspecialchars($id), htmlspecialchars($_SESSION['user_key']));
                    if ($data[0]->alert === '0')
                        {
                            if (intval($verifComments[0]->nbalertcomments) === 0) {
                                $request->addAlertComments(htmlspecialchars($id),htmlspecialchars($_SESSION['user_key']),'blog_warningcomments');
                                $request->alertComments('1', htmlspecialchars($id), 'blog_comments');
                                }
                        }
                    else
                        {
                            $request->alertComments('0', htmlspecialchars($id), 'blog_comments');
                            $request->AdminDeleteAlertComments(htmlspecialchars($id),'blog_warningcomments');
                        }

                    $routing->redirectToRoute('backoffice/comments');
                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

    public function oneCommentsAction($id)
    {
        $routing = New \Core\Router\Routing();
        if (!session_id()) {
            session_start();
            if (!empty($_SESSION)) {
                if ($_SESSION['ROLE'] === '1') {
                    $request = new CommentsRepository();
                    $data = $request->oneComments(htmlspecialchars($id), 'blog_comments');
                    $this->render('backend.one_commentaire', compact('data'));

                } else {
                    $routing->redirectToRoute('404');
                }
            } else {
                $routing->redirectToRoute('404');
            }
        }
    }

}