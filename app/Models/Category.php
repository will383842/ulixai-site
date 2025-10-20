<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'level',
        'slug',
        'description',
        'is_active',
        'sort_order',
        'icon_image' ,
        'bg_color' // Change from 'icon' to 'icon_image'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'level' => 'integer',
        'sort_order' => 'integer'
    ];

    /**
     * Get the parent category
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get all child categories
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get all subcategories (level 2)
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->where('level', 2);
    }

    /**
     * Get all sub-subcategories (level 3)
     */
    public function subSubCategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->where('level', 3);
    }

    /**
     * Scope to get main categories only
     */
    public function scopeMainCategories($query)
    {
        return $query->where('level', 1)->whereNull('parent_id');
    }

    /**
     * Scope to get active categories only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get categories by level
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    /**
     * Get the full category path (breadcrumb)
     */
    public function getFullPathAttribute(): string
    {
        $path = [];
        $category = $this;
        
        while ($category) {
            array_unshift($path, $category->name);
            $category = $category->parent;
        }
        
        return implode(' > ', $path);
    }

    /**
     * Check if category has children
     */
    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    /**
     * Get all descendants (children, grandchildren, etc.)
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    /**
     * Get all ancestors (parent, grandparent, etc.)
     */
    public function ancestors()
    {
        $ancestors = collect();
        $category = $this->parent;
        
        while ($category) {
            $ancestors->push($category);
            $category = $category->parent;
        }
        
        return $ancestors;
    }

    public function missions()
    {
        return $this->hasMany(Mission::class, 'category_id')->orWhere('subcategory_id', $this->id)->orWhere('subsubcategory_id', $this->id);
    }

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = \Str::slug($category->name);
            }
        });
    }
}