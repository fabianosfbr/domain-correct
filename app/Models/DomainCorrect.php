<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomainCorrect extends Model
{
    use HasFactory;
    use HasUuids;

    protected $guarded = ['id'];

    public function not_correct()
    {
        return $this->hasMany(
            DomainNotCorrect::class,
            'domain_correct_id', // foreignKey By Default Parent Model + Promary Key
            'id' // localKey => Primary Key In Parent Table By Default is Id
        );
    }
}
