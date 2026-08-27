<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialArchive extends Model
{
    protected $fillable = [
        'archivable_type',
        'archivable_id',
        'title',
        'player_name',
        'payload',
        'archived_by',
        'archived_at',
    ];

    protected $casts = [
        'payload'     => 'array',
        'archived_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'archived_by');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('archivable_type', $type);
    }
}