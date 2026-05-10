<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PositionHistory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name', 
        'email',
        'department_id', 
        'position_id',
        'hired_at', 
        'status'
    ];

    /**
     * Conversion des types (Casting)
     * Remplace l'ancien 'protected $dates'
     */
    protected $casts = [
        'hired_at' => 'date', // ou 'datetime' si tu as l'heure
    ];

    /**
     * Relation avec le département
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Relation avec le poste actuel
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Relation avec l'historique des postes
     */
    public function histories(): HasMany
    {
        return $this->hasMany(PositionHistory::class);
    }
}
