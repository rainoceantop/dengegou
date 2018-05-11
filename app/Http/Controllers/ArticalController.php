<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artical as Artical;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticalController extends Controller
{
    public function dispatcher(){
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(){
        $articals = Artical::where("publish_time","<=",Carbon::now())->where('is_revoke', 0)->orderBy('publish_time', 'desc')->take(5)->get();
        $index_config = json_decode(file_get_contents(public_path('index.config.json')), true);
        $carousels = $index_config["carousels"];
        return view("index")
        ->with("articals", $articals)
        ->with("carousels", $carousels);
    }
    public function about(){
        return view("about");
    }
    public function news(){
        $articals = Artical::where("publish_time", "<=", Carbon::now())->where('is_revoke', 0)->orderBy('publish_time', 'desc')->paginate(10);
        return view("news")->with("articals", $articals);
    }
    public function index()
    {
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artical = new Artical;
        $artical->title = $request->artical_title;
        $artical->content = $request->artical_content;
        $artical->publish_time = $request->publish_time;
        $artical->save();
        return redirect("admin")->with('status', '文章发表成功');;
    }

    public function artical_imgs_upload(Request $request){
        $file = $request->file("uploaded_files");
        $file_original_name = $file->getClientOriginalName();
        // $file_oriainal_extension = $file->getClientOriginalExtension();
        $path = $file->getRealPath();
        $bool= Storage::disk('artical')->put($file_original_name,file_get_contents($path));
        $url = Storage::url('articalImgs/'.$file_original_name);
        $res = [
            "errno"=>0, "data"=>[
                $url,
            ]
        ];
        echo json_encode($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $artical = Artical::findOrFail($id);
            if($artical->publish_time <= Carbon::now())
                return view('detail')->with('artical', $artical);
            else
                abort(404);
        }catch(ModelNotFoundException $e){
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $artical = Artical::find($id);
        $status = "";
        $case = $request->case;
        if(is_null($request->_case)){
            $artical->title = $request->artical_update_title;
            $artical->content = $request->artical_update_content;
            $status = "文章更新成功";
        }else{
            if($request->_case == "revoke"){
                $artical->is_revoke = 1;
                $status = "文章撤销成功";
            }else{
                $artical->is_revoke = 0;
                $artical->publish_time = Carbon::now();
                $status = "文章发表成功";
            }
        }
        $artical->save();
        return redirect("admin")
        ->with('status', $status)
        ->with('case', $case);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $case = $request->input("case");
        Artical::destroy($id);
        return redirect("admin")
        ->with("status", "文章删除成功")
        ->with('case', $case);
    }
}
