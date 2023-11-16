<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_trans';
    protected $fillable = ['kategori_id','nominal','deskripsi','tanggal']; 
}
