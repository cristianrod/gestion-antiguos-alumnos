<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 13/05/2018
 * Time: 17:23
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class UsuarioRepository extends EntityRepository implements UserLoaderInterface
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

    public function findByNombre(int $pagina): Pagerfanta
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.nombre', 'ASC')
            ->getQuery()
        ;
        return $this->paginacion($query, $pagina);
    }

    public function paginacion(Query $query, int $pagina)
    {
        $paginacion = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginacion = $paginacion->setMaxPerPage(5);
        $paginacion = $paginacion->setCurrentPage($pagina);

        return $paginacion;
    }
}