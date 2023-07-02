<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerhitungan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

//     public function datapenilaian()
//    {
//        return $this->belongsTo(DataPenilaian::class);
//    }
public function dataPenilaian()
{
    return $this->belongsTo(DataPenilaian::class, 'data_penilaian_id');
}

}
