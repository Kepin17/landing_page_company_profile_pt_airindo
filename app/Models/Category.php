<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'sort_order'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    /** All root categories (no parent) ordered by sort_order */
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id')->orderBy('sort_order');
    }

    /** Flat list of all category names for validation */
    public static function allNames(): array
    {
        return static::pluck('name')->toArray();
    }

    /** Grouped: root categories with their children, cached for 60 min */
    public static function tree(): \Illuminate\Support\Collection
    {
        return Cache::remember('categories_tree', 3600, function () {
            return static::roots()->with(['children' => fn($q) => $q->orderBy('sort_order')])->get();
        });
    }

    /** Flat list for dropdowns: ['Parent' => ['Child1','Child2'], ...] */
    public static function grouped(): array
    {
        $tree = static::tree();
        $result = [];
        foreach ($tree as $parent) {
            $result[$parent->name] = $parent->children->pluck('name')->toArray();
        }
        return $result;
    }

    /** Clear cache whenever a category is saved or deleted */
    protected static function boot(): void
    {
        parent::boot();
        static::saved(fn() => Cache::forget('categories_tree'));
        static::deleted(fn() => Cache::forget('categories_tree'));
    }
}
