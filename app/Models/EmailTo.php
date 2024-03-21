<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EmailTo extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'emails_to';

    protected $fillable = [
        'address',
        'email_to_id'
    ];

    public function emailsFrom()
    {
        return $this->hasMany(EmailFrom::class, 'email_to_id', 'id');
    }
}
