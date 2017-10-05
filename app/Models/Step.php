<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Board;

class Step extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'steps_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['game_map'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'game_map' => 'json',
    ];

    /**
     * Board relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Board
     */
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
