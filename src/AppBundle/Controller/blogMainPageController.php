<?php
/**
 * Created by PhpStorm.
 * User: Kensaj
 * Date: 28.11.2017
 * Time: 17:01
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class blogMainPageController
{
    /**
     * @Route("/blog")
     */

    public function showAction()
    {
        return new Response('Testy testy');
    }

}