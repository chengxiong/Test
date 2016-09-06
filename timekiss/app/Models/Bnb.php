<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * 民宿基本数据
 */
class Bnb extends Model {

    protected $table = "bnb";
    protected $primaryKey = 'bid';
    public $timestamps = false;
    protected $fillable = [
        'bid',
        'name', 'title', 'subTitle1', 'subTitle2',
        'author', 'address', 'lng', 'lat',
        'phone', 'status',
        'profession',
        'score1', 'score2', 'score3', 'score',
        'clickNum', 'likeNum', 'createTime', 'updateTime',
        'contactStatus',
        'website', 'buildDate', 'totalRoom', 'level',
        'province', 'city', 'region', 'country','hosterSay',
    ];

    # 关联bnbContent
    public function bnbContent() {
        return $this->hasOne('App\Models\BnbContent', 'bid', 'bid');
    }

    # 关联bnbImage
    public function bnbImage() {
        return $this->hasMany('App\Models\BnbImage', 'bid', 'bid');
    }

    # 关联BnbService
    public function bnbService() {
        return $this->belongsToMany('App\Models\Service','bnb_service', 'bid', 'sid');
    }

    /**
     * 服务列表
     * @return type
     */
    public function serviceList() {
        $result = array();
        if ($this->bnbService()->count() > 0) {
            foreach ($this->bnbService()->get() as $service){
                $result[] = $service->id;
            }
        }
        
        return $result;
    }
    
    # hostel
    public function hoster(){
        return $this->belongsToMany('App\Models\Hoster','bnb_hoster', 'bid', 'hid');
    }
    
    
    public function bnbHoster(){
        return $this->hasMany('App\Models\BnbHoster', 'bid', 'bid');
    }
    public function bnbHosterList(){
        $arr = array();
        $arr['hoster'] = array();
        $arr['manager'] = array();
        if($this->bnbHoster()->count() > 0 ){
            foreach($this->bnbHoster()->get() as $key=>$role){
                $arr['bid'][] = $role->bid;
                $tmp = $role->role;
                if($tmp == 1){
                    $arr['hoster'][] = $role->hid;
                }elseif($tmp == 2){
                    $arr['manager'][] = $role->hid;
                }
            }
        }
         
         return $arr;
    }
    
    # layout
    public function layout(){
        return $this->hasMany('App\Models\BnbLayout', 'bid', 'bid');
    }
    
    # account
    public function account($id){
        return DB::table('bnb_account')
                    ->join('account','bnb_account.account_id','=','account.accountId')
                    ->where('bnb_account.bnb_id',$id)
                    ->select('account.*');
    }
    
    public function accountList($id){
        $arr = array();
        if($this->account($id)->count() > 0 ){
            foreach($this->account($id)->get() as $key=>$account){
                $arr[] = $account->accountId;
            }
         } 
        return $arr;
    }
    
    # tag
    public function tag(){
        return $this->belongsToMany('App\Models\Tag','bnb_tag', 'bid', 'tid');
    }
}
