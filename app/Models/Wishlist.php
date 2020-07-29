<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wishlist extends Model
{
    protected $fillable = [
		'title',
		'description',
		'organizer_id',
		'public_url'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $code = md5($model->description);
            $code = substr($code, 0, 7);
            $model->public_url = route('wishlists.shared', compact('code'));
            $model->organizer_id = $model->organizer_id ?? authUserId();
        });
    }

    /**
     * Get wishlist organizer (User).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organizer(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'organizer_id');
    }

    /**
     * Get wishlist participants (User).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlist_users', 'wishlist_id', 'user_id');
    }

    /**
     * Get wishlist wishes (WishlistItem).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wishes(): HasMany
    {
        return $this->hasMany(WishlistItem::class);
    }
}
