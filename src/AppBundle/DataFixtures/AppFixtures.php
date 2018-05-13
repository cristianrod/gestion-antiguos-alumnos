<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 09/05/2018
 * Time: 18:10
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $usuario = new Usuario();

        $usuario->setEmail('usuario@usuario.com');
        $usuario->setUsername('usuario');
        $usuario->setIsActive(true);
        $usuario->setPassword($this->encoder->encodePassword($usuario, 'usuario'));

        $manager->persist($usuario);

        $manager->flush();
    }
}