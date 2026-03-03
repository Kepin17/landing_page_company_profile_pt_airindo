<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    public const CATEGORIES = [
        'Air Cooled Chiller',
        'Linghein',
        'Jianye',
        'Renner',
    ];

    protected $fillable = [
        'name',
        'slug',
        'category',
        'short_description',
        'description',
        'specifications',
        'image',
        'shopee_link',
        'tokopedia_link',
        'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'specifications' => 'array',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = static::generateUniqueSlug($product->name, $product->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $slug = Str::slug($name);
        $baseSlug = $slug;
        $counter = 1;

        $query = static::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->clone()->exists()) {
            $slug = $baseSlug . '-' . $counter++;
            $query = static::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }
        return 'https://placehold.co/600x400/e2e8f0/64748b?text=No+Image';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
