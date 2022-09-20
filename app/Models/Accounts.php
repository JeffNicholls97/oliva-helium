<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'housing_address',
        'address_key',
        'cash',
        'account_image'
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
