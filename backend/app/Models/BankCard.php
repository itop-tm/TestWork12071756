<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    protected $guarded = [];

    protected $dates = [
        'created_at',
    ];

    protected $casts = [
        'expires_at' => 'date:Y/m',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::updating(function ($model) {
            $model->expires_at = $model->original['expires_at'] ?? $model->expires_at;
        });

        static::creating(function ($model) {
            $model->expires_at = $model->original['expires_at'] ?? $model->expires_at;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payer()
    {
        return $this->user();
    }
}
