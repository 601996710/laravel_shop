<?php

namespace App\Http\Controllers\Admin;

use App\Nav;
use App\WebImages;
use App\WebImagesPosition;
use App\WebInfo;
use App\WebLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\Cloner\Data;

class SetController extends AdminController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    //网站信息
    public function webInfo(){
        $all = WebInfo::all();
        $data = [];
        foreach($all as $k=>$v){
            $data[$v['key']] = $v['value'];
        }

        return view("admin/webInfo")->with(['data'=>$data]);
    }

    public function saveWebInfo(Request $request){
       $noArray = ['s','_token'];
        foreach($request->all() as $k=>$v){
            if(!in_array($k,$noArray)){
                $data = WebInfo::where(['key'=>$k])->get();

                if($data->isEmpty()){
                    $data = [];
                    $data['key'] = $k;
                    $data['value'] = $v;
                    WebInfo::create($data);
                }else{
                    WebInfo::where(['key'=>$k])->update(['value'=>$v]);
                }
            }
        }

        return redirect(url("/admin/webInfo"));
    }

    //导航设置
    public function navSet(){
        $data = Nav::orderBy("sort")->paginate(10);
        return view("admin/navSet")->with("data",$data);
    }


    public function saveNav(Request $request)
    {
        $data['name'] = $request->post("navName");
        $data['link'] = $request->post("navLink");
        $data['sort'] = $request->post("navSort");

        $data['pid'] = $request->post('pid') > 0 ?$request->post('pid'):0;

        $validata = $this->checkNLS($data);
        if ($validata->fails()){
            return $validata->errors()->first() ;
         }

        Nav::create($data);

        return redirect(url("/admin/navSet"));
    }

    public function editNav($id){
        $data =  Nav::find($id);
       return view("admin/addNav")->with("data",$data)->with('op','编辑');
    }

    public function saveEditNav(Request $request)
    {
        $data['name'] = $request->post("navName");
        $data['link'] = $request->post("navLink");
        $data['sort'] = $request->post("navSort");

        $validata = $this->checkNLS($data);

        if ($validata->fails()){
            return $validata->errors()->first() ;
        }

        Nav::where("id","=",$request->post('id'))->update($data);

        return redirect(url("/admin/navSet"));
    }

    public function delNav($id){
        $nav = Nav::find($id);
        $nav->delete();
        return redirect(url("/admin/navSet"));
    }

    public function addSonNav($id){
        $pdata = Nav::find($id);

        return view('admin/addNav')->with('pdata',$pdata);
    }

    private function  checkNLS($data){

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'link' => 'required|string|url',
            'sort' => 'required|integer',
        ]);
    }


    //幻灯片设置
    public function webImgSet(){
        $data = WebImages::paginate(10);
        return view("admin/webImgSet")->with('data',$data);
    }



    public function saveWebImg(Request $request){

        $data['name'] = $request->post("name");
        $data['link'] = $request->post("link");
        $data['sort'] = $request->post("sort");


        $validata = $this->checkNLS($data);

        if ($validata->fails()){
            return $validata->errors()->first() ;
        }


        if($request->hasFile('webImg') && $request->file('webImg')->isValid()) {

            $webImg = $request->file("webImg");
            $image = $webImg->store('public/images');

            WebImages::create([
                'name'=> $data['name'],
                'link'=> $data['link'],
                'sort'=> $data['sort'],
                'file_name'=> $webImg->getClientOriginalName(),
                'image'=> $image,
            ]);

           return  redirect(url("/admin/webImgSet"));
        }

    }


    public function webImgPositionSet($id){

        $data = WebImagesPosition::orderBy("sort")->where("web_images_id","=",$id)->paginate(10);
        $webImgInfo =  WebImages::find($id);
        return view("admin/webImgPositionSet")->with(['data'=>$data,'id'=>$id,'name'=>$webImgInfo['name']]);
    }

    public function addWebImagesPosition($id){
        return view("admin/addWebImgPosition")->with('web_images_id',$id);
    }


    public function saveWebImagePosition(Request $request){

        $data['name'] = $request->post("name");
        $data['link'] = $request->post("link");
        $data['web_images_id'] = $request->post("web_images_id");
        $data['sort'] = $request->post("sort");


        $validata = $this->checkNLS($data);

        if ($validata->fails()){
            return  $this->AdminError($validata->errors()->first() );
        }


        if($request->hasFile('webImg') && $request->file('webImg')->isValid()) {

            $webImg = $request->file("webImg");
            $image = $webImg->store('public/images');

            WebImagesPosition::create([
                'name'=> $data['name'],
                'link'=> $data['link'],
                'sort'=> $data['sort'],
                'web_images_id'=> $data['web_images_id'],
                'file_name'=> $webImg->getClientOriginalName(),
                'image'=> $image,
            ]);

            return  redirect(url("/admin/webImgPositionSet/$data[web_images_id]"));
        }
    }

    public function delImagePosition($id)
    {
        $img = WebImagesPosition::find($id);

        $img->delete();
        //删除图片
        Storage::delete($img['image']);
        return  redirect(url("/admin/webImgPositionSet/$img[web_images_id]"));
    }


    public function editWebImagesPosition($id){
        $img = WebImagesPosition::find($id);
        $img['src'] = Storage::url($img['image']);

        return view('admin/addWebImgPosition')->with(["web_images_id"=>$img['web_images_id'],'data'=>$img,'op'=>'编辑']);
    }

    public function editWebImages($id){
        $img = WebImages::find($id);
        $img['src'] = Storage::url($img['image']);
        return view('admin/addWebImg')->with(["web_images_id"=>$img['web_images_id'],'data'=>$img,'op'=>'编辑']);
    }


    public function saveEditWebImg(Request $request){

        //判断图片
        if($request->hasFile('webImg') && $request->file('webImg')->isValid()) {

            $webImg = $request->file("webImg")->store('public/images');

            $img = WebImages::find($request->post('id'));

            //删除图片
            Storage::delete($img['image']);

            $data['image'] = $webImg;
            $data['file_name'] =  $request->file("webImg")->getClientOriginalName();
        }


        $data['name'] = $request->post("name");
        $data['link'] = $request->post("link");
        $data['sort'] = $request->post("sort");

        $validata = $this->checkNLS($data);

        if ($validata->fails()){
            return $validata->errors()->first() ;
        }

        WebImages::where("id","=",$request->post('id'))->update($data);


        return redirect(url("/admin/webImgSet/"));

    }


    public function saveEditWebImagesPosition(Request $request){


        //判断图片
        if($request->hasFile('webImg') && $request->file('webImg')->isValid()) {

            $webImg = $request->file("webImg")->store('public/images');

            $img = WebImagesPosition::find($request->post('id'));

            //删除图片
             Storage::delete($img['image']);

            $data['image'] = $webImg;
            $data['file_name'] =  $request->file("webImg")->getClientOriginalName();
        }


        $data['name'] = $request->post("name");
        $data['link'] = $request->post("link");
        $data['sort'] = $request->post("sort");

        $validata = $this->checkNLS($data);

        if ($validata->fails()){
            return $validata->errors()->first() ;
        }

        WebImagesPosition::where("id","=",$request->post('id'))->update($data);


        return redirect(url("/admin/webImgPositionSet/".$request->post('web_images_id')));
    }


    public function delImage($id){
        $img = WebImages::find($id);

        $wip = WebImagesPosition::where(['web_images_id'=>$id])->get();

        if(!$wip->isEmpty()){
            return  $this->adminError('请先删除相关数据');
        }

        $img->delete();
        //删除图片
        Storage::delete($img['image']);
        return  redirect(url("/admin/webImgSet"));
    }


    //友情链接
    public function webLinkSet(){
        $data = WebLink::orderBy("sort","ASC")->paginate(10);
        return view("admin/webLink")->with(['data'=>$data]);
    }

    public function addWebLink(){
        return view("admin/addWebLink");
    }

    public function delWebLink($id){
        $weblink = WebLink::find($id);
        $weblink->delete();
        if(!empty($weblink['image'])){
            Storage::delete($weblink['image']);
        }
        return redirect(url("admin/webLinkSet"));
    }

    public function saveWebLink(Request $request){
        //判断图片
        if($request->hasFile('webImg') && $request->file('webImg')->isValid()) {

            $webImg = $request->file("webImg")->store('public/images');

            $data['image'] = $webImg;
            $data['file_name'] =  $request->file("webImg")->getClientOriginalName();
        }

        $data['name'] = $request->post("name");
        $data['link'] = $request->post("link");
        $data['sort'] = $request->post("sort");
        $data['type'] = $request->post("type");

        $validata = $this->checkNLS($data);

        if ($validata->fails()){
            return $validata->errors()->first() ;
        }

        WebLink::create($data);
        return redirect(url("/admin/webLinkSet"));
    }

    public function editWebLink($id){
        $data = WebLink::find($id);
        return view("admin/addWebLink")->with(['data'=>$data,'op'=>'编辑']);
    }


    public function saveEditWebLink(Request $request){

        $id = $request->post("id");
        if($request->hasFile('webImg') && $request->file('webImg')->isValid()) {

            $webImg = $request->file("webImg")->store('public/images');
            $data['image'] = $webImg;
            $data['file_name'] =  $request->file("webImg")->getClientOriginalName();
            $link = WebLink::find($id);
            Storage::delete($link['image']);
        }
        $data['name'] = $request->post("name");
        $data['link'] = $request->post("link");
        $data['sort'] = $request->post("sort");
        $data['type'] = $request->post("type");

        $validata = $this->checkNLS($data);

        if ($validata->fails()){
            return $validata->errors()->first() ;
        }

        WebLink::where("id","=",$id)->update($data);
        return redirect(url("/admin/webLinkSet"));
    }
}
