<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/alumnos")
 * Class AlumnoController
 * @package AppBundle\Controller
 */
class AlumnoController extends Controller
{
    /**
     * @Route("/", name="alumnos_index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction(Request $request)
    {
        $pagina = $request->query->getInt('p', 1);
        $alumnos = $this->getDoctrine()->getRepository(Usuario::class);
        $alumnos = $alumnos->findAlumnoByNombre($pagina);

        return $this->render("alumno/index.html.twig", [
            'alumnos' => $alumnos,
        ]);
    }

    /**
     * @Route("/pdf/crear")
     * @return \TFox\MpdfPortBundle\Response\PDFResponse
     * @throws \Mpdf\MpdfException
     */
    public function pdfAction()
    {
        $html = $this->renderView('pdf/alumnos.html.twig');

        return new \TFox\MpdfPortBundle\Response\PDFResponse($this->getMpdfService()->generatePdf($html));
    }

    /**
     * @return \TFox\MpdfPortBundle\Service\PDFService
     */
    private function getMpdfService()
    {
        return $this->get('t_fox_mpdf_port.pdf');
    }
}
