<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtStatus extends Model
{
    use HasFactory;

    protected $table = 'debt_statuses';
    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;
}
