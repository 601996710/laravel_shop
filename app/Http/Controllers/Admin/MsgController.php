<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\ArticleCate;
use App\Page;
use App\Vote;
use App\VoteInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MsgController extends AdminController
{
    //
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }

    //文章管理
    public function article(){
        $data = Article::paginate(12);
        return view("admin/article")->with("data",$data);
    }

    public function addArticle(){
        $cate =  ArticleCate::all();
        return view("admin/addArticle")->with("cate",$cate);
    }

    public function editArticle($id){
        $data = Article::find($id);
        $cate =  ArticleCate::all();
        return view("admin/addArticle")->with(["data"=>$data,'op'=>'编辑','cate'=>$cate]);
    }

    public function saveEditArticle(Request $request){
        $data['title'] = $request->post('title');
        $data['cate_id'] = $request->post('cate_id');
        $data['keyword'] = $request->post('keyword');
        $data['link'] = $request->post('link');
        $data['sort'] = $request->post('sort');
        $data['content'] = $request->post('content');

        $validata = $this->checkArticleData($data);

        if ($validata->fails()){
            return  $this->AdminError($validata->errors()->first() );
        }


        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $webImg = $request->file("file");
            $image = $webImg->store('public/images/cover');
            $data['image'] = $image;
            $article = Article::find($request->post('id'));
            if(!empty($article['image'])){

                Storage::delete($article['image']);
            }
        }



        Article::where("id","=",$request->post('id'))->update($data);
        return redirect(url("/admin/article"));
    }

    //验证数据
    private function checkArticleData($data){
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'cate_id' => 'required|integer',
            'sort' => 'integer',
        ]);
    }


    public function delArticle($id){
        $article =  Article::find($id);
        $article->delete();
        if(!empty($article['image'])){
            Storage::delete($article['image']);
        }
        return redirect(url("/admin/article"));
    }

    public function articleCate(){
        $data =  ArticleCate::orderBy("sort")->paginate(10);
        return view('admin/articleCate')->with(['data'=>$data]);
    }

    public function saveArticle(Request $request){
        $data['title'] = $request->post('title');
        $data['cate_id'] = $request->post('cate_id');
        $data['keyword'] = $request->post('keyword');
        $data['link'] = $request->post('link');
        $data['sort'] = $request->post('sort');
        $data['content'] = $request->post('content');

        $validata = $this->checkArticleData($data);

        if ($validata->fails()){
            return  $this->AdminError($validata->errors()->first() );
        }

        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $webImg = $request->file("file");
            $image = $webImg->store('public/images/cover');
            $data['image'] = $image;
        }


        Article::create($data);
        return redirect(url("/admin/article"));
    }

    //上传文件
    public function editUploadImg(Request $request){

        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $webImg = $request->file("file");
            $image = $webImg->store('public/images/edit');
            return response()->json(['image'=>Storage::url($image)]);
        }else{
            return response()->json(['error'=>'no images']);
        }

    }


    public function addArticleCate($id = 0){
        $data = ArticleCate::find($id);
        $pdata = [];
        if($data['pid'] > 0 ){
            $pdata = ArticleCate::find($data['pid']);
        }
        $ndata['pid'] = $data['pid'];
        $ndata['id'] = $data['id'];
        $all = ArticleCate::all();
        return view('admin/addArticleCate')->with(['pdata'=>$pdata,'data'=>$ndata,'all'=>$all]);
    }

    public function editArticleCate($id){
        $data = ArticleCate::find($id);
        $pdata = [];
        if($data['pid'] > 0 ){
            $pdata = ArticleCate::find($data['pid']);
        }
        $all = ArticleCate::all();
        return view('admin/addArticleCate')->with(['data'=>$data,'pdata'=>$pdata,'op'=>'编辑','all'=>$all]);
    }

    public function saveEditArticleCate(Request $request){
        $data['name'] = $request->post('name');
        $data['sort'] = $request->post('sort');
        $data['description'] = $request->post('description');
        $data['pid'] = $request->post('pid') > 0? $request->post('pid') :0;

        ArticleCate::where("id","=",$request->post('id'))->update($data);
        return redirect(url("admin/articleCate"));
    }

    public function saveArticleCate(Request $request){
        $data['name'] = $request->post('name');
        $data['sort'] = $request->post('sort');
        $data['description'] = $request->post('description');
        $data['pid'] = $request->post('pid') > 0? $request->post('pid') :0;
        ArticleCate::create($data);
        return redirect(url("admin/articleCate"));
    }

    public function delArticleCate($id){
        ArticleCate::find($id)->delete();
        return redirect(url("admin/articleCate"));
    }


    //页面管理
    public function page(){
        $data = Page::paginate(10);
        return view("admin/page")->with('data',$data);
    }

    public function addPage(){
        return view("admin/addPage");
    }

    public function savePage(Request $request){
        $data['title'] = $request->post('title');
        $data['keyword'] = $request->post('keyword');
        $data['description'] = $request->post('description');
        $data['content'] = $request->post('content');


        $validata =  Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        if ($validata->fails()){
            return  $this->AdminError($validata->errors()->first() );
        }


        Page::create($data);
        return redirect(url("admin/page"));
    }

    public function editPage($id){
        $data =     Page::find($id);
        return view("admin/addPage")->with("data",$data)->with('op','编辑');
    }

    public function saveEditPage(Request $request){
        $data['title'] = $request->post('title');
        $data['keyword'] = $request->post('keyword');
        $data['description'] = $request->post('description');
        $data['content'] = $request->post('content');

        $validata =  Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required'
        ]);

        if ($validata->fails()){
            return  $this->AdminError($validata->errors()->first() );
        }

        Page::where("id","=",$request->post('id'))->update($data);

        return redirect(url("admin/page"));
    }


    public function delPage($id){
        Page::find($id)->delete();
        return redirect(url("admin/page"));
    }

    //投票
    public function vote(){
        $data = Vote::paginate(10);
        return view("admin/vote")->with("data",$data);
    }

    public function addVote(){
        return view("admin/addVote");
    }

    public function delVote($id){
        Vote::find($id)->delete();
        VoteInfo::where("vote_id","=",$id)->delete();
        return redirect(url("admin/vote"));
    }

    public function editVote($id){
        $data = Vote::find($id);

        return view("admin/addVote")->with(['data'=>$data,'op'=>'编辑']);
    }

    public function saveEditVote(Request $request){
        $data['name'] = $request->post('name');

        $validata =  Validator::make($data, [
            'name' => 'required|string|max:255'
        ]);

        if ($validata->fails()){
            return  $this->AdminError($validata->errors()->first() );
        }

        Vote::where("id","=",$request->post('id'))->update($data);

        return redirect(url("admin/vote"));
    }

    public function voteInfo($vid){
        $data = VoteInfo::orderBy("sort")->where("vote_id","=",$vid)->paginate(10);
        return view("admin/voteInfo")->with(['data'=>$data,'vid'=>$vid]);
    }

    public function addVoteInfo($id){

        return view("admin/addVoteInfo")->with('id',$id);
    }

    public function saveVoteInfo(Request $request){

        $data['data'] = json_encode($request->post('data'),JSON_UNESCAPED_UNICODE);
        $data['type'] = $request->post("vote_type");
        $data['name'] = $request->post("name");
        $data['sort'] = $request->post("sort");
        $data['vote_id'] = $request->post("vote_id");

        VoteInfo::create($data);
        return redirect(url("admin/voteInfo/$data[vote_id]"));
  }

    public function delVoteInfo($id,$vid){
        VoteInfo::find($id)->delete();
        return redirect(url("admin/voteInfo/$vid"));
    }

    public function editVoteInfo($id,$vid){
        $data = VoteInfo::find($id);
        $data['info'] = json_decode($data['data']);
        return view("admin/addVoteInfo")->with(['data'=>$data,'id'=>$vid,'op'=>'编辑']);
    }

    public function saveEditVoteInfo(Request $request){
        $data['data'] = json_encode($request->post('data'));
        $data['type'] = $request->post("vote_type");
        $data['name'] = $request->post("name");
        $data['sort'] = $request->post("sort");
        $data['vote_id'] = $request->post("vote_id");

        VoteInfo::where("id","=",$request->post('id'))->update($data);
        return redirect(url("admin/voteInfo/$data[vote_id]"));
    }

    public function lookVote($id){
         $vote = Vote::find($id);
         $data = [];
         $data['name'] = $vote['name'];
         $data['id'] = $vote['id'];
         $voteInfo = $vote->voteInfo->toArray();
         foreach($voteInfo as $k=> $v){
            $data['voteInfo'][$k]['id'] = $v['id'];
            $data['voteInfo'][$k]['type'] = $v['type'];
            $data['voteInfo'][$k]['vote_id'] = $v['vote_id'];
            $data['voteInfo'][$k]['name'] = $v['name'];
            $list = json_decode($v['data']);
            $data['voteInfo'][$k]['list'] = $list;
         }
         return view("admin/lookVote")->with("data",$data);
    }

    public function saveVote(Request $request){
        $data['name'] = $request->post('name');

        $validata =  Validator::make($data, [
            'name' => 'required|string|max:255'
        ]);

        if ($validata->fails()){
            return  $this->AdminError($validata->errors()->first() );
        }

        Vote::create($data);
        return redirect(url("admin/vote"));
    }

    public function viewVote($id){
        return '查看投票结果';
    }

    //留言管理
    public function message(){
        
        return view("admin/message");
    }

}
