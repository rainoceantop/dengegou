<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artical;
use App\Contact;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $columns = array("*");
        //分页参数
        // paginate($perPage = null, $columns = ['*'], $pageName = '', $page = null)
        $published = Artical::where('publish_time', '<=', Carbon::now())->where('is_revoke', 0)->orderBy('publish_time', 'desc');
        $published_count = $published->count();
        $published = $published->paginate(10, $columns, "published");

        $unpublish = Artical::where('publish_time', '>', Carbon::now())->orWhere('is_revoke',1)->orderBy('updated_at', 'desc');
        $unpublish_count = $unpublish->count();
        $unpublish = $unpublish->paginate(10, $columns, "unpublish");

        $articals["published"] = $published;
        $articals["unpublish"] = $unpublish;
        $articals_count["published"] = $published_count;
        $articals_count["unpublish"] = $unpublish_count;


        $contacts = Contact::orderBy('sent_time', 'desc');
        $contacts_count = $contacts->count();
        $contacts = $contacts->paginate(10, $columns, "contact");

        $index_config = json_decode(file_get_contents(public_path('index.config.json')), true);
        $carousels = $index_config['carousels'];
        

        if($request->input('case')){
            $case = $request->input('case');
            $request->session()->flash('case', $case);
        }
        // var_dump($articals);
        return view('admin')
        ->with('articals', $articals)
        ->with('articals_count', $articals_count)
        ->with('contacts', $contacts)
        ->with('contacts_count', $contacts_count)
        ->with('carousels', $carousels);
    }
    public function carousels(Request $request){
        $file_types = ["jpg", "jpeg", "png", "gif"];
        $file = $request->file('file');
        $key = $request->input('key');
        $extension = $file->getClientOriginalExtension();
        if(in_array($extension, $file_types)){
            $newName = $key.'.'.$extension;
            $path = public_path('imgs/');
            $index_config = json_decode(file_get_contents(public_path('index.config.json')), true);
            $index_config['carousels'][$key] = "imgs/".$newName;
            file_put_contents(public_path('index.config.json'), json_encode($index_config).PHP_EOL);
            $file->move($path, $newName);
            return redirect("admin")
            ->with('status', '图片上传成功')
            ->with('case', 'carousel'); 
        }
        return redirect("admin")
        ->with('status', '图片上传失败')
        ->with('case', 'carousel');
    }
}
