<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ghe extends Model
{
    use HasFactory;
    protected $table ='ghe';
    protected $primaryKey ='id_ghe'; 
    protected $fillable =
    [
        'row',
        'col',
        'ms',
        'me',
        'mb',
        'id_loai_ghe',
        'id_phong',
        'status'
    ];
    public $timestamps = false;
    public function seatType()
    {
        return $this->belongsTo(Loaighe::class, 'id_loai_ghe', 'id_loai_ghe');
    }

    public function loaighes()
    {
        return $this->belongsTo(Loaighe::class, 'id_loai_ghe', 'id_loai_ghe');
    }
}
