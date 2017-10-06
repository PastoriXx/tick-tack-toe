<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Step;
use App\Http\Requests\StepRequest;
use App\Components\ComputerStrategy\RandomStrategy;
use App\Components\GameMap;
use Illuminate\Http\Request;
use Config;

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
        $board = Board::allowed()->find($request->board_id);

        if (!$board) {
            return redirect()->route('boards.index', ['id' => $request->board_id])->with('status', 'Game over');
        }

        $data = $this->makePlayerStep($board, $request->cell);

        if (!isset($data['errors']) || isset($data['success'])) {
            $data = $this->makeComputerStep($board);
        }
               
        return response()->json($data);
    }

    /**
     * Make player step
     *
     * @param App\Models\Board $board
     * @param array $cell
     *
     * @return array
     */
    private function makePlayerStep(Board $board, array $cell)
    {
        $data = [];
        
        $gameMap = $board->latestStep()->game_map;

        if ($gameMap[$cell['x']][$cell['y']] != Config::get('enums.field_types.empty')) {
            return ['errors' => 'You can not make a move here!'];
        }

        $gameMap[$cell['x']][$cell['y']] = $board->player_type;
        
        if (GameMap::checkWinner($gameMap, $board->player_type)) {
            $data['success'] = "The winner is player";

            $board->winner_type = $board->player_type;
            $board->save();
        }

        $board->steps()->create(["game_map" => $gameMap]);

        $data['game_map'] = $gameMap;
        
        return $data;
    }

    /**
     * Make computer step
     *
     * @param App\Models\Board $board
     *
     * @return array
     */
    private function makeComputerStep(Board $board)
    {
        $data = [];

        $gameMap = $board->latestStep()->game_map;

        $strategy = new RandomStrategy($gameMap, $board->computer_type);
        $data = $strategy->findBestStep();

        if (isset($data['errors'])) {
            return $data;
        }

        if (GameMap::checkWinner($data['game_map'], $board->computer_type)) {
            $data['success'] = "The winner is computer";

            $board->winner_type = $board->computer_type;
            $board->save();
        }

        $board->steps()->create(["game_map" => $data['game_map']]);

        return $data;
    }
}
