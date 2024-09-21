<?php

namespace App\Models;

use App\Jobs\ExpireCode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [ 'client_id', 'code', 'expires_at', 'created_at' ];

    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');    
    }
}
