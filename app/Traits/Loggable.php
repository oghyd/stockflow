<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

trait Loggable
{
    public function logActivity(string $action, ?string $description = null): void
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject_type' => $this instanceof Model ? $this->getMorphClass() : static::class,
            'subject_id' => $this instanceof Model ? $this->getKey() : null,
            'description' => $description,
        ]);
    }

    public static function recordActivity(
        string $action,
        ?Model $subject = null,
        ?string $description = null
    ): void {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject_type' => $subject?->getMorphClass(),
            'subject_id' => $subject?->getKey(),
            'description' => $description,
        ]);
    }
}