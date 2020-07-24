<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use DB;
use Session;

class ProductsController extends Controller
{
    public function welcome(){
    	$product= Product::get();
    	$cartDetails= Cart::get();
    	return view('welcome')->with(compact('product', 'cartDetails'));
    }

    public function cart(Request $request){

    	$data= $request->all();
        // echo "<pre>";print_r($data);die;
        
        $session_id= Session::get('session_id');
        if(empty($session_id)){
         $session_id= str_random(40);
        Session::put('session_id', $session_id);
         }

        
        $countProducts=  DB::table('carts')->where(['product_id'=>$data['product_id'], 'product_name'=>$data['product_name']])->count();
        if($countProducts>0){
            return redirect()->back()->with('flash_message_error', 'Product already exists in cart');
        }
        else{
            DB::table('carts')->insert(['product_id'=>$data['product_id'], 'product_name'=>$data['product_name'], 'product_price'=>$data['product_price'], 'quantity'=>$data['quantity'], 'session_id'=>$session_id]);
        }
        
        
        return redirect()->back()->with('flash_message_success','Product has been added to cart!!');

    }

    public function deleteCartProduct($id=null){
       
        DB::table('carts')->where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_error', 'Product has been deleted!!');
    }
}
