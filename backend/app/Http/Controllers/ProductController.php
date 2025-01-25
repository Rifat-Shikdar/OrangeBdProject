<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        
        if($products->count() > 0){
        return response()->json([
            'status' => 200,
            'prodcuts' => $products,
        ],200);
      }else{
        return response()->json([
            'status' => 404,
            'message' => 'No Records Found',
        ],404);
      }
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'price'=> '',

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors' => $validator->messages()
            ], 422);
        }else{
            $product = Product::create([
                'name'=> $request->name,
                'price'=> $request->price,
            ]);

            if($product){

                return response()->json([
                    'status'=> 200,
                    'message' => 'Product Created SuccessFully',
                ], 200);

            }else{

                return response()->json([
                    'status'=> 500,
                    'message' => 'Something went wrong !!',
                ], 500);

            }
        }
    }

    public function show ($id){
        $product = Product::find($id);
        if($product){

            return response()->json([
                'status'=> 200,
                'product' => $product,
            ], 200);

        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'No Such Product Found',
            ], 404);
        }
    }
    public function edit($id){

        $product = Product::find($id);
        if($product){

            return response()->json([
                'status'=> 200,
                'product' => $product,
            ], 200);

        }else{
            return response()->json([
                'status'=> 404,
                'message' => 'No Such Product Found',
            ], 404);
        }
    }
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:191',
            'price'=> '',

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors' => $validator->messages()
            ], 422);
        }else{


            $product = Product::find($id);
            
            if($product){

                $product->update([
                    'name'=> $request->name,
                    'price'=> $request->price,
                ]);

                return response()->json([
                    'status'=> 200,
                    'message' => 'Product updated SuccessFully',
                ], 200);

            }else{

                return response()->json([
                    'status'=> 404,
                    'message' => 'Not Found!!',
                ], 404);

            }
   
        }
  
    }

    public function delete($id){
        $product = Product::find($id);
        if($product){
             $product->delete();
             return response()->json([
                'status'=> 200,
                'message' => 'Product deleted SuccessFully',
            ], 200);
        }
        else{
            return response()->json([
                'status'=> 404,
                'message' => 'Not Found!!',
            ], 404);
        }
    }


    public function search($name)  
{
    if (empty($name)) {
        return response()->json([
            'status' => 422,
            'message' => 'Product name is required.',
        ], 422);
    }

    
    $products = Product::where('name', 'like', '%' . $name . '%')->get();

    if ($products->count() > 0) {
        return response()->json([
            'status' => 200,
            'products' => $products,
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'No products found with the given name.',
        ], 404);
    }
}

}