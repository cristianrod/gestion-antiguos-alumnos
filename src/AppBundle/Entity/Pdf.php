<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 08/06/2018
 * Time: 17:17
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pdfs")
 * @ORM\Entity
 * Class Pdf
 * @package AppBundle\Entity
 */
class Pdf
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $pdfde;

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
    public function getPdfde()
    {
        return $this->pdfde;
    }

    /**
     * @param $pdfde
     */
    public function setPdfde($pdfde)
    {
        $this->pdfde = $pdfde;
    }
}