<?php
// Modified by Claude

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'activities',
        'datetime',
        'montant_total',
        'statut'
    ];

    protected $casts = [
        'activities' => 'array',
        'datetime' => 'datetime',
        'montant_total' => 'decimal:2'
    ];

    /**
     * Relationship: Commande belongs to Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get activities details from activity IDs
     */
    public function getActivitiesDetails()
    {
        return Activity::whereIn('id', $this->activities)->get();
    }
}
