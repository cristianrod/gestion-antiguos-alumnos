<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 13/05/2018
 * Time: 17:20
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 * @UniqueEntity("nif")
 * @Vich\Uploadable
 * Class Usuario
 * @package AppBundle\Entity
 */
class Usuario extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $esAlumno;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Regex(
     *     pattern="/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i"
     * )
     * @Assert\NotBlank()
     */
    private $nif;

    /**
     * @Assert\Regex(
     *     pattern="/[0-9]/",
     *     match=false
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @Assert\Regex(
     *     pattern="/[0-9]/",
     *     match=false
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50)
     */
    private $apellido1;

    /**
     * @Assert\Regex(
     *     pattern="/[0-9]/",
     *     match=false
     * )
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50)
     */
    private $apellido2;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^(\+34|0034|34)?[6|7][0-9]{8}$/"
     * )
     */
    private $movil;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $fotografia;
    /**
     * @Vich\UploadableField(mapping="usuarios_foto", fileNameProperty="fotografia")
     * @Assert\Image()
     */
    private $fichero;
    /**
     * @return mixed
     */
    public function getFichero(): ?File
    {
        return $this->fichero;
    }
    /**
     * @param null $foto
     */
    public function setFichero($foto = null): void
    {
        $this->fichero = $foto;
        if (null !== $foto) {
            $this->fechaSubida = new \DateTimeImmutable();
        }
    }
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaSubida;

    /**
     * @ORM\OneToOne(targetEntity="Curriculum", mappedBy="alumno")
     */
    private $curriculum;

    public function __construct()
    {
        parent::__construct();
    }

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
    public function getEsAlumno()
    {
        return $this->esAlumno;
    }

    /**
     * @param mixed $esAlumno
     */
    public function setEsAlumno($esAlumno): void
    {
        $this->esAlumno = $esAlumno;
    }

    /**
     * @return mixed
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * @param mixed $nif
     */
    public function setNif($nif): void
    {
        $this->nif = $nif;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * @param mixed $apellido1
     */
    public function setApellido1($apellido1): void
    {
        $this->apellido1 = $apellido1;
    }

    /**
     * @return mixed
     */
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * @param mixed $apellido2
     */
    public function setApellido2($apellido2): void
    {
        $this->apellido2 = $apellido2;
    }

    /**
     * @return mixed
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * @param mixed $movil
     */
    public function setMovil($movil): void
    {
        $this->movil = $movil;
    }

    /**
     * @return mixed
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * @param mixed $fotografia
     */
    public function setFotografia($fotografia): void
    {
        $this->fotografia = $fotografia;
    }


}