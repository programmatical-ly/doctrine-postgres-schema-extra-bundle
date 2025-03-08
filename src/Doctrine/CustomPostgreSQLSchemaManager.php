<?php declare(strict_types=1);

namespace Programmatically\DoctrinePostgresSchemaExtraBundle\Doctrine;

use Doctrine\DBAL\Schema\PostgreSQLSchemaManager;

class CustomPostgreSQLSchemaManager extends PostgreSQLSchemaManager
{
    /** @var string[] */
    private array $indexesToFilter = [];

    /**
     * Parameters:
     * array<int,array<string,mixed>> $tableIndexes
     */
    protected function _getPortableTableIndexesList($tableIndexes, $tableName = null): array
    {
        $indexes = parent::_getPortableTableIndexesList($tableIndexes, $tableName);

        foreach ($this->indexesToFilter as $index) {
            if (isset($indexes[$index])) {
                unset($indexes[$index]);
            }
        }

        return $indexes;
    }

    /**
     * @param string[] $indexesToFilter
     */
    public function setIndexesToFilter(array $indexesToFilter): void
    {
        $this->indexesToFilter = $indexesToFilter;
    }
}
