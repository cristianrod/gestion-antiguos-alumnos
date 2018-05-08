<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 08/05/2018
 * Time: 16:24
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class AlumnoRespository extends EntityRepository implements  UserLoaderInterface
{
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}