<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Team;
use App\Player;
use Storage;
use App\Http\Requests\PlayerRequest;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::all();

        return view('admin.player_index', [
            'players' => $players
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();

        return view('admin.player_create', ['teams' => $teams]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerRequest $request)
    {
        $input = $request->only('player_no', 'player_name', 'team_id');

        $player = new Player();
        $player->team_id = $input['team_id'];
        $player->player_no = $input['player_no'];
        $player->player_name = $input['player_name'];
        $player->save();

        //画像アップロード
        $uploadInput = $request->only("player_image_url");

        //画像が更新されたかどうか
        $is_change_image = false;

        //イメージのアップロード
		if(isset($uploadInput["player_image_url"])){
			$path = $uploadInput["player_image_url"]->store("public/player");
			if($path){
				$player->player_image_url = $path;
				$is_change_image = true;
			}
        }
            //保存する
            if($is_change_image){
                $player->save();
            }


        return redirect('admin/player_index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player = Player::find($id);

        return view('admin/player_show', [
            'player' => $player
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = Player::find($id);
        $teams = team::all();

        return view('admin/player_edit', [
            'player' => $player,
            'teams' => $teams
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = [
            'player_no' => $request->player_no,
            'player_name' => $request->player_name,
            'team_id' => $request->team_id
        ];
        dd($input);

        $player = Player::find($id);
        $player->player_no = $input['player_no'];
        $player->player_name = $input['player_name'];
        $player->team_id = $input['team_id'];
        $player->save();

        /* 画像のアップロード */
        $uploadInput = $request->only("player_image_url");
        
        //画像が更新されたかどうか
        $is_change_image = false;
        
        //イメージのアップロード
		if(isset($uploadInput["player_image_url"])){
            $path = $uploadInput["player_image_url"]->store("public/player");

			if($path){
				$player->player_image_url = $path;
				$is_change_image = true;
            }
		}

        		//保存する
		if($is_change_image){
			$player->save();
		}

        return redirect("admin/player_index")->with('flash_message', 'playerを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $player = Player::find($id);
        $player->delete();

        return redirect('admin/player_index')->with('flash_message', '選手を削除しました');
    }
}
