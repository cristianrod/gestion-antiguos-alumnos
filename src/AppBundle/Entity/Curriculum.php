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
     * @ORM\Column(type="string", nullable=true, length=100)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $poblacion;

    /**
     * @ORM\Column(type="date")
     */
    private $fechanacimiento;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $experiencias;

    /**
     * @ORM\Column(type="array")
     */
    private $formaciones;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $lenguajes;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $sistemas;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $basesdedatos;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $programacionweb;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $compcomunicativas;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $comporganizativas;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $comppersonales;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $infoadiccional;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $sexo;

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

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * @param mixed $poblacion
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    }

    /**
     * @return mixed
     */
    public function getFechanacimiento()
    {
        return $this->fechanacimiento;
    }

    /**
     * @param mixed $fechanacimiento
     */
    public function setFechanacimiento($fechanacimiento)
    {
        $this->fechanacimiento = $fechanacimiento;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getFormaciones()
    {
        return $this->formaciones;
    }

    /**
     * @param mixed $formaciones
     */
    public function setFormaciones($formaciones)
    {
        $this->formaciones = $formaciones;
    }

    /**
     * @return mixed
     */
    public function getLenguajes()
    {
        return $this->lenguajes;
    }

    /**
     * @param mixed $lenguajes
     */
    public function setLenguajes($lenguajes)
    {
        $this->lenguajes = $lenguajes;
    }

    /**
     * @return mixed
     */
    public function getSistemas()
    {
        return $this->sistemas;
    }

    /**
     * @param mixed $sistemas
     */
    public function setSistemas($sistemas)
    {
        $this->sistemas = $sistemas;
    }

    /**
     * @return mixed
     */
    public function getBasesdedatos()
    {
        return $this->basesdedatos;
    }

    /**
     * @param mixed $basesdedatos
     */
    public function setBasesdedatos($basesdedatos)
    {
        $this->basesdedatos = $basesdedatos;
    }

    /**
     * @return mixed
     */
    public function getProgramacionweb()
    {
        return $this->programacionweb;
    }

    /**
     * @param mixed $programacionweb
     */
    public function setProgramacionweb($programacionweb)
    {
        $this->programacionweb = $programacionweb;
    }

    /**
     * @return mixed
     */
    public function getCompcomunicativas()
    {
        return $this->compcomunicativas;
    }

    /**
     * @param mixed $compcomunicativas
     */
    public function setCompcomunicativas($compcomunicativas)
    {
        $this->compcomunicativas = $compcomunicativas;
    }

    /**
     * @return mixed
     */
    public function getComporganizativas()
    {
        return $this->comporganizativas;
    }

    /**
     * @param $comporganizativas
     */
    public function setComporganizativas($comporganizativas)
    {
        $this->comporganizativas = $comporganizativas;
    }

    /**
     * @return mixed
     */
    public function getComppersonales()
    {
        return $this->comppersonales;
    }

    /**
     * @param mixed $comppersonales
     */
    public function setComppersonales($comppersonales)
    {
        $this->comppersonales = $comppersonales;
    }

    /**
     * @return mixed
     */
    public function getInfoadiccional()
    {
        return $this->infoadiccional;
    }

    /**
     * @param mixed $infoadiccional
     */
    public function setInfoadiccional($infoadiccional)
    {
        $this->infoadiccional = $infoadiccional;
    }
}