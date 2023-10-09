<?php

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
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->integer('id_jenis_surat', 11)->autoIncrement();
            $table->string('jenis_surat', 100);
        });
        DB::unprepared('
        CREATE TRIGGER Add_Jenis
        AFTER INSERT ON jenis_surat
        FOR EACH ROW
        BEGIN
            INSERT INTO logs (log)
            VALUES (CONCAT("Jenis surat : ",NEW.jenis_surat," telah ditambahkan ke table Data Jenis Surat pada : ", NOW()));
        END
        ');

        DB::unprepared('
        CREATE TRIGGER Update_Jenis
        AFTER UPDATE ON jenis_surat
        FOR EACH ROW
        BEGIN
            INSERT INTO logs (log)
            VALUES (CONCAT("Jenis surat : ",OLD.jenis_surat," telah diupdate dari table Data Jenis Surat, Jenis surat menjadi : ", NEW.jenis_surat, " pada : ", NOW()));
        END
        ');
        
        DB::unprepared('
        CREATE TRIGGER Delete_Jenis
        AFTER DELETE ON jenis_surat
        FOR EACH ROW
        BEGIN
            INSERT INTO logs (log)
            VALUES (CONCAT("Jenis surat : ",OLD.jenis_surat," telah dihapus dari table Data Jenis Surat pada : ", NOW()));
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_surat');
        DB::unprepared('DROP TRIGGER IF EXISTS Add_Jenis');
        DB::unprepared('DROP TRIGGER IF EXISTS Update_Jenis');
        DB::unprepared('DROP TRIGGER IF EXISTS Delete_Jenis');
    }
};
