<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DomainNotCorrect extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function correct()
    {
        return $this->belongsTo(DomainCorrect::class);
    }
}
