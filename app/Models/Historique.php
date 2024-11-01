<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'historique';
    protected $fillable = ['message', 'user_id'];
    // If you have timestamps
    public $timestamps = true; 

    // or false if you don't have created_at/updated_at
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
