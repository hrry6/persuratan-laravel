<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $fillable = ['username', 'password', 'role'];
    protected $casts = [
        'password' => 'hashed',
    ];
    public $timestamps = false;


    public function surat()
    {
        return $this->hasMany(Surat::class, 'id_user');
    }

}
