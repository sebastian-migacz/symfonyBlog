<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction(Request $request)
    {
        /*
      $qb = $this->getDoctrine()
          ->getManager()
          ->createQueryBuilder()
          ->from('AppBundle:Post', 'p')
          ->select('p');

      $paginator = $this->get('knp_paginator');
      $pagination = $paginator->paginate(
          $qb,
          $request->query->get('page',1),
          20
      ); */

        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT p FROM AppBundle:Post p";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('default/index.html.twig', array(
            'posts' => $pagination
        ));
    }

    /**
     * @Route("/article/{id}", name="post_show")
     */

    public function showAction(\AppBundle\Entity\Post $post, Request $request)
    {
        $comment = new Comment();
        $comment->setPost($post);

        if($user = $this->getUser()) {
            $comment->setUser($user);
        }


        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);


        if($form->isValid(1)) {
           $em=$this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $this->addFlash("string", "succes!");
            return $this->redirectToRoute('post_show', array('id' =>$post->getId()));
        }

        return $this->render('default/show.html.twig', array(
            'post' => $post,
            'form' => $form->createView()
        ));
    }

}

