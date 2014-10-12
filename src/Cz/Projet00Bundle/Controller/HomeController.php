<?php

namespace Cz\Projet00Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Cz\Projet00Bundle\Entity\filmDownloader;
use Cz\Projet00Bundle\Form\filmDownloaderType;

use \DateTime;

class HomeController extends Controller
{
    public function startDownloadAction(Request $request)
    {
        $filmDownloader = new filmDownloader();
        $form = $this->get('form.factory')->create(new filmDownloaderType(), $filmDownloader);
        $form->handleRequest($request);
        if ($form->isValid())
        {
            $filmDownloader->setUser($this->getUser());
            $filmDownloader->setDowloadedState(0);
            $filmDownloader->setDownloadDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($filmDownloader);
            $em->flush();
        }
        return new Response("YOLOOO");
    }

    public function downloadAction()
    {
        $filmDownloader = new filmDownloader();
        $form = $this->get('form.factory')->create(new filmDownloaderType(), $filmDownloader, array('action' => $this->generateUrl('cz_projet00_start_download')));
        return $this->render('CzProjet00Bundle:Download:uploadTorrent.html.twig',
        array('form' => $form->createView()));
    }

    public function indexAction()
    {
        return $this->render('CzProjet00Bundle::layout.html.twig');
    }
}
