<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeauthJobs extends Model
{
    use HasFactory;
    protected $table = 'deauth_jobs';
    protected $fillable = [
        'id', 'id_campaign','target', 'channel','status','pid','updated_at', 'created_at',
    ];
}
