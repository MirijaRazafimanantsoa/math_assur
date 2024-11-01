<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Sinistre extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'sinistres'; // Ensure the correct table name is used

    // The primary key associated with the table
    protected $primaryKey = 'num_sinistre';

    // The attributes that are mass assignable
    protected $fillable = [
        'date_incident',
        'date_declaration',
        'montant_indemnise',
        'etat',
        'date_validation',
        'description',
        'num_contrat'
    ];
 
    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'num_sinistre');
    }
   
    protected static function booted()
        {
            static::created(function ($sinistre) {
                $user = Auth::user();
                $message = sprintf(
                    'Sinistre n°%d déclaré par %s (%s)',
                    $sinistre->num_sinistre,
                    $user->name,
                    $user->user_type
                );

                Historique::create([
                    'message' => $message,
                    'user_id' => $user->id,
                    'created_at' => now(),
                ]);
            });
        }
}
