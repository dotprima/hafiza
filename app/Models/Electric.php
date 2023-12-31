<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electric extends Model
{
    use HasFactory;
    protected $fillable = ['nama_electric', 'id_merek', 'id_kategori', 'tipe_electric'];

    public function merek()
    {
        return $this->belongsTo(Merek::class, 'id_merek');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }
}
