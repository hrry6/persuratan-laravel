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
        Schema::create('surat', function (Blueprint $table) {
            $table->integer('id_surat', 11)->autoIncrement();
            $table->integer('id_user', false)->length(11)->nullable(false);
            $table->integer('id_jenis_surat', false)->length(11)->nullable(false);
            $table->date('tanggal_surat')->default('2023-01-01')->nullable(false);
            $table->text('ringkasan');
            $table->text('file');

            $table->foreign('id_user')
                    ->references('id_user')->on('tbl_user')
                    ->onUpdate('cascade')->onDelete('cascade');
            
                    $table->foreign('id_jenis_surat')
                    ->references('id_jenis_surat')->on('jenis_surat')
                    ->onUpdate('cascade')->onDelete('cascade');
        });

        DB::unprepared('
        CREATE TRIGGER Add_Surat
        AFTER INSERT ON surat
        FOR EACH ROW
        BEGIN
            INSERT INTO logs (log)
            VALUES (CONCAT("Surat dengan jenis : ", (SELECT jenis_surat FROM jenis_surat WHERE id_jenis_surat = NEW.id_jenis_surat) ," telah ditambahkan ke table Data Surat oleh : ", (SELECT username FROM tbl_user WHERE id_user = NEW.id_user) , " pada : ", NOW()));
        END
        ');
        
        DB::unprepared('
        CREATE TRIGGER Update_Surat
        AFTER UPDATE ON surat
        FOR EACH ROW
        BEGIN
            INSERT INTO logs (log)
            VALUES (CONCAT("Surat dengan jenis : ",(SELECT jenis_surat FROM jenis_surat WHERE id_jenis_surat = OLD.id_jenis_surat)," telah diupdate dari table Data Surat oleh : ", (SELECT username FROM tbl_user WHERE id_user = NEW.id_user), " pada : ",NOW()));
        END
        ');

        DB::unprepared('
        CREATE TRIGGER Delete_Surat
        AFTER DELETE ON surat
        FOR EACH ROW
        BEGIN
            INSERT INTO logs (log)
            VALUES (CONCAT("Surat : ", (SELECT jenis_surat FROM jenis_surat WHERE id_jenis_surat = OLD.id_jenis_surat) ," telah dihapus dari table Data Surat pada : ", NOW()));
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
        DB::unprepared('DROP TRIGGER IF EXISTS Add_Surat');
        DB::unprepared('DROP TRIGGER IF EXISTS Update_Surat');
        DB::unprepared('DROP TRIGGER IF EXISTS Delete_Surat');
    }
};
