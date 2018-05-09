<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 09/05/2018
 * Time: 18:10
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Alumno;
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
        $alumno = new Alumno();

        $alumno->setEmail('alumno@gmail.com');
        $alumno->setUsername('alumno');
        $alumno->setIsActive(true);
        $alumno->setPassword($this->encoder->encodePassword($alumno, 'usuario'));

        $manager->persist($alumno);

        $manager->flush();
    }
}