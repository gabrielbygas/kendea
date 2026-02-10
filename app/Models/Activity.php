<?php
// Modified by Claude

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'description',
        'prix',
        'location',
        'emirate',
        'categorie_id',
        'images',
        'notes'
    ];

    protected $casts = [
        'images' => 'array',
        'prix' => 'decimal:2',
        'notes' => 'decimal:1'
    ];

    /**
     * Auto-generate slug from nom
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($activity) {
            if (empty($activity->slug)) {
                $activity->slug = Str::slug($activity->nom);
            }
        });
    }

    /**
     * Relationship: Activity belongs to Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    /**
     * Accessor for first image
     */
    public function getFirstImageAttribute()
    {
        return $this->images[0] ?? 'images/default.jpg';
    }
}
