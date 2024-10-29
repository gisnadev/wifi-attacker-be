<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $reason
 * @property int    $len
 * @property string $flag
 * @property string $addr3
 * @property string $addr2
 * @property string $addr1
 */
class Deauths extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deauths';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'updated_at', 'created_at', 'reason', 'len', 'flag', 'signal', 'addr3', 'addr2', 'addr1'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'reason' => 'int', 'len' => 'int', 'flag' => 'string', 'addr3' => 'string', 'addr2' => 'string', 'addr1' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at', 'created_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
