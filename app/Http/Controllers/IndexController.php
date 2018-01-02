<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tour;
use App\WebImages;
use App\WebImagesPosition;
use App\WebInfo;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public $web_info;

    public function __construct()
    {
        $web_info_all = WebInfo::all();
        $web_info = [];
        foreach($web_info_all as $k=>$v){
            $web_info[$v['key']] = $v['value'];
        }
        $this->web_info = $web_info;
    }


    public function index($id = 0){
       $id = $id == 0 ? 7 :$id;


       $article = Article::where("cate_id","=",$id)->paginate(12);

        $banner =  WebImagesPosition::orderBy("sort")->where("web_images_id","=","6")->get();
        if($banner->isEmpty()){
            $banner = WebImages::where("id","=","6")->get();
        }

       return view("index")->with(["web_info"=>$this->web_info,'article'=>$article,'banner'=>$banner]);
   }

    public function show($id){
        $data = Article::find($id);
        Article::where("id","=",$id)->update(["view"=>$data['view']+1]);
        $randArticle = Article::orderBy(\DB::raw('RAND()'))->take(5)->get();
        return view("show")->with(['data'=>$data,"web_info"=>$this->web_info,'randArticle'=>$randArticle]);
    }

}
