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
            'descripcion' => null,
            'localizacionPadre' => null
        ]);
        $piso2 = LocalizacionFactory::createOne([
            'codigo' => 'YUY612',
            'nombre' => 'Piso 2',
            'descripcion' => null,
            'localizacionPadre' => null
        ]);

        // --------- SALAS

        $sala11 = LocalizacionFactory::createOne([
            'codigo' => 'PHE049',
            'nombre' => 'Sala 1',
            'descripcion' => null,
            'localizacionPadre' => $piso1
        ]);
        $sala21 = LocalizacionFactory::createOne([
            'codigo' => 'VJS966',
            'nombre' => 'Sala 2',
            'descripcion' => null,
            'localizacionPadre' => $piso1
        ]);
        $sala12 = LocalizacionFactory::createOne([
            'codigo' => 'QAV756',
            'nombre' => 'Sala 1',
            'descripcion' => null,
            'localizacionPadre' => $piso2
        ]);
        $sala22 = LocalizacionFactory::createOne([
            'codigo' => 'UID956',
            'nombre' => 'Sala 2',
            'descripcion' => null,
            'localizacionPadre' => $piso2
        ]);

        // --------- MUEBLES/ARMARIOS...

        LocalizacionFactory::createOne([
            'codigo' => 'GTE990',
            'nombre' => 'Estantería B',
            'descripcion' => null,
            'localizacionPadre' => $sala11
        ]);
        LocalizacionFactory::createOne([
            'codigo' => 'SBS284',
            'nombre' => 'Gabinete Secundario',
            'descripcion' => null,
            'localizacionPadre' => $sala21
        ]);
        LocalizacionFactory::createOne([
            'codigo' => 'UBQ480',
            'nombre' => 'Armario Rojo',
            'descripcion' => null,
            'localizacionPadre' => $sala12
        ]);
        LocalizacionFactory::createOne([
            'codigo' => 'LSP994',
            'nombre' => 'Armario Azul',
            'descripcion' => null,
            'localizacionPadre' => $sala22
        ]);

        // --------- MATERIALES

        $cajaPizarras = MaterialFactory::createOne([
            'nombre' => 'Caja Pizarra',
            'descripcion' => null,
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => null,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $cajaCables = MaterialFactory::createOne([
            'nombre' => 'Caja Cables',
            'descripcion' => null,
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => null,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $tizas = MaterialFactory::createOne([
            'nombre' => 'Tizas',
            'descripcion' => 'Caja con 10 tizas',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => $cajaPizarras,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $borradorPizarra = MaterialFactory::createOne([
            'nombre' => 'Borradores Pizarra',
            'descripcion' => 'Borrador pizarra',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => $cajaPizarras,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $cableHDMI = MaterialFactory::createOne([
            'nombre' => 'Cable HDMI',
            'descripcion' => '1.5 metros',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $cableRed = MaterialFactory::createOne([
            'nombre' => 'Cable Red',
            'descripcion' => '3 metros',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $cableUSB = MaterialFactory::createOne([
            'nombre' => 'Cable USB',
            'descripcion' => '100 centímetros',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $cableVGA = MaterialFactory::createOne([
            'nombre' => 'Cable VGA',
            'descripcion' => '1 metro',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $cableDVI = MaterialFactory::createOne([
            'nombre' => 'Cable DVI',
            'descripcion' => '1 metro',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => LocalizacionFactory::random(),
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => null,
            'prestadoPor' => null,
            'historicos' => null
        ]);

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
