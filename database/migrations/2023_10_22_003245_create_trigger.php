<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $trgName = 'trgLogInsert';
    
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS ' . $this->trgName);
        DB::unprepared(
            'CREATE TRIGGER ' . $this->trgName . ' AFTER INSERT ON guru
    FOR EACH ROW
    BEGIN
        DECLARE guru_id INT;
        DECLARE userid VARCHAR(200);
        DECLARE gurunama VARCHAR(200);

        SELECT username INTO userid FROM tbl_user WHERE id_user = NEW.id_user;
        SELECT nama_guru INTO gurunama FROM guru WHERE id_guru = NEW.id_guru;

        SELECT id_guru INTO guru_id FROM guru WHERE id_guru = NEW.id_guru;
        INSERT INTO logs (logs) VALUES (CONCAT(userid, ": Melakukan Penambahan Guru Dengan Nomor ", guru_id, ", yaitu ", gurunama));
    END'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger');
    }
};
