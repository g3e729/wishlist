<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishlistItem extends Model
{
    protected $fillable = [
		'wishlist_id',
		'buyer_id',
		'name',
		'description',
		'price',
		'img_url',
		'shop_url',
		'purchased'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->shop_url = 'https://www.lazada.com.ph';
        });
    }

    /**
     * Get item's buyer (User).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Get item's wishlist (Wishlist).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wishlist(): BelongsTo
    {
        return $this->belongsTo(Wishlist::class);
    }
}
