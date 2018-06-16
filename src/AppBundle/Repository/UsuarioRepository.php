<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 13/05/2018
 * Time: 17:23
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class UsuarioRepository extends EntityRepository
{
    public function findAlumnoByNombre(int $pagina): Pagerfanta
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.esAlumno = true')
            ->orderBy('a.nombre', 'ASC')
            ->getQuery()
        ;
        return $this->paginacion($query, $pagina);
    }

    public function findAlumnoByUsuario(int $pagina, string $usuario, string $tipo)
    {
        $query = $this->createQueryBuilder('a')
            ->addSelect('a')
            ->andWhere("a.{$tipo} = :usuario")
            ->andWhere('a.esAlumno = true')
            ->setParameter('usuario', $usuario)
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