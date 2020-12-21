<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListMenu extends Model
{
    protected $fillable = [
        'status_menu', 'name',
    ];

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Order');
    }
}
