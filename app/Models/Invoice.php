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
        'invoice_data',
        'invoice_date',
    ];

    protected $casts = [
        'id' => 'int',
        'invoice_data' => 'array'
    ];

    public function account()
    {
        return $this->belongsTo(Accounts::class);
    }
}
