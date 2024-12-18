# Doctrine Postgres Schema Extra Bundle

A Symfony bundle to make working with Postgres easier. Removes the annoying schema change in migrations, 
as well as provide a way to ignore manually created indices from migrations

## Installation

```bash
composer require programmatically/doctrine-postgres-schema-extra-bundle
```

Add configuration:

```yaml
# config/packages/doctrine.yaml
doctrine:
    dbal:
        platform_service: 'Programmatically\DoctrinePostgresSchemaExtraBundle\Doctrine\CustomPostgreSQLPlatformService'
        schema_manager_factory: 'doctrine.dbal.default_schema_manager_factory'
```

To ignore indices (optional), add the following configuration:

```yaml
# config/packages/doctrine_postgres_schema_extra.yaml
doctrine_postgres_schema_extra:
    ignored_index:
        - name of the index
```

## Contributions

Contributions are welcome! Please submit issues and pull requests to the GitHub repository.
