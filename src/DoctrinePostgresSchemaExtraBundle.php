<?php declare(strict_types=1);

namespace Programmatically\DoctrinePostgresSchemaExtraBundle;

use Programmatically\DoctrinePostgresSchemaExtraBundle\Doctrine\CustomPostgreSQLPlatformService;
use Programmatically\DoctrinePostgresSchemaExtraBundle\Doctrine\CustomPostgreSQLSchemaManager;
use Programmatically\DoctrinePostgresSchemaExtraBundle\Doctrine\MigrationEventSubscriber;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class DoctrinePostgresSchemaExtraBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        if ($container->env() === 'prod') {
            return;
        }

        $container
            ->services()
            ->set(
                CustomPostgreSQLPlatformService::class,
                CustomPostgreSQLPlatformService::class,
            )
        ;

        $container
            ->services()
            ->set(
                MigrationEventSubscriber::class,
                MigrationEventSubscriber::class,
            )
            ->tag('doctrine.event_listener', ['event' => 'postGenerateSchema']);

        $container
            ->services()
            ->set(
                CustomPostgreSQLSchemaManager::class,
                CustomPostgreSQLSchemaManager::class,)
            ->call('setIndexesToFilter', [$config['ignored_index']])
        ;
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
            ->arrayNode('ignored_index')
                ->scalarPrototype()
            ->end()
        ;
    }
}
