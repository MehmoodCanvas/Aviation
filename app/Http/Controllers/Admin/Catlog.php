<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Variant;
use App\Models\Gift;
use Illuminate\Support\Facades\DB;

class Catlog extends Controller

{
   public function store_product(Request $request){
    $product= new Product();    
    if($request->hasfile('product_image')){
        $imageName = time().$request->product_name.'.'.$request->product_image->extension();  
     
        $request->product_image->move(public_path('storage/product'), $imageName);
        $product->product_image=$imageName;
    }
        $product->product_name=$request->product_name;
        $product->product_description= $request->product_description;
        $product->product_price= $request->product_price;
        $product->product_status= $request->product_status;
        $product->product_category_id= $request->product_category_id;
        $saved=$product->save();
          if ($request->has('size') && $request->has('price')) {
                $sizes = $request->input('size');
                $prices = $request->input('price');
                foreach ($sizes as $index => $size) {
                    if (empty($size) || empty($prices[$index])) {
                        return redirect()->back()->with('error', 'Please Fill All Sizes and Prices');
                    }
                    $variant = new Variant();
                    $variant->variant_name = $size;
                    $variant->variant_price = $prices[$index];
                    $variant->variant_product_id = $saved;
                    $variant->save();
                }
            }
        if($saved){
            return redirect()->back()->with('success','Your Product is Sucessfully Added');
        }else{
            return redirect()->back()->with('error','Opps Error!');

        }
   }


   public function edit_product(Request $request,$id){
    $product= Product::find($id);
    
    if($request->hasfile('product_image')){
        $imageName = time().'.'.$request->product_image->extension();  
     
        $request->product_image->move(public_path('storage/product'), $imageName);
        $product->product_image=$imageName;
    }

    if($request->hasFile('images')){
        $files = $request->file('images');
        $filess=[];
    foreach($files as $file){
        $filename = time() . $file->getClientOriginalName();   
        $file->move(public_path('storage/product/multiple'), $filename);
        $filess[]=$filename;
    
        }
        $product->product_multiple_images=json_encode($filess);

    }


        $product->product_name=$request->product_name;
        $product->product_description= $request->product_description;
        $product->product_brand_id= $request->product_brand_id;
        $product->product_category_id= $request->product_category_id;
        $product->product_sub_category_id= $request->product_sub_category_id;
        $product->product_sku= $request->product_sku;
        $product->product_price= $request->product_price;
        $product->product_discount_price= $request->product_discount_price;
        $product->product_status= $request->product_status;
        $product->product_created_by= $request->session()->get('admin_id');
        $product->product_updated_by= $request->session()->get('admin_id');
       $saved= $product->save();

        $oldvariant=DB::table('product_variant')->where('product_variant_product_id',$id)->delete();
        $variant=$request->product_variant;
        if(isset($variant)){
            foreach($variant as $variants){
                $productvariant= new Product_variant();
                $productvariant->product_variant_variant_id= $variants;
                $productvariant->product_variant_product_id= $id;
                $productvariant->save();
            }
        }
        
        if($saved){
            return redirect()->back()->with('success','Your Product is Sucessfully Updated!');
        }else{
            return redirect()->back()->with('error','Opps Error!');

        }
   }


   public function store_category(Request $request){
    $category= new Category();
    if($request->hasfile('category_image')){
        $imageName = time().'.'.$request->category_image->extension();  
     
        $request->category_image->move(public_path('storage/category'), $imageName);
    }
    if($request->hasfile('category_banner_image')){
        $categorybannerimage = time().'.'.$request->category_banner_image->extension();  
     
        $request->category_banner_image->move(public_path('storage/category'), $imageName);
    }

        $category->category_name=$request->category_name;
        $category->category_slug= Str::slug($request->category_name, '-');
        $category->category_image=$imageName;
        $category->category_banner_image=$categorybannerimage;
        $category->category_heading=$request->category_heading;
        $category->category_text=$request->category_text;
       $saved= $category->save();
        if($saved){
            return redirect()->back()->with('success',"Successfully Added New Category");
        }else{
            return redirect()->back()->with('error',"Opps! System is Hot");

        }
   }

   public function edit_category(Request $request,$id){
    $category= Category::find($id);
    if($request->hasfile('category_image')){
        $imageName = time().'.'.$request->category_image->extension();  
     
        $request->category_image->move(public_path('storage/category'), $imageName);
        $category->category_image=$imageName;

    }
    if($request->hasfile('category_banner_image')){
        $categorybannerimage = time().'.'.$request->category_banner_image->extension();  
     
        $request->category_banner_image->move(public_path('storage/category'), $imageName);
        $category->category_banner_image=$categorybannerimage;

    }

        $category->category_name=$request->category_name;
        $category->category_slug= Str::slug($request->category_name, '-');
        $category->category_heading=$request->category_heading;
        $category->category_text=$request->category_text;
       $saved= $category->save();
        if($saved){
            return redirect()->back()->with('success',"Successfully Updated Category");
        }else{
            return redirect()->back()->with('error',"Opps! System is Hot");

        }
   }

   public function store_attribute(Request $request){
        $attribute= new Attribute();
        $attribute->attribute_name=$request->attribute_name;
        $attribute->attribute_type=$request->attribute_type;
        $attribute->attribute_created_by=Auth::id();
        $attribute->attribute_updated_by=Auth::id();
        $save= $attribute->save();
        if($save=='true'){
            return redirect()->back()->with('success','Attribute Added');
        }else{
            return redirect()->back()->with('error','Error in Submitting');

        }
   }

   public function edit_attribute(Request $request,$id){
    $attribute= Attribute::find($id);
    $attribute->attribute_name=$request->attribute_name;
    $attribute->attribute_type=$request->attribute_type;
    $attribute->attribute_updated_by=Auth::id();
    $save= $attribute->save();
    if($save=='true'){
        return redirect()->back()->with('success','Attribute Updated');
    }else{
        return redirect()->back()->with('error','Error in Submitting');

    }

   }

   public function store_variant(Request $request){
     $variant = new Variant();
     $variant->variant_name=$request->variant_name;
     $variant->variant_price=$request->variant_price;
     $variant->variant_sku=$request->variant_sku;
     $variant->variant_attrbuite_id=$request->variant_attrbuite_id;
     $variant->variant_created_by=Auth::id();
     $variant->variant_updated_by=Auth::id();
     $save=$variant->save();
     if($save=='true'){
        return redirect()->back()->with('success','Variant Added');
    }else{
        return redirect()->back()->with('error','Error in Submitting');

    }

   }


   public function edit_variant(Request $request,$id){
    $variant = Variant::find($id);
    $variant->variant_name=$request->variant_name;
    $variant->variant_price=$request->variant_price;
    $variant->variant_sku=$request->variant_sku;
    $variant->variant_attrbuite_id=$request->variant_attrbuite_id;
    $variant->variant_updated_by=Auth::id();
    $save=$variant->save();
    if($save=='true'){
       return redirect()->back()->with('success','Variant Updated!');
   }else{
       return redirect()->back()->with('error','Error in Submitting');

   }

  }

  public function add_gift(Request $request){
    $gift= new Gift();
        $gift->gift_title=$request->gift_title;
        $gift->gift_description=$request->gift_description;
        $gift->gift_shipping_returns=$request->gift_shipping_returns;
        $gift->gift_price=$request->gift_price;

    if($request->hasfile('gift_image')){
        $giftimage = time().'.'.$request->gift_image->extension();  
     
        $request->gift_image->move(public_path('storage/gift'), $giftimage);
        $gift->gift_image=$giftimage;

    }    

    $save=$gift->save();
    if($save=='true'){
        return redirect()->back()->with('success','Gift Added!');
    }else{
        return redirect()->back()->with('error','Error in Submitting');
 
    }  
}   
    public function edit_gift(Request $request,$id){
        $gift= Gift::find($id);
        $gift->gift_title=$request->gift_title;
        $gift->gift_description=$request->gift_description;
        $gift->gift_shipping_returns=$request->gift_shipping_returns;
        $gift->gift_price=$request->gift_price;

    if($request->hasfile('gift_image')){
        $giftimage = time().'.'.$request->gift_image->extension();  
     
        $request->gift_image->move(public_path('storage/gift'), $giftimage);
        $gift->gift_image=$giftimage;

    }    

    $save=$gift->save();
    if($save=='true'){
        return redirect()->back()->with('success','Gift Added!');
    }else{
        return redirect()->back()->with('error','Error in Submitting');
 
    }          
    }


    public function destroy($id) {

        $Product = Product::find($id);
    
        $Product->delete();
    
        return redirect()->back()->with('success', 'Product Deleted!');
    
    }

    public function destroy_gift($id){
        $Gift = Gift::find($id);
    
        $Gift->delete();
    
        return redirect()->back()->with('success', 'Gift Card Deleted!');
    }
   
}
