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
     * @ORM\Column(type="string", length=50)
     */
    private $datos;

    /**
     * @ORM\Column(type="array")
     */
    private $experiencias;

    /**
     * @ORM\OneToOne(targetEntity="Usuario", inversedBy="curriculum")
     */
    private $alumno;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDatos()
    {
        return $this->datos;
    }

    /**
     * @param mixed $datos
     */
    public function setDatos($datos)
    {
        $this->datos = $datos;
    }

    /**
     * @return mixed
     */
    public function getAlumno()
    {
        return $this->alumno;
    }

    /**
     * @param mixed $alumno
     */
    public function setAlumno($alumno)
    {
        $this->alumno = $alumno;
    }

    /**
     * @return mixed
     */
    public function getExperiencias()
    {
        return $this->experiencias;
    }

    /**
     * @param mixed $experiencias
     */
    public function setExperiencias($experiencias)
    {
        $this->experiencias = $experiencias;
    }

    public function removeExperiencia(Curriculum $experiencia)
    {
        $this->experiencias->removeElement($experiencia);
    }
}