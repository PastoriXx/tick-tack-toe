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
     * Steps relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Step
     */
     public function steps()
     {
         return $this->hasMany(Step::class);
     }
}
