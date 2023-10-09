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
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->integer('id_user', 11)->autoIncrement();
            $table->string('username', 200)->nullable(false);
            $table->text('password')->nullable(false);
            $table->enum('role', ['admin', 'operator']);
        });

        DB::unprepared('
            CREATE TRIGGER Add_User
            AFTER INSERT ON tbl_user
            FOR EACH ROW
            BEGIN
                INSERT INTO logs (log)
                VALUES (CONCAT("User : ",NEW.username," telah ditambahkan ke table Data User pada : ", NOW()));
            END
        ');
        
        DB::unprepared('
        CREATE TRIGGER Update_User
        AFTER UPDATE ON tbl_user
        FOR EACH ROW
        BEGIN
            INSERT INTO logs (log)
            VALUES (CONCAT("User : ",OLD.username," telah diupdate dari table Data User, Username menjadi ", NEW.username, ", Role menjadi : ", NEW.role, " pada : ", NOW()));
        END
        ');

        DB::unprepared('
        CREATE TRIGGER Delete_User
        AFTER DELETE ON tbl_user
        FOR EACH ROW
        BEGIN
            INSERT INTO logs (log)
            VALUES (CONCAT("User : ",OLD.username," telah dihapus dari table Data User pada : ", NOW()));
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_user');
        DB::unprepared('DROP TRIGGER IF EXISTS Add_User');
        DB::unprepared('DROP TRIGGER IF EXISTS Update_User');
        DB::unprepared('DROP TRIGGER IF EXISTS Delete_User');
    }
};
