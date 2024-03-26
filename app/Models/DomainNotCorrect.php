<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainNotCorrect extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function correct()
    {
        return $this->belongsTo(DomainCorrect::class, 'not_correct_id');
    }
}
