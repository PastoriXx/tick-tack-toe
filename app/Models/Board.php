<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Step;
use Cookie;
use Config;

class Board extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'boards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['player_token', 'player_type', 'winner_type'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = array('computer_type');

    /**
     * Steps relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Step
     */
    public function steps()
    {
         return $this->hasMany(Step::class);
    }
    
    /**
     * Get latest step
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Step
     */
    public function latestStep()
    {
        return $this->steps()->latest()->first();
    }

    /**
     * Scope a query to only include allowed players.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAllowed($query)
    {
        return $query->where($this->getTable() . '.player_token', Cookie::get('player_token'));
    }

    /**
     * Get computer type
     *
     * @return string
     */   
    public function getComputerTypeAttribute()
    {
        $types = Config::get('enums.field_types');

        return $this->player_type == $types['X'] ? $types['O'] : $types['X'];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function (self $model) {
            $token = bin2hex(random_bytes(10));
            Cookie::queue('player_token', $token, 10);

            $model->player_token = $token;
        });
    }
}
