<?php declare(strict_types=1);

namespace Programmatically\DoctrinePostgresSchemaExtraBundle\Doctrine;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;

class CustomPostgreSQLPlatformService extends PostgreSQLPlatform
{
    public function createSchemaManager(Connection $connection): \Doctrine\DBAL\Schema\PostgreSQLSchemaManager
    {
        return new CustomPostgreSQLSchemaManager($connection, $this);
    }
}
