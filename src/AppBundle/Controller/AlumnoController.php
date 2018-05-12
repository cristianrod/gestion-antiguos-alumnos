<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Alumno;
use AppBundle\Repository\AlumnoRespository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/alumnos")
 * Class AlumnoController
 * @package AppBundle\Controller
 */
class AlumnoController extends Controller
{
    /**
     * @Route("/", name="alumnos")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $pagina = $request->query->getInt('p', 1);
        $alumnos = $this->getDoctrine()->getRepository(Alumno::class);
        $alumnos = $alumnos->findByNombre($pagina);

        return $this->render("alumno/index.html.twig", [
            'alumnos' => $alumnos
        ]);
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"}, name="alumnos_show")
     * @Method("GET")
     * @param Alumno $alumno
     * @return Response
     */
    public function showAction(Alumno $alumno): Response
    {
        return $this->render('', [
            'alumno' => $alumno,
        ]);
    }
}
