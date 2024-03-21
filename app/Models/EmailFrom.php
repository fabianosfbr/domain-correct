<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EmailFrom extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'emails_from';

    protected $fillable = [
        'address',
    ];

    public function emailTo()
    {
        return $this->belongsTo(EmailTo::class, 'email_to_id', 'id');
    }
}
