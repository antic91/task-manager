<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasUuids;
    use HasFactory;

    /**
     * Summary of incrementing
     * @var 
     */
    public $incrementing = false;

    /**
     * Summary of keyType
     * @var string
     */
    protected $keyType = 'string';


    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'deadline_at',
        'user_id',
    ];

    protected $casts = [
        'deadline_at' => 'datetime',
    ];

    /**
     * Task belongs to a user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
