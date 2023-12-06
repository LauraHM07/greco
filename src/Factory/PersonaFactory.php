<?php

namespace App\Factory;

use App\Entity\Persona;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Persona>
 *
 * @method        Persona|Proxy create(array|callable $attributes = [])
 * @method static Persona|Proxy createOne(array $attributes = [])
 * @method static Persona|Proxy find(object|array|mixed $criteria)
 * @method static Persona|Proxy findOrCreate(array $attributes)
 * @method static Persona|Proxy first(string $sortedField = 'id')
 * @method static Persona|Proxy last(string $sortedField = 'id')
 * @method static Persona|Proxy random(array $attributes = [])
 * @method static Persona|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Persona[]|Proxy[] all()
 * @method static Persona[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Persona[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Persona[]|Proxy[] findBy(array $attributes)
 * @method static Persona[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Persona[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PersonaFactory extends ModelFactory
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
            'nombreUsuario' => self::faker()->unique()->userName(),
            'clave' => self::faker()->password(5, 15),
            'nombre' => self::faker()->firstName(),
            'apellidos' => self::faker()->lastName(),
            'administrador' => false,
            'gestorPrestamos' => false
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Persona $persona): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Persona::class;
    }
}
