<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 15/05/2018
 * Time: 19:01
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="curriculums")
 * @ORM\Entity
 * Class Curriculum
 * @package AppBundle\Entity
 */
class Curriculum
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Usuario", inversedBy="curriculum")
     */
    private $alumno;
}