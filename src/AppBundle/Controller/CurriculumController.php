<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Curriculum;
use AppBundle\Entity\Usuario;
use AppBundle\Form\CurriculumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CurriculumController extends Controller
{
    /**
     * @Route("/curriculum/crear", name="curriculum_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newCurriculumAction(Request $request)
    {
        $curriculum = new Curriculum();

        $form = $this->createForm(CurriculumType::class, $curriculum);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $curriculum = $form->getData();
            $user = $this->getUser();
            $curriculum->setAlumno($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($curriculum);
            $em->flush();
            return $this->redirectToRoute('fos_user_profile_show');
        }
        return $this->render('curriculum/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
