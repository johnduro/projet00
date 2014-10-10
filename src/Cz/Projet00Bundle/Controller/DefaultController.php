<?php

namespace Cz\Projet00Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CzProjet00Bundle:Default:index.html.twig', array('name' => $name));
    }
}
