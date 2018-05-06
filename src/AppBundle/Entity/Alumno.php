<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 06/05/2018
 * Time: 17:41
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

class Alumno
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var
     */
    private $id;


}