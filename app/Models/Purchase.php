<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;

class Purchase extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'user_id',
        'purchaseable_type',
        'purchaseable_id',
    ];

    public function purchaseabl(): MorphTo
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
