<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Model for the "logs" table. Named ActivityLog so it doesn't clash
 * with Laravel's built-in Log facade.
 */
class ActivityLog extends Model
{
    protected $table = 'logs';

    protected $primaryKey = 'log_id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'date_time',
    ];

    protected function casts(): array
    {
        return [
            'date_time' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Record an action, e.g. ActivityLog::record('Added patient Juan Dela Cruz').
     */
    public static function record(string $action, ?int $userId = null): self
    {
        return static::create([
            'user_id' => $userId ?? Auth::id(),
            'action' => $action,
            'date_time' => now(),
        ]);
    }
}
