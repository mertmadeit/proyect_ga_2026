<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $dbName = DB::getDatabaseName();

        // Some environments may still query these default-pluralized table names.
        // Provide views to the actual tables created by migrations.
        $this->createViewIfNoBaseTable('formapagos', 'formaspago', $dbName);
        $this->createViewIfNoBaseTable('estadofacturas', 'estadosfacturas', $dbName);
    }

    public function down(): void
    {
        // Drop views if they exist (and are actually views).
        DB::statement('DROP VIEW IF EXISTS `formapagos`');
        DB::statement('DROP VIEW IF EXISTS `estadofacturas`');
    }

    private function createViewIfNoBaseTable(string $viewName, string $sourceTable, string $dbName): void
    {
        $objectType = $this->getObjectType($viewName, $dbName);

        if (in_array($objectType, ['BASE TABLE', 'TABLE'], true)) {
            return;
        }

        if ($objectType === 'VIEW') {
            DB::statement("DROP VIEW IF EXISTS `{$viewName}`");
        }

        DB::statement("CREATE VIEW `{$viewName}` AS SELECT * FROM `{$sourceTable}`");
    }

    private function getObjectType(string $name, string $dbName): ?string
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            $row = DB::selectOne(
                "SELECT type FROM sqlite_master WHERE name = ? LIMIT 1",
                [$name]
            );

            if (!$row || !isset($row->type)) {
                return null;
            }

            $type = strtoupper((string) $row->type);
            return $type === 'TABLE' ? 'BASE TABLE' : $type;
        }

        $row = DB::selectOne(
            'SELECT TABLE_TYPE AS table_type FROM information_schema.tables WHERE table_schema = ? AND table_name = ? LIMIT 1',
            [$dbName, $name]
        );

        return $row && isset($row->table_type)
            ? strtoupper((string) $row->table_type)
            : null;
    }
};
