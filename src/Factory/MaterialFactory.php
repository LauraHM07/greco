<?php

namespace App\Factory;

use App\Entity\Material;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Material>
 *
 * @method        Material|Proxy create(array|callable $attributes = [])
 * @method static Material|Proxy createOne(array $attributes = [])
 * @method static Material|Proxy find(object|array|mixed $criteria)
 * @method static Material|Proxy findOrCreate(array $attributes)
 * @method static Material|Proxy first(string $sortedField = 'id')
 * @method static Material|Proxy last(string $sortedField = 'id')
 * @method static Material|Proxy random(array $attributes = [])
 * @method static Material|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Material[]|Proxy[] all()
 * @method static Material[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Material[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Material[]|Proxy[] findBy(array $attributes)
 * @method static Material[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Material[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class MaterialFactory extends ModelFactory
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
            'nombre' => self::faker()->unique()->word(),
            'descripcion' => self::faker()->optional(0.5)->sentence(6),
            'fechaHoraUltimoPrestamo' => self::faker()->optional(0.5)->dateTimeThisDecade(),
            'fechaHoraUltimaDevolucion' => self::faker()->optional(0.5)->dateTimeThisDecade(),
            'disponible' => self::faker()->boolean(50),
            'fechaAlta' => self::faker()->optional(0.5)->dateTimeThisDecade(),
            'fechaBaja' => self::faker()->optional(0.5)->dateTimeThisDecade(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Material $material): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Material::class;
    }
}
