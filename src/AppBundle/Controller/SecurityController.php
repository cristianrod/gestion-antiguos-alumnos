<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPassword());
            $usuario->setPassword($password);
            if(!$usuario->getEsAlumno()){
                $usuario->setRoles(['ROLE_PROFESOR']);
            }
            else{
                $usuario->setRoles(['ROLE_ALUMNO']);
            }
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();
            return $this->redirectToRoute('fos_user_security_login');
        }
        return $this->render(
            'security/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
