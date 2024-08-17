<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khuyenmai extends Model
{
    use HasFactory;
    protected $table = 'khuyen_mai';
    protected $primaryKey = 'id_khuyen_mai';
    protected $fillable = [
        'ten_khuyen_mai',
        'ma_code',
        'phan_tram',
        'so_luong',
        'trang_thai',
        'created_at',
        'updated_at',
        // `id_khuyen_mai`, `ten_khuyen_mai`, `ma_code`, `phan_tram`, `so_luong`, `trang_thai`, `created_at`, `updated_at`
    ];
}
