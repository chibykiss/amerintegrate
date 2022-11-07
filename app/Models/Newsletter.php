<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'subject', 'body', 'via','send_status',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
