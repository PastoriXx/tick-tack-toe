<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Step;
use App\Http\Requests\BoardRequest;
use App\Helpers\GameMapHelper;
use Cookie;

class BoardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $boards = Board::orderBy('created_at', 'desc')->paginate();
 
         return view('boards.index', compact('boards'));
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int $id
      *
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
        if (!GameMapHelper::checkAccess($id)) {
            //error
        }

        $model = Board::findOrFail($id);
        $map = $model->steps()->latest()->first()->game_map;

        return view('boards.show', compact('model', 'map'));
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param PostRequest $request
      * @return \Illuminate\Http\Response
      */
     public function store(BoardRequest $request)
     {
        $token = bin2hex(random_bytes(10));
        Cookie::queue('user_token', $token, 10);

        $model = new Board($request->all());
        $model->player_token = $token;
        $model->save();

        $step = new Step(["game_map" => GameMapHelper::createInitialMap()]);
        $model->steps()->save($step);
 
        return redirect()->route('boards.show', ['id' => $model->id]);//->with('status', trans('post.created'));
     }
}
