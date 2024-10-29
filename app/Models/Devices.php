<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $updated_at
 * @property int    $created_at
 * @property int    $channel
 * @property string $crypto
 * @property string $ssid
 * @property string $bssid
 */
class Devices extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devices';

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
        'id','id_campaign','updated_at', 'created_at', 'attackmode', 'whitelisted', 'crypto', 'channel', 'signal', 'ssid', 'bssid'
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
    /*protected $casts = [
        'updated_at' => 'timestamp', 'created_at' => 'timestamp', 'crypto' => 'string', 'channel' => 'int', 'ssid' => 'string', 'bssid' => 'string'
    ];*/

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
