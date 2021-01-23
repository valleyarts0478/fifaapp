<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Http\Requests\TeamRequest;
use App\Team;
use Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team_index()
    {
        $teams = Team::all();
        return view('admin.team_index', [
            'teams' => $teams
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team_create()
    {
        return view('admin/team_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function team_store(TeamRequest $request)
    {
        $input = $request->only('team_name');

        $team = new Team();
        $team->team_name = $input['team_name'];
        $team->save();

        /* 画像のアップロード */
        $uploadInput = $request->only("image");

        //画像が更新されたかどうか
        $is_change_image = false;
        
        //イメージのアップロード
		if(isset($uploadInput["image"])){
			$path = $uploadInput["image"]->store("public/team");
			if($path){
				$team->image_url = $path;
				$is_change_image = true;
			}
		}
        		//保存する
                if($is_change_image){
                    $team->save();
                }

        //フラッシュメッセージ書き方は複数ある　storeとupdateのように。
        return redirect("admin/team_index")->withflash_message("チームを登録しました");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function team_show($id)
    {
        $team = Team::find($id);

        return view('admin/team_show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function team_edit($id)
    {
        $team = Team::find($id);

        return view('admin/team_edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function team_update(TeamRequest $request, $id)
    {
        $input = $request->only('team_name');

        $team = Team::find($id);
        $team->team_name = $input['team_name'];
        $team->save();

        /* 画像のアップロード */
        $uploadInput = $request->only("image");
        
        //画像が更新されたかどうか
        $is_change_image = false;
        
        //イメージのアップロード
		if(isset($uploadInput["image"])){
            $path = $uploadInput["image"]->store("public/team");

			if($path){
				$team->image_url = $path;
				$is_change_image = true;
            }
		}

        		//保存する
		if($is_change_image){
			$team->save();
		}

        return redirect("admin/team_index")->with('flash_message', 'チームを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function team_destroy($id)
    {
        $team = Team::find($id);
        $team->delete();

        return redirect('admin/team_index')->with('flash_message', 'チームを削除しました');
    }
}
