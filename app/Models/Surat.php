<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $primaryKey = 'id_surat';
    protected $fillable = ['id_user', 'id_jenis_surat', 'tanggal_surat', 'ringkasan', 'file'];
    public $timestamps = false;


    public function jenis()
    {
        return $this->belongsTo(JenisSurat::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getJenisSuratAttribute()
    {
        return JenisSurat::find($this->attributes['id_jenis_surat'])->jenis_surat;
    }

    public function getUsernameAttribute()
    {
        return User::find($this->attributes['id_user'])->username;
    }
    
}
