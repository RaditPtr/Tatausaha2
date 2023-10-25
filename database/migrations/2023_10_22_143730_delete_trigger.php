<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $trgName = 'trgLogsDelete';

    public function up()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS ' . $this->trgName);
        DB::unprepared(
            'CREATE TRIGGER ' . $this->trgName . ' AFTER DELETE ON guru
            FOR EACH ROW
            BEGIN
                DECLARE userid VARCHAR(200);
                SELECT username INTO userid FROM tbl_user WHERE id_user = OLD.id_user;

                INSERT INTO logs (logs) VALUES (CONCAT(userid, ": Melakukan Hapus Guru Dengan Nomor ", OLD.id_guru));
            END'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
