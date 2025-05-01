<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'cpf',
        'cnpj',
        'profile_picture',
        'phone_number_1',
        'phone_number_2',
        'cep',
        'city',
        'state',
        'street',
        'district',
        'complement',        
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    
}
