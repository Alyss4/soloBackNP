<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;


class Utilisateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'Utilisateur';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_competiteur',
        'email',
        'mdp',
        'tentative',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'mdp',
    ];
    public function setMdpAttribute($value)
    {
        $this->attributes['mdp'] = Hash::make($value);
    }
}
?>