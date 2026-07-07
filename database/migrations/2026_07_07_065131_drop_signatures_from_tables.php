<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'visitors',
            'interns_attachees',
            'staff',
            'contractors',
            'vehicles',
        ];

        foreach ($tables as $table) {
            if (Schema::hasColumn($table, 'signature')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->dropColumn('signature');
                });
            }
        }
    }

    public function down(): void
    {
        $tables = [
            'visitors',
            'interns_attachees',
            'staff',
            'contractors',
            'vehicles',
        ];

        foreach ($tables as $table) {
            if (!Schema::hasColumn($table, 'signature')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->string('signature')->nullable()->after('status');
                });
            }
        }
    }
};

