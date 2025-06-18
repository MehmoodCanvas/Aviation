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

        return view('admin.index');
    }

    public function products(){
        $user = Auth::user();
        if($user){
            $product= Product::all();
        return view('admin.product',compact('product'));
    }else{
       return redirect('/admin/login');
    }
    }
    public function add_product(){
        $category= DB::table('category')->get();
        return view('admin.product-add',compact('category'));
   
    }

    public function edit_product($id){
        $user = Auth::user();
        if($user){
            $product= DB::table('product')->where('product_id',$id)->first();
        return view('admin.edit-product',compact('product'));
    }else{
       return redirect('/admin/login');
    }   
    }

    public function orders(){
        $user = Auth::user();
        if($user){
            $order= DB::table('order')->join('order_item','order_item_order_id','order_id')->join('product','product_id','order_item_product_id')->get();

            return view('admin.order',compact('order'));
    }else{
       return redirect('/admin/login');
    } 
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
