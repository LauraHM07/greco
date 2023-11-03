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
        PersonaFactory::createMany(10);
        HistorialFactory::createMany(10);

        $manager->flush();
    }
}
