<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends Controller
{
    /**
     * @Route("/", name="inicio")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/profile/pdf/crear")
     * @throws \Mpdf\MpdfException
     */
    public function pdfAction()
    {
        $user = $this->getUser();
        $html = $this->renderView('pdf/profile.html.twig', [
            'alumno' => $user,
        ]);

        $mpdf = new \Mpdf\Mpdf();

        $stylesheet = file_get_contents('../web/css/pdf.css');

        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);

        $mpdf->Output();
    }
}
