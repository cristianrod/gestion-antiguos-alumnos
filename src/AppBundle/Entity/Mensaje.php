<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 07/06/2018
 * Time: 19:35
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mensajes")
 * @ORM\Entity
 * Class Mensaje
 * @package AppBundle\Entity
 */
class Mensaje
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $mensajepor;

    /**
     * @ORM\Column(type="string")
     */
    private $mensajepara;

    /**
     * @ORM\Column(type="string")
     */
    private $asunto;

    /**
     * @ORM\Column(type="string")
     */
    private $contenido;

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
    public function getMensajepor()
    {
        return $this->mensajepor;
    }

    /**
     * @param mixed $mensajepor
     */
    public function setMensajepor($mensajepor)
    {
        $this->mensajepor = $mensajepor;
    }

    /**
     * @return mixed
     */
    public function getMensajepara()
    {
        return $this->mensajepara;
    }

    /**
     * @param mixed $mensajepara
     */
    public function setMensajepara($mensajepara)
    {
        $this->mensajepara = $mensajepara;
    }

    /**
     * @return mixed
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * @param mixed $asunto
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

    /**
     * @return mixed
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * @param mixed $contenido
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }
}