<?php

namespace App\Http\Controllers\Hostel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use App\Models\Tag;
use App\Models\Bnb;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    /**
     * tag 列表
     * @return type
     */
    public function index(){
        $paginate = Config::get('system.paginate');
        $tag_list = Tag::orderBy('tid', 'desc')->paginate($paginate);
        
        return view('hostel.tag.index')->with('tag_list',$tag_list);
    }
    
    /**
     * 添加tag
     * @return type
     */
    public function create(){
        return view('hostel.tag.create');
    }
    
    /**
     * 添加tag操作处理
     * @param Request $request
     * @return type
     */
    public function store(Request $request){
        $this->validate($request,array(
            'name' => 'required|max:255'
        ));
        
        $tag = Tag::create($request->all());
        if($tag){
            Log::info('用户'.$this->logUser->id.'添加了标签',$tag);
            return redirect('/bnb/tag')->with('message', '标签添加成功');
        }else{
            Log::info('用户'.$this->logUser->id.'添加标签失败');
            return Redirect::back()->withInput()->withErrors('标签添加失败');
        }
    }
    
    /**
     * 编辑tag
     * @param type $id
     * @return type
     */
    public function edit($id){
        $tag = Tag::findOrFail($id);
        
        return view('hostel.tag.edit')->with('tag',$tag);
    }
    
    /**
     * 编辑tag操作
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function update(Request $request,$id){
        $this->validate($request,array(
            'name' => 'required|max:255'
        ));
        
        $tag = Tag::findOrFail($id);
        $tag->name = $request->get('name');
        $tag->type = $request->get('type');
        
        if($tag->save()){
            Log::info('用户'.$this->logUser->id.'修改了标签',$tag);
            return redirect('/bnb/tag')->with('message', '标签修改成功');
        }else{
            Log::info('用户'.$this->logUser->id.'修改标签失败');
            return Redirect::back()->withInput()->withErrors('标签修改失败');
        }
    }
    
    /**
     * 绑定民宿与tag
     * @param type $id
     * @return type
     */
    public function tag($id){
        $bnb = Bnb::findOrFail($id);
        
        return view('hostel.tag.tag')->with('bnb',$bnb);
    }
    
    /**
     * 民宿已经关联tag list
     * 
     * @param type $id
     * @return type
     */
    public function tagRelation($id){
        $bnb = Bnb::findOrFail($id);
        
        return view('hostel.tag.tagRelation')->with('bnb',$bnb);
    }

    
    public function search(Request $request){
        $tag_name = $request->get('tag_name');
        
        $tag = Tag::where('name','like', '%' . $tag_name . '%')->get();
        
        return response($tag->toArray());
    }

    /**
     * 民宿绑定tag操作
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function tagStore(Request $request,$id){
        $bnb = Bnb::findOrFail($id);
        
        # 添加关联
        $tag = $request->get('tag',array());
        $tag = array_unique($tag);
        if(!empty($tag)){
            $bnb->tag()->attach($tag);   
        }
        Log::info('用户'.$this->logUser->id.'绑定民宿与标签',$tag);
        return redirect('/bnb/'.$id.'/tag')->with('message', '民宿标签关联成功');
    }
    
    public function delete($bid,$tid){
        $bnb = Bnb::findOrFail($bid);
        $tag = Tag::findOrFail($tid);
        
        return view('hostel.tag.delete')->with('tag',$tag)
                ->with('bnb',$bnb);
    }
    
    public function deleteRelation(Request $request,$bid,$tid){
        $bnb = Bnb::findOrFail($bid);
        $tag = Tag::findOrFail($tid);
        
        $bnb->tag()->detach($tid);
        Log::info('用户'.$this->logUser->id.'民宿与标签接触绑定',['bid'=>$bid,'tid'=>$tid]);
        return redirect('/bnb/'.$bid.'/tag')->with('message', '民宿标签删除成功');
    }
}
