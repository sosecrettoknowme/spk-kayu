<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    // public function datapenilaian()
    // {
    //     return $this->hasMany(DataPenilaian::class);
    // }
    public function dataPenilaian()
    {
        return $this->hasMany(DataPenilaian::class, 'alternative_id');
    }
    

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
    
    public function hasDataPenilaian($subkriteriaId = null)
    {
        if ($subkriteriaId) {
            return $this->datapenilaian()->where('subkriteria_id', $subkriteriaId)->exists();
        }
        
        return $this->datapenilaian()->exists();
    }

    public function subKriteria()
{
    return $this->hasManyThrough(SubKriteria::class, DataPenilaian::class, 'alternative_id', 'id', 'id', 'subkriteria_id');
}


public static function boot()
{
    parent::boot();

    static::deleting(function ($alternative) {
        $alternative->dataPenilaian()->delete();
    });
}


}
