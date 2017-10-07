<?php

namespace App\Http\Controllers;

use App\Components\ComputerStrategy\RandomStrategy;
use App\Components\GameMap;
use App\Http\Requests\StepRequest;
use App\Models\Board;
use App\Models\Step;
use Config;
use Illuminate\Http\Request;
use Session;

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
            Session::flash('status', "The party №{$request->board_id} finished");

            return [
                'redirect' => route('boards.index', ['id' => $request->board_id]),
            ];
        }

        $data = $this->makePlayerStep($board, $request->cell);

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
            return [
                'messages' => 'You can not make a move here!',
                'errors' => true,
            ];
        }

        $gameMap[$cell['x']][$cell['y']] = $board->player_type;

        if ($data['winner'] = GameMap::checkWinner($gameMap, $board->player_type)) {
            $data['messages'] = "The winner is player";

            $board->winner_type = $board->player_type;
            $board->save();
        }

        $board->steps()->create(["game_map" => $gameMap]);

        $data['game_map'] = $gameMap;

        if (!$data['winner']) {
            $data = $this->makeComputerStep($board);
        }

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

        $strategy = new RandomStrategy($board->computer_type, $gameMap);
        $data = $strategy->findBestStep();

        if (isset($data['errors']) || $data['winner']) {
            return $data;
        }

        if ($data['winner'] = GameMap::checkWinner($data['game_map'], $board->computer_type)) {
            $data['messages'] = "The winner is computer";

            $board->winner_type = $board->computer_type;
            $board->save();
        }

        $board->steps()->create(["game_map" => $data['game_map']]);

        return $data;
    }
}
