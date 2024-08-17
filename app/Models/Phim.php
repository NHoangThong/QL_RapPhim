<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use DB;


class Phim extends Model
{
    use HasFactory;
    protected $table = 'phim';
    protected $primaryKey='id_phim';
    protected $fillable =
    [
        'ten_phim',
        'image',
        'thoi_luong_phim',
        'ngay_phat_hanh',
        'ngay_ket_thuc',
        'quoc_giasx',
        'trailer',
        'id_gioi_han_do_tuoi',
        'trang_thai',
        'mieu_ta',
    ];

    public $timestamps = false;

    public function daodiens()
    {
        return $this->belongsToMany(Daodien::class, 'daodien_phim', 'id_phim', 'id_dao_dien');
    }

    public function loaiphims()
    {
        return $this->belongsToMany(Loaiphim::class,'loai_phim_phim','id_phim','id_loai_phim');
    }

    public function dienviens()
    {
        return $this->belongsToMany(Dienvien::class,'dienvien_phim','id_phim','id_dien_vien');
    }
    public function rating()
    {
        return $this->belongsTo(Gioihandotuoi::class,'id_gioi_han_do_tuoi','id_gioi_han_do_tuoi');
    }

    public function lichtrinhs()
    {
        return $this->hasMany(Lichtrinh::class,'id_phim','id_phim');
    }

    public function lichtrinhsTheoNgayVaRap($ngay, $rap)
{
    return $this->lichtrinhs()->select('lich_trinh.*', 'rap.id_rap as rap')
    ->join('phong', 'phong.id_phong', '=', 'lich_trinh.id_phong')
    ->join('rap', 'rap.id_rap', '=', 'phong.id_rap')
    ->where('ngay', $ngay)
    ->where('lich_trinh.trang_thai', 1)
    ->where('rap.id_rap', $rap)->get();
}

    

public function lichtrinhsSomTheoRapVaNgay($ngay, $rap)
{
    return $this->lichtrinhs()->select('lich_trinh.*', 'rap.id_rap as rap')
            ->join('phong', 'phong.id_phong', '=', 'lich_trinh.id_phong')
            ->join('rap', 'rap.id_rap', '=', 'phong.id_rap')
            ->where('ngay', $ngay)
            ->where('lich_trinh.early', 1)
            ->where('rap.id_rap', $rap)->get();

}




}
