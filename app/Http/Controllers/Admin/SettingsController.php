<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings(){
        $settings= Settings::first();
        return view('backend.settings.settings')->with('settings', $settings);
    }

    public function update(Request $request){
        $settings=Settings::first();
        $data=$request->all();

        $status=$settings->fill($data)->save();
        if($status){
            return redirect()->route('settings')->with(['success' => 'updated scussefuly']);
        }
        else{
            return redirect()->route('settings')->with(['error' => 'there was something wrong']);
        }

    }
}
