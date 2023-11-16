<?php

namespace App\Factory;

use App\Entity\Localizacion;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Localizacion>
 *
 * @method        Localizacion|Proxy create(array|callable $attributes = [])
 * @method static Localizacion|Proxy createOne(array $attributes = [])
 * @method static Localizacion|Proxy find(object|array|mixed $criteria)
 * @method static Localizacion|Proxy findOrCreate(array $attributes)
 * @method static Localizacion|Proxy first(string $sortedField = 'id')
 * @method static Localizacion|Proxy last(string $sortedField = 'id')
 * @method static Localizacion|Proxy random(array $attributes = [])
 * @method static Localizacion|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Localizacion[]|Proxy[] all()
 * @method static Localizacion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Localizacion[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Localizacion[]|Proxy[] findBy(array $attributes)
 * @method static Localizacion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Localizacion[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class LocalizacionFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'codigo' => self::faker()->regexify('[A-Z]{3}\d{3}'),
            'nombre' => self::faker()->unique()->word(),
            'descripcion' => self::faker()->optional(0.5)->sentence(6),
            'localizacionPadre' =>  self::faker()->boolean(50)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Localizacion $localizacion): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Localizacion::class;
    }
}
