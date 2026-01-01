<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'type',
        'link',
        'link_text',
        'model_type',
        'model_id',
        'dismissed',
        'dismissed_by',
        'dismissed_at',
    ];

    protected $casts = [
        'dismissed' => 'boolean',
        'dismissed_at' => 'datetime',
    ];

    public const TYPE_INFO = 'info';
    public const TYPE_WARNING = 'warning';
    public const TYPE_ERROR = 'error';
    public const TYPE_SUCCESS = 'success';

    public function scopeActive($query)
    {
        return $query->where('dismissed', false);
    }

    public function scopeForModel($query, $model)
    {
        return $query->where('model_type', get_class($model))
                     ->where('model_id', $model->id);
    }

    public function dismiss($userId = null)
    {
        $this->update([
            'dismissed' => true,
            'dismissed_by' => $userId ?? auth()->id(),
            'dismissed_at' => now(),
        ]);
    }

    public static function createForPage($page, $title, $message = null)
    {
        return static::create([
            'title' => $title,
            'message' => $message ?? "This page needs content to be added.",
            'type' => static::TYPE_WARNING,
            'link' => route('admin.content-pages.edit', $page->id),
            'link_text' => 'Edit Page',
            'model_type' => get_class($page),
            'model_id' => $page->id,
        ]);
    }
}
