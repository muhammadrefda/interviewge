<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static get()
 * @method static findOrFail($orderId)
 * @method static create(array $all)
 */
class Order extends Model
{

    protected $fillable = [
        'order_code', 'status_order','list_menu_id','user_id',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function listMenu(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\ListMenu');
    }
}
