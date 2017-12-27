<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }


    /**
     * @Route("/usuarios", name="usuarios")
     */
    public function usuariosAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }
}