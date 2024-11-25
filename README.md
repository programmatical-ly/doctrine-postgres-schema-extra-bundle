# Doctrine Postgres Schema Extra Bundle

```bash
composer require programmatically/doctrine-postgres-schema-extra-bundle:dev-main
```

Add to `doctrine.yaml`:

```yaml
doctrine:
    dbal:
        platform_service: 'Programmatically\DoctrinePostgresSchemaExtraBundle\Doctrine\CustomPostgreSQLPlatformService'
        schema_manager_factory: 'doctrine.dbal.default_schema_manager_factory'
```

To ignore indices, add the following configuration:

```yaml
doctrine_postgres_schema_extra:
    ignored_index:
        - name of the index
```
