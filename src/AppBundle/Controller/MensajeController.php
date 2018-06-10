<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Curriculum;
use AppBundle\Entity\Mensaje;
use AppBundle\Entity\Usuario;
use AppBundle\Form\MensajeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MensajeController
 * @package AppBundle\Controller
 */
class MensajeController extends Controller
{
    /**
     * @Route("/mensajes/enviar", name="mensajes_alumnos")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function enviarAction(Request $request, \Swift_Mailer $mailer)
    {
        $mensaje = new Mensaje();

        $form = $this->createForm(MensajeType::class, $mensaje)
            ->add('crearcv', SubmitType::class, [
                'label' => 'Enviar Mensaje',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $mensaje = $form->getData();
            $mensaje->setMensajepor($this->getUser()->getEmail());

            $repository = $this->getDoctrine()
                ->getRepository(Curriculum::class);

            if ($mensaje->getMensajePara()){
                $query = $repository->createQueryBuilder('c')
                    ->where('c.puntuacion >= ' . $mensaje->getMensajePara())
                    ->getQuery();
            }
            else{
                $query = $repository->createQueryBuilder('c')
                    ->getQuery();
            }

            $curriculums = $query->getResult();

            if (count($curriculums) > 0){
                foreach ($curriculums as $c){
                    $message = (new \Swift_Message($mensaje->getAsunto()))
                        ->setFrom($this->getUser()->getEmail())
                        ->setTo($c->getAlumno()->getEmail())
                        ->setBody($mensaje->getContenido(),'text/html')
                    ;
                    $mailer->send($message);
                }
                return $this->render('mensaje/sent.html.twig');
            }
        }
        return $this->render('mensaje/send.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/alumnos/mensaje/enviar/{id}", name="mensaje_alumno")
     * @param Request $request
     * @param Usuario $alumno
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function enviarAlumnoAction(Request $request, Usuario $alumno, \Swift_Mailer $mailer)
    {
        $mensaje = new Mensaje();

        $form = $this->createForm(MensajeType::class, $mensaje)
            ->add('enviarmensaje', SubmitType::class, [
                'label' => 'Enviar Mensaje',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $mensaje = $form->getData();
            $mensaje->setMensajepor($this->getUser()->getEmail());
            $message = (new \Swift_Message($mensaje->getAsunto()))
                ->setFrom($this->getUser()->getEmail())
                ->setTo($alumno->getEmail())
                ->setBody($mensaje->getContenido(),'text/html')
            ;
            $mailer->send($message);
            return $this->render('mensaje/sent.html.twig');
        }

        return $this->render('mensaje/alumno.html.twig', [
            'form' => $form->createView(),
            'alumno' => $alumno,
        ]);
    }
}
