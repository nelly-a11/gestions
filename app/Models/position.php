<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Position
 * * @property int $id
 * @property string $title
 * @property int $department_id
 * @property string|null $description
 * @property-read \App\Models\Department $department
 */
class Position extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'department_id',
        'description',
    ];

    // --- RELATIONS ---

    /**
     * Récupère le département auquel appartient ce poste.
     *
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Récupère les employés occupant ce poste.
     *
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Récupère l'historique des changements liés à ce poste.
     *
     * @return HasMany
     */
    public function positionHistories(): HasMany
    {
        return $this->hasMany(PositionHistory::class);
    }
}