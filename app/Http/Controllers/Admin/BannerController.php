<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;

class BannerController extends Controller
{
   public function index(){

    $banner=Banner::orderBy('id','DESC')->paginate(10);
    return view('backend.banners.index')->with('banners',$banner);

   }

   public function create(){

    return view('backend.banners.create');
   }

   public function store(BannerRequest $request){

    try {
        $filePath = "";
            if ($request->has('photo')) {

                $filePath = uploadImage('banner', $request->photo);
            }

        Banner::insert([
            'title'=> $request-> title,
             'slug'=>$request -> slug ,
              'description'=>$request->description ,
               'photo'=> $filePath,
                'status'=>$request->status

        ]);
        return redirect()->route('banner.index')->with(['success' => 'تم حفظ اللغة بنجاح']);
    } catch (\Exception $ex) {
        return redirect()->route('banner.index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    }
}

public function edit($id){

    $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('banner.index')->with(['error' => 'هذه اللغة غير موجوده']);
        }
    return view('backend.banners.edit')->with('banner',$banner);
}

public function update($id ,BannerRequest $request){
    try {
        $banner = Banner::find($id);
        
        
        if ($request->has('photo')) {
            $filePath = uploadImage('banner', $request->photo);
            Banner::where('id', $id)
                ->update([
                    'photo' => $filePath,
                ]);}

             $banner->update($request->except('_token','photo'));

        return redirect()->route('banner.index')->with(['success' => 'تم تحديث اللغة بنجاح']);

    } catch (\Exception $ex) {
        return redirect()->route('banner.index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    } 
}

public function destroy($id){

    try {
        $banner = Banner::find($id);
        if (!$banner) {
            return redirect()->route('banner.index', $id)->with(['error' => 'هذه اللغة غير موجوده']);
        }
        $banner->delete();

        return redirect()->route('banner.index')->with(['success' => 'تم حذف اللغة بنجاح']);

    } catch (\Exception $ex) {
        return redirect()->route('banner.index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
    }
}

}