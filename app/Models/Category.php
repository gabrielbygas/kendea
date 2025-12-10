<?php
// Modified by Claude

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'slug'];

    /**
     * Auto-generate slug from nom
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->nom);
            }
        });
    }

    /**
     * Relationship: Category has many Activities
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'categorie_id');
    }
}
