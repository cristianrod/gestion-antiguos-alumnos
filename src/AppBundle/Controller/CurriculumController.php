<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Curriculum;
use AppBundle\Form\CurriculumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/curriculum")
 * Class CurriculumController
 * @package AppBundle\Controller
 */
class CurriculumController extends Controller
{
    /**
     * @Route("/crear", name="curriculum_new")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newCurriculumAction(Request $request)
    {
        if ($this->getUser()->getCurriculum()){
            return $this->redirectToRoute('curriculum_edit');
        }

        $curriculum = new Curriculum();

        $form = $this->createForm(CurriculumType::class, $curriculum)
            ->add('crearcv', SubmitType::class, [
            'label' => 'Crear Currículum',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]);

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

    /**
     * @Route("/editar", name="curriculum_edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editCurriculumAction(Request $request)
    {
        $user = $this->getUser();

        $curriculum = $user->getCurriculum();

        $form = $this->createForm(CurriculumType::class, $curriculum)
            ->add('editarcv', SubmitType::class, [
            'label' => 'Editar Currículum',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('fos_user_profile_show');
        }
        return $this->render('curriculum/edit.html.twig',[
            'curriculum' => $curriculum,
            'form' => $form->createView(),
        ]);
    }
}
