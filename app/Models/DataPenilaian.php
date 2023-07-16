<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenilaian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
      protected $dates = ['tanggal_penilaian'];

    //  public function alternative()
    // {
    //     return $this->belongsTo(Alternative::class, 'alternative_id');
    // }

    // public function subKriteria()
    // {
    //     return $this->belongsTo(SubKriteria::class, 'subkriteria_id');
    // }
    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }
    
    public function subKriteria()
    {
        return $this->belongsTo(SubKriteria::class);
    }
    


    public function dataPerhitungan()
    {
        return $this->hasMany(DataPerhitungan::class, 'data_penilaian_id');
    }
}
