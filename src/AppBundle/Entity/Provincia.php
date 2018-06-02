<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 02/06/2018
 * Time: 16:09
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="provincias")
 */
class Provincia
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var
     * @ORM\Column(type="string")
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Curriculum", mappedBy="provincia")
     */
    private $curriculums;

    public function __construct()
    {
        $this->curriculums = new ArrayCollection();
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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getCurriculums()
    {
        return $this->curriculums;
    }
    public function addCurriculum(Curriculum $curriculum)
    {
        if ($this->curriculums->contains($curriculum)) {
            return;
        }
        $this->curriculums[] = $curriculum;
        $curriculum->setProvincia($this);
    }

    public function removeCurriculum(Curriculum $curriculum)
    {
        $this->curriculums->removeElement($curriculum);
        $curriculum->setProvincia(null);
    }
}