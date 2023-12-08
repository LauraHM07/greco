<?php

namespace App\DataFixtures;

use App\Factory\HistorialFactory;
use App\Factory\LocalizacionFactory;
use App\Factory\MaterialFactory;
use App\Factory\PersonaFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        LocalizacionFactory::createMany(10);
        MaterialFactory::createMany(10, function() {
            return [
              'localizacion' => LocalizacionFactory::random()
            ];
        });

        PersonaFactory::createOne([
            'nombre_usuario' => 'ADMIN',
            'clave' => 'CLAVEADMIN',
            'nombre' => 'ADMIN',
            'apellidos' => 'ADMIN',
            'administrador' => 1,
            'gestor_prestamos' => 1
        ]);
        PersonaFactory::createOne([
            'nombre_usuario' => 'GESTOR',
            'clave' => 'CLAVEGESTOR',
            'nombre' => 'GESTOR',
            'apellidos' => 'GESTOR',
            'administrador' => 0,
            'gestor_prestamos' => 1
        ]);

        PersonaFactory::createMany(8);

        $manager->flush();
    }
}
