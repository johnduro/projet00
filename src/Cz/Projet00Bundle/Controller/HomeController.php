<?php

namespace Cz\Projet00Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Cz\Projet00Bundle\Entity\filmDownloader;
use Cz\Projet00Bundle\Form\filmDownloaderType;

class HomeController extends Controller
{
    public function startDownloadAction(Request $request)
    {
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
