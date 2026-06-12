<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class FoundItem extends Model
{
    protected $fillable = [
        'user_id',
        'item_name',
        'category',
        'description',
        'location',
        'contact_details',
        'image_path',
        'status',
    ];

    public static function statusOptions(): array
    {
        return [
            'available' => 'Available',
            'matched' => 'Matched',
            'returned' => 'Returned',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
