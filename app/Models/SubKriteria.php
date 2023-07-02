<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'subkriterias';

    
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    public function datapenilaian()
    {
        return $this->belongsTo(DataPenilaian::class);
    }
}
