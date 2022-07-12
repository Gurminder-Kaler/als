<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Str;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        //dd($product);
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        $products = Product::all();
        $allcategories = ProductCategory::all();
        return view('backend.product.create', compact('products', 'allcategories'));
    }

    public function store(Request $request)
    {
        //    dd($request->all());
        $this->validate(
            $request,
            [
                'title' => 'required',
                'desc' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'discount' => 'required',
                'max_no_of_products' => 'required',
                'img' => 'required'

            ]
        );
        $data = new Product;
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->desc = $request->desc;
        $data->category_id = $request->category_id;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->max_no_of_products = $request->max_no_of_products;
        // if(isset($request->top_saver)){
        //     $data->top_saver_status =1;
        //   }else{
        //     $data->top_saver_status =0;
        //   }

        // if(isset($request->best_seller)){
        //     $data->best_offer =1;
        //   }
        //    else{
        //     $data->best_offer=0;
        //   }
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . $image->getClientOriginalName();
                $path = 'storage/product';
                $image->move($path, $name);
                $data1[] = $name;
            }
            $image_str = implode(';', $data1);
            $data->images = $image_str;
        }
        if ($request->hasfile('img')) {
            $image = $request->file('img');
            $img = time() . $image->getClientOriginalName();
            $path = 'storage/product/';
            $image->move($path, $img);
            $data->img = $img;
            if ($request->hasfile('images') == false) {
                $data->images = $img;
            }
        }

        $data->save();
        return redirect('admin/product')->with('flash_message', 'Product Added Successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('backend.product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $allcategories = ProductCategory::all();

        return view('backend.product.edit', compact('product', 'allcategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'desc' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'discount' => 'required',
                'max_no_of_products' => 'required',
            ]
        );
        $data = Product::find($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->desc = $request->desc;
        $data->category_id = $request->category_id;
        $data->price = $request->price;
        $data->discount = $request->discount;
        $data->max_no_of_products = $request->max_no_of_products;
        if ($request->hasfile('img')) {
            $image = $request->file('img');
            $img = time() . $image->getClientOriginalName();
            $path = 'storage/product/';
            $image->move($path, $img);
            $data->img = $img;
        }
        if (isset($request->img_c)) {
            $pimage_str = implode(';', $request->img_c);
            $data->images = $pimage_str;
        } else {
            $data->images = null;
        }
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name = time() . $image->getClientOriginalName();
                $path = 'storage/product';
                $image->move($path, $name);
                $data1[] = $name;
            }
            $image_str = implode(';', $data1);
            $data->images = $image_str;
            if (isset($request->img_c)) {
                $data->images = $image_str . ';' . $pimage_str;
            }
        }
        $data->update();
        return redirect('admin/product')->with('flash_message', 'Product Updated Successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('admin/product')->with('flash_message', 'Product Deleted Successfully.');
    }
    public function productStatus(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->update();
    }
    public function changeFeaturedStatus(Request $request)
    {
        $id = $request->id;
        $data = Product::findOrFail($id);
        if ($data->featured_status == 1) {
            $data->featured_status = 0;
        } else {
            $data->featured_status = 1;
        }
        $data->update();
    }
    public function topSaverStatus(Request $request)
    {
        $id = $request->id;
        $data = Product::find($id);
        if ($data->top_saver_status == 1) {
            $data->top_saver_status = 0;
        } else {
            $data->top_saver_status = 1;
        }
        $data->update();
    }
}
