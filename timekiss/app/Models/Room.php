<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "rooms";
    
    protected $fillable = [
        'name', 'bid', 'tid','tkOwned','introduction','price','number','size','bed_type','bed_width','status',
        'checkInTime','checkOutTime','breakfast','shuttle','changePrice','tk_wow',
    ];
    
    public function image(){
        return $this->hasMany('App\Models\RoomImage', 'rid', 'id');
    }
    
    public function tkOwned(){
        return $this->hasMany('App\Models\RoomTkOwned', 'rid', 'id');
    }
    
    public function tkOwnedList(){
        $arr = array();
        
        if($this->tkOwned()->count() > 0){
            foreach($this->tkOwned()->get() as $tk){
                $arr[] = $tk->id;
            }
        }
        
        return $arr;
    }
    
    public function tkTime(){
        return $this->hasMany('App\Models\PriceTag','rid','id');
    }
    
    public function tkTimeList(){
        $arr = array();
        if($this->tkTime()->count() > 0){
            foreach($this->tkTime()->get() as $tk){
                $arr[] = $tk->id;
            }
            unset($tk);
        }
        
        return $arr;
    }
}
