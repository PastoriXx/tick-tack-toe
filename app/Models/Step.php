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
     * Board relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Board
     */
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
