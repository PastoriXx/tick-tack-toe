<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Http\Requests\StepRequest;
use App\Helpers\GameMapHelper;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StepRequest $request)
    {
        if (!GameMapHelper::checkAccess($request->board_id)) {
            //error
        }

        $model = new Step();
        $model->board_id = $request->board_id;
        $model->game_map = GameMapHelper::updateMap($request->cell);
        $model->save();
        
        return response()->json(['response' => 'This is get method']);
    }
}
