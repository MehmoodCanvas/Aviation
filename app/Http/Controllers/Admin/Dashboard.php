<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{

    public function index(){
        $cfi= DB::table('member')->where('member_role',1)->count();
        $student= DB::table('member')->where('member_role',2)->count();
        return view('admin.index',compact('cfi','student'));
    }

    public function all_users(){
      
      $users= DB::table('member')->join('role','role_id','member_role')->select('member.member_id','member.member_full_name','member.member_email','member.member_status','role.role_name')->get();      
      return view('admin.user',compact('users'));

    }
    public function logs(){
      
        $logs=null;
        return view('admin.logs',compact('logs'));
   
    }

    public function certificates(){
        
        $certificates= null;
        return view('admin.certificates',compact('certificates'));
    }   

    public function orders(){
      
        $order= DB::table('order')->join('order_item','order_item_order_id','order_id')->join('product','product_id','order_item_product_id')->get();
        return view('admin.order',compact('order'));
    }

    public function order_view($id){
      
        $order=DB::table('order')->where('order_id',$id)->first();
        $order_item= DB::table('order_item')->where('order_item_order_id',$id)->get();
        foreach($order_item as $items){
            $products[]= DB::table('product')->where('product_id',$items->order_item_product_id)->get();
        }
       $product=$products;   
       return view('admin.invoice',compact('order','product'));
    
    }
}
