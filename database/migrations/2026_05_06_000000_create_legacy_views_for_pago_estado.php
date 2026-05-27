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
        $row = DB::selectOne(
            'SELECT TABLE_TYPE AS table_type FROM information_schema.tables WHERE table_schema = ? AND table_name = ? LIMIT 1',
            [$dbName, $viewName]
        );

        if ($row && isset($row->table_type) && strtoupper((string) $row->table_type) === 'BASE TABLE') {
            return;
        }

        DB::statement("CREATE OR REPLACE VIEW `{$viewName}` AS SELECT * FROM `{$sourceTable}`");
    }
};
