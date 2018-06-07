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
     * @Route("/ver/{id}", name="alumnos_show")
     * @param Usuario $alumno
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showAction(Usuario $alumno)
    {
        return $this->render(":alumno:show.html.twig", [
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/enviar/mensaje")
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function emailAction(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hola Email'))
            ->setFrom('enviar@gmail.com')
            ->setTo('recibir@gmail.com')
            ->setBody('<h3>¡Te has registrado correctamente!</h3>');

        $mailer->send($message);

        return $this->redirectToRoute('alumnos_index');
    }
}
