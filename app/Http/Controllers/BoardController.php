<?php

namespace App\Http\Controllers;

use App\Components\ComputerStrategy\RandomStrategy;
use App\Components\GameMap;
use App\Http\Requests\BoardRequest;
use App\Models\Board;
use Config;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::orderBy('created_at', 'desc')->paginate(5);

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
        $model = Board::allowed()->findOrFail($id);
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

        if ($model->player_type == Config::get('enums.field_types.O')) {
            $strategy = new RandomStrategy($model->computer_type);
            $gameMap = $strategy->findBestStep()['game_map'];
        } else {
            $gameMap = GameMap::createInitialMap();
        }

        $model->steps()->create(["game_map" => $gameMap]);

        return redirect()->route('boards.show', ['id' => $model->id]); //->with('status', trans('New game board created'));
    }
}
