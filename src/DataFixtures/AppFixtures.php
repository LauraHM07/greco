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

        $estanteriaB = LocalizacionFactory::createOne([
            'codigo' => 'GTE990',
            'nombre' => 'Estantería B',
            'descripcion' => null,
            'localizacionPadre' => $sala11
        ]);
        $gabineteSecundario = LocalizacionFactory::createOne([
            'codigo' => 'SBS284',
            'nombre' => 'Gabinete Secundario',
            'descripcion' => null,
            'localizacionPadre' => $sala21
        ]);
        $armarioRojo = LocalizacionFactory::createOne([
            'codigo' => 'UBQ480',
            'nombre' => 'Armario Rojo',
            'descripcion' => null,
            'localizacionPadre' => $sala12
        ]);
        $armarioAzul = LocalizacionFactory::createOne([
            'codigo' => 'LSP994',
            'nombre' => 'Armario Azul',
            'descripcion' => null,
            'localizacionPadre' => $sala22
        ]);

        // --------- MATERIALES

        $cajaPizarras = MaterialFactory::createOne([
            'codigo' => 'IME147',
            'nombre' => 'Caja Pizarra',
            'descripcion' => null,
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $estanteriaB,
            'materialPadre' => null,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'OAG285',
            'nombre' => 'Tizas',
            'descripcion' => 'Caja con 10 tizas',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $estanteriaB,
            'materialPadre' => $cajaPizarras,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'IMV508',
            'nombre' => 'Borradores Pizarra',
            'descripcion' => 'Borrador pizarra',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $estanteriaB,
            'materialPadre' => $cajaPizarras,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $cajaCables = MaterialFactory::createOne([
            'codigo' => 'PWJ965',
            'nombre' => 'Caja Cables',
            'descripcion' => null,
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioRojo,
            'materialPadre' => null,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'FKF622',
            'nombre' => 'Cable HDMI',
            'descripcion' => '1.5 metros',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioRojo,
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'MRV671',
            'nombre' => 'Cable Red',
            'descripcion' => '3 metros',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioRojo,
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'FWQ724',
            'nombre' => 'Cable USB',
            'descripcion' => '100 centímetros',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioRojo,
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'TEG005',
            'nombre' => 'Cable VGA',
            'descripcion' => '1 metro',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioRojo,
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'CTN515',
            'nombre' => 'Cable DVI',
            'descripcion' => '1 metro',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioRojo,
            'materialPadre' => $cajaCables,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $kitLatiguillos = MaterialFactory::createOne([
            'codigo' => 'ELI619',
            'nombre' => 'Kit construcción latiguillos',
            'descripcion' => null,
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $gabineteSecundario,
            'materialPadre' => null,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'ZPH859',
            'nombre' => 'Crimpadora',
            'descripcion' => 'Rj45',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $gabineteSecundario,
            'materialPadre' => $kitLatiguillos,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'RTT022',
            'nombre' => 'Tijeras',
            'descripcion' => 'De mano',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $gabineteSecundario,
            'materialPadre' => $kitLatiguillos,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'VGN284',
            'nombre' => 'Conectores 8P8C',
            'descripcion' => 'Bolsa',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $gabineteSecundario,
            'materialPadre' => $kitLatiguillos,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $kitLimpieza = MaterialFactory::createOne([
            'codigo' => 'LWP163',
            'nombre' => 'Kit limpieza aula',
            'descripcion' => null,
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioAzul,
            'materialPadre' => null,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'JYW808',
            'nombre' => 'Papel Higiénico',
            'descripcion' => '',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioAzul,
            'materialPadre' => $kitLimpieza,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'HEM185',
            'nombre' => 'Gel hidroalcohólico',
            'descripcion' => '',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioAzul,
            'materialPadre' => $kitLimpieza,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        MaterialFactory::createOne([
            'codigo' => 'BWH305',
            'nombre' => 'Limpiacristales',
            'descripcion' => '',
            'fechaHoraUltimoPrestamo' => null,
            'fechaHoraUltimaDevolucion' => null,
            'disponible' => true,
            'fechaAlta' => null,
            'fechaBaja' => null,
            'localizacion' => $armarioAzul,
            'materialPadre' => $kitLimpieza,
            'persona' => null,
            'responsable' => PersonaFactory::random(),
            'prestadoPor' => null,
            'historicos' => null
        ]);

        $manager->flush();
    }
}
