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
    
    /**
     * Get emoji icon for category
     */
    public function getEmojiAttribute()
    {
        $emojiMap = [
            'Monuments Emblématiques et Architecture Moderne' => '🏙️',
            'Aventures dans le Désert' => '🏜️',
            'Parcs à Thèmes et Attractions Familiales' => '🎢',
            'Nature et Sports d\'Aventure' => '🏔️',
            'Culture et Exploration Historique' => '🕌',
            'Gastronomie, Shopping et Vie Nocturne' => '🛍️',
            'Croisières et Activités Nautiques' => '🚢',
            'Festivals, Événements et Activités Saisonnières' => '🎉',
            'Expériences de Luxe et Bien-être' => '💎',
            'Sports Extrêmes et Sensations Fortes' => '🪂',
        ];
        
        return $emojiMap[$this->nom] ?? '🎯';
    }
}
