<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $trgName = 'trgLogUpdate';
    
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS ' . $this->trgName);
        DB::unprepared(
            'CREATE TRIGGER ' . $this->trgName . ' AFTER UPDATE ON guru
    FOR EACH ROW
    BEGIN
        DECLARE guru_id INT;
        DECLARE perubahan VARCHAR(255);
        DECLARE update_message TEXT;  -- Store the update message separately
        
        -- Ambil ID guru yang diupdate
        SELECT id_guru INTO guru_id FROM guru WHERE id_guru = NEW.id_guru;

        -- Inisialisasi pesan log
        SET update_message = CONCAT((SELECT username FROM tbl_user WHERE id_user = OLD.id_user), ": Melakukan Update Pada Nomor ", guru_id, ". Perubahan");

        -- Periksa perubahan pada id_akun
        IF OLD.id_user != NEW.id_user THEN
            SET perubahan = CONCAT("id akun dari ", (SELECT username FROM tbl_user WHERE id_user = OLD.id_user), " ke ", (SELECT username FROM tbl_user WHERE id_user = NEW.id_user));
            SET update_message = CONCAT(update_message, " ", perubahan, " |");
        END IF;
        
        -- Periksa perubahan pada nama_guru
        IF OLD.nama_guru != NEW.nama_guru THEN
            SET update_message = CONCAT(update_message, " ringkasan dari ", OLD.nama_guru, " ke ", NEW.nama_guru, " |");
        END IF;
        
        -- Periksa perubahan pada foto_guru
        IF OLD.foto_guru != NEW.foto_guru THEN
            SET update_message = CONCAT(update_message, " foto_guru", " |");
        END IF;
        
        -- Insert pesan log ke dalam tabel logs
        INSERT INTO logs (logs) VALUES (update_message);
    END'
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DROP Trigger on Rollback
        DB::unprepared('DROP TRIGGER IF EXISTS ' . $this->trgName); //
    }
};
