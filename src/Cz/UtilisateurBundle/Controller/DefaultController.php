<?php

namespace Cz\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CzUtilisateurBundle:Default:index.html.twig', array('name' => $name));
    }
}
