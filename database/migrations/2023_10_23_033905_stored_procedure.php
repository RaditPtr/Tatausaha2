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
    public function up(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS CreateUser');
        DB::unprepared("
        CREATE PROCEDURE CreateUser(
            IN new_username VARCHAR(255),
            IN new_password TEXT,
            IN new_role VARCHAR(255)
        )
        BEGIN
        DECLARE new_id_user INT;
        DECLARE pesan_error CHAR(5) DEFAULT '00000';
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION, SQLWARNING

        BEGIN
        GET DIAGNOSTICS CONDITION 1 pesan_error = RETURNED_SQLSTATE;
        END;

        START TRANSACTION;
        SAVEPOINT satu;

        -- Sisipkan data ke dalam tabel user
        INSERT INTO tbl_user (username, password, role) VALUES (new_username, new_password, new_role);
        
        IF pesan_error != '00000' THEN ROLLBACK TO satu;
        END IF;
            
        -- Dapatkan ID user yang baru disisipkan
        SET new_id_user = LAST_INSERT_ID();
        -- Update kolom id_user dengan nilai yang baru disisipkan
        UPDATE tbl_user SET id_user = new_id_user WHERE id_user IS NULL;

        IF pesan_error != '00000' THEN ROLLBACK TO satu;
        END IF;
        COMMIT;
        END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        DB::unprepared('DROP Procedure IF EXISTS CreateUser');
    }
};
