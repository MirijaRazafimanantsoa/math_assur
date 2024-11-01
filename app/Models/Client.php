<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Historique;

class Client extends Model
{
    protected $fillable = [
        'nom',
        'prenom',
        'date_de_naissance',
        'adresse',
        'type_contrat',
    ];
    protected $primaryKey='client_id';
    public function contrats()
    {
        return $this->hasMany(Contrat::class, 'client_id');
    }

    protected static function booted()
    {
        // Insert Event
        static::created(function ($client) {
            $user = Auth::user();
            $message = sprintf(
                'Client n°%d (%s %s) ajouté par %s',
                $client->client_id,
                $client->prenom,
                $client->nom,
                $user->name
            );

            Historique::create([
                'message' => $message,
                'user_id' => $user->id,
                'created_at' => now(),
            ]);
        });

        // Update Event
        static::updated(function ($client) {
            $user = Auth::user();
            $message = sprintf(
                'Client n°%d (%s %s) modifié par %s',
                $client->client_id,
                $client->prenom,
                $client->nom,
                $user->name
            );

            Historique::create([
                'message' => $message,
                'user_id' => $user->id,
                'created_at' => now(),
            ]);
        });

        // Delete Event
        static::deleted(function ($client) {
            $user = Auth::user();
            $message = sprintf(
                'Client n°%d (%s %s) suprimé par %s',
                $client->client_id,
                $client->prenom,
                $client->nom,
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
