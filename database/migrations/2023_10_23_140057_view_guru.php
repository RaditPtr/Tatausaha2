<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS view_guru;");

        DB::unprepared("
        CREATE VIEW view_guru AS
        SELECT 
            guru.id_guru AS id_guru,
            guru.nama_guru AS nama_guru,
            guru.foto_guru AS foto_guru,
            tbl_user.id_user AS id_user
        FROM guru
        JOIN tbl_user ON guru.id_user = tbl_user.id_user
        ORDER BY guru.id_guru ASC;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::statement('DROP VIEW IF EXISTS view_guru');
    }
};
