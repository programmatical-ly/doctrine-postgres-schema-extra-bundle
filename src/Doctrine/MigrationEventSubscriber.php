<?php declare(strict_types=1);

namespace Programmatically\DoctrinePostgresSchemaExtraBundle\Doctrine;

use Doctrine\DBAL\Schema\PostgreSQLSchemaManager;
use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;

class MigrationEventSubscriber
{
    public function postGenerateSchema(GenerateSchemaEventArgs $args): void
    {
        $schemaManager = $args
            ->getEntityManager()
            ->getConnection()
            ->createSchemaManager()
        ;

        if (!$schemaManager instanceof PostgreSQLSchemaManager) {
            return;
        }

        foreach ($schemaManager->listSchemaNames() as $namespace) {
            if ($args->getSchema()->hasNamespace($namespace)) {
                continue;
            }

            $args->getSchema()->createNamespace($namespace);
        }
    }
}
