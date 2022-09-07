<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_link',
        'accounts_id',
        'cash',
        'invoice_data'
    ];

    public function account()
    {
        return $this->belongsTo(Accounts::class);
    }
}