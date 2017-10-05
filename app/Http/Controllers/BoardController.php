<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Step;
use App\Http\Requests\BoardRequest;
use App\Helpers\GameMapHelper;

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
         $model = Board::create($request->all());
         
         $step = new Step(["game_map" => GameMapHelper::createInitialMap()]);
         $model->steps()->save($step);
 
         return redirect()->route('boards.show', ['id' => $model->id]);//->with('status', trans('post.created'));
     }
}
