<?php

namespace App\Factory;

use App\Entity\Historial;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Historial>
 *
 * @method        Historial|Proxy create(array|callable $attributes = [])
 * @method static Historial|Proxy createOne(array $attributes = [])
 * @method static Historial|Proxy find(object|array|mixed $criteria)
 * @method static Historial|Proxy findOrCreate(array $attributes)
 * @method static Historial|Proxy first(string $sortedField = 'id')
 * @method static Historial|Proxy last(string $sortedField = 'id')
 * @method static Historial|Proxy random(array $attributes = [])
 * @method static Historial|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Historial[]|Proxy[] all()
 * @method static Historial[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Historial[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Historial[]|Proxy[] findBy(array $attributes)
 * @method static Historial[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Historial[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class HistorialFactory extends ModelFactory
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
            'notas' => self::faker()->optional(0.5)->sentence(6)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Historial $historial): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Historial::class;
    }
}
