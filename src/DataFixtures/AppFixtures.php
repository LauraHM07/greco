<?php

namespace App\DataFixtures;

use App\Factory\LocalizacionFactory;
use App\Factory\MaterialFactory;
use App\Factory\PersonaFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // --------- PISOS

        $piso1 = LocalizacionFactory::createOne([
            'codigo' => 'ALJ731',
            'nombre' => 'Piso 1',
            'descripcion' => '',
            'localizacionPadre' => null
        ]);
        $piso2 = LocalizacionFactory::createOne([
            'codigo' => 'YUY612',
            'nombre' => 'Piso 2',
            'descripcion' => '',
            'localizacionPadre' => null
        ]);

        // --------- SALAS

        $sala11 = LocalizacionFactory::createOne([
            'codigo' => 'PHE049',
            'nombre' => 'Sala 1',
            'descripcion' => 'Piso 1',
            'localizacionPadre' => $piso1
        ]);
        $sala21 = LocalizacionFactory::createOne([
            'codigo' => 'VJS966',
            'nombre' => 'Sala 2',
            'descripcion' => 'Piso 1',
            'localizacionPadre' => $piso1
        ]);
        $sala12 = LocalizacionFactory::createOne([
            'codigo' => 'QAV756',
            'nombre' => 'Sala 1',
            'descripcion' => 'Piso 2',
            'localizacionPadre' => $piso2
        ]);
        $sala22 = LocalizacionFactory::createOne([
            'codigo' => 'UID956',
            'nombre' => 'Sala 2',
            'descripcion' => 'Piso 2',
            'localizacionPadre' => $piso2
        ]);

        // --------- MUEBLES/ARMARIOS...

        LocalizacionFactory::createOne([
            'codigo' => 'GTE990',
            'nombre' => 'Estantería B',
            'descripcion' => 'Piso 1 - Sala 1',
            'localizacionPadre' => $sala11
        ]);
        LocalizacionFactory::createOne([
            'codigo' => 'SBS284',
            'nombre' => 'Gabinete Secundario',
            'descripcion' => 'Piso 2 - Sala 1',
            'localizacionPadre' => $sala21
        ]);
        LocalizacionFactory::createOne([
            'codigo' => 'UBQ480',
            'nombre' => 'Armario Rojo',
            'descripcion' => 'Piso 2 - Sala 1',
            'localizacionPadre' => $sala21
        ]);
        LocalizacionFactory::createOne([
            'codigo' => 'LSP994',
            'nombre' => 'Armario Azul',
            'descripcion' => 'Piso 2 - Sala 2',
            'localizacionPadre' => $sala22
        ]);

        // --------- MATERIALES

        MaterialFactory::createMany(10, function() {
            return [
              'localizacion' => LocalizacionFactory::random()
            ];
        });

        // --------- ADMIN Y GESTOR

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

        // --------- PERSONAS

        PersonaFactory::createMany(8);

        $manager->flush();
    }
}
