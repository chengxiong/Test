<?php 

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;  

class OrderController extends Controller
{
   public function index(){
        
        $paginate = Config::get('system.paginate');
        $order = Order::all();
        foreach ($order as $k){
            # code...
            $bnb = BnB::where('bid',$k->bid)->first();

            $room = Room::where('id',$k->rid)->first();

            $acc = AccountModel::where('accountId',$k->accountId)->first();

            foreach($acc as $k=>$value){

                    $phone = UsersModel::where('accountId',$acc)->first();

                   }
            $ordercancel = OrderCancel::where('oid',$k->oid)->first();

            $cancel = $ordercancel ? $ordercancel->cancelPrice : 0;

            $array[] = array(
                            'endtime'  => $k->endtime,
                            'city'    => $bnb->city,
                            'orderno' => $k->orderNo,
                            'bnb'   => $bnb->name,
                            'room'  => $room->name,
                            'price' => $room->price,
                            'day'   => $k->day,
                            'total' => $k->totalPrice,
                            'user'  => $acc->username,
                            'cancel'=> $cancel,
                            'telephone'=> $phone->$k,
                            'status' => $k->status,
                             );
        }

        return view('order.index')->with('order_list', $array);
    }

    # 订单列表页面取消订单   
    public function cancelShow($id){
        return view('order.cancelShow');
    }

    public function pending(){
        return view('order.pending');
    }

    public function confirm(){
        return view('order.confirm');
    }

    public function cancel(){
        //查询数据 拼装数组   订单号(order) 地址(account) 来源(bnb) 房型(bnb_type) 价格 总价 预定人 
        //假设取消订单状态为0  查询订单表的static＝0 的所有订单信息  根据staitic＝0的信息的 oid（订单ID） bid（民宿id）  

            $paginate = Config::get('system.paginate');
            $order = Order::all();//查询 订单表（order）中static＝0 的数据
            $orderid= OrderCancel::where('oid',$order['oid'])->first();
            
           
            $ordercancel = AccountModel::where('oid',$k->oid)->first();

            $cancel = $ordercancel ? $ordercancel->cancelPrice : 0;

        return view('order.cancel');
    }

    public function success(){
        return view('order.success');
    }

    public function search(){
        return view('order.search');
    }
}
