<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 09/05/2018
 * Time: 18:10
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Provincia;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppFixtures extends Fixture implements ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null){
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $provincias = $this->generarProvincias();
        $provincias_lenght = count($provincias);
        for ($i = 0; $i < $provincias_lenght; $i++) {
            $provincia = new Provincia();
            $provincia->setNombre($provincias[$i]);
            $manager->persist($provincia);
        }

        $userManager = $this->container->get('fos_user.user_manager');

        $usuario = $userManager->createUser();

        $usuario->setEsAlumno(false);
        $usuario->setNif('49123344A');
        $usuario->setNombre('admin');
        $usuario->setApellido1('admin');
        $usuario->setApellido2('admin');
        $usuario->setMovil('600000000');
        $usuario->setEnabled(true);
        $usuario->setRoles(['ROLE_SUPER_ADMIN']);
        $usuario->setEmail('admin@admin.com');
        $usuario->setUsername('admin');
        $usuario->setPlainPassword('admin');

        $userManager->updateUser($usuario, true);
    }

    public function generarProvincias()
    {
        return ['Álava','Albacete','Alicante','Almería','Asturias','Ávila','Badajoz','Barcelona','Burgos','Cáceres','Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','La Coruña','Cuenca','Gerona','Granada','Guadalajara','Guipúzcoa','Huelva','Huesca','Islas Baleares','Jaén','León','Lérida','Lugo','Madrid','Málaga','Murcia','Navarra','Orense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Segovia','Sevilla','Soria','Tarragona','Santa Cruz de Tenerife','Teruel','Toledo','Valencia','Valladolid','Vizcaya','Zamora','Zaragoza'];
    }
}