<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Contrat extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'contrats';

    // The attributes that are mass assignable
    protected $fillable = [
        'type_contrat',
        'date_souscription',
        'montant_assure',
        'duree_du_contrat',
        'client_id'
    ];
    
    protected $primaryKey = 'num_contrat';

    // The attributes that should be hidden for arrays
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Define relationships (optional)
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function sinistre()
    {
        return $this->hasMany(Sinistre::class, 'num_sinistre');
    }

    protected static function booted()
    {
        // Insert Event
        static::created(function ($contrat) {
            $user = Auth::user();
            $message = sprintf(
                'Contrat n°%d ajouté par %s',
                $contrat->num_contrat,
                $user->name
            );

            Historique::create([
                'message' => $message,
                'user_id' => $user->id,
                'created_at' => now(),
            ]);
        });

        // Update Event
        static::updated(function ($contrat) {
            $user = Auth::user();
            $message = sprintf(
                'Contrat n°%d modifié par %s',
                $contrat->num_contrat,
                $user->name
            );

            Historique::create([
                'message' => $message,
                'user_id' => $user->id,
                'created_at' => now(),
            ]);
        });

        // Delete Event
        static::deleted(function ($contrat) {
            $user = Auth::user();
            $message = sprintf(
                'Contrat n°%d supprimé par %s',
                $contrat->num_contrat,
                $user->name
            );

            Historique::create([
                'message' => $message,
                'user_id' => $user->id,
                'created_at' => now(),
            ]);
        });
    }
}

