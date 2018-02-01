<?php
/**
 * Created by PhpStorm.
 * User: Kensaj
 * Date: 28.11.2017
 * Time: 17:01
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class blogMainPageController extends Controller
{
    /**
     * @Route("/blog")
     */

    public function showAction()
    {
        $templating = $this->container->get('templating');
        $html = $templating->render('blog/mainView.html.twig');
        return new Response($html);
    }

}