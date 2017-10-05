<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Step;

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
     * Steps relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Step
     */
    public function steps()
    {
         return $this->hasMany(Step::class);
    }
}
