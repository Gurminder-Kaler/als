<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Str;

class ProductCategoryController extends Controller
{
    
    
   public function index()
   {
       $productCategories = ProductCategory::all();
       return view('backend.productCategory.index', compact('productCategories'));
   }

   public function children($id)
   {
        $children = ProductCategory::where('parent',$id)->get();
        $parent = ProductCategory::where('id',$id)->first();
        return view('backend.productCategory.child_show',compact('children','parent'));
   }

   public function create()
   {
       $allcategories =  ProductCategory::all();
       return view('backend.productCategory.create',compact('allcategories'));
   }


   public function store(Request $request)
   {
       $this->validate(
           $request,
           [
               'title' => 'required',
           ]
       );
       $data = new ProductCategory;
       $data->title = $request->title;
       $data->slug = Str::slug($request->title);
    //    $data->slug = str_slug($request->title);
       // $data->parent = $request->parent;
        if($request->hasfile('img'))
        {
           $image = $request->file('img');
           $img = time().$image->getClientOriginalName();
           $path = 'storage/productCategory/';
           $upload = $image->move($path, $img);
           $data->img = $img;
        }

       $data->save();
       return redirect('admin/productCategory')->with('flash_message', 'Product Category Added Successfully.');
   }

   public function show($id)
   {
       $product = ProductCategory::findOrFail($id);
       return view('backend.productCategory.show', compact('product'));
   }

   public function edit($id)
   {

       $productCategory = ProductCategory::findOrFail($id); 
       return view('backend.productCategory.edit',compact('productCategory'));
   }

   public function update(Request $request, $id)
   {
       $this->validate(
           $request,
            [
               'title' => 'required',
           ]
       );
       $data = ProductCategory::find($id);

       $data->title = $request->title;
       $data->slug = Str::slug($request->title);
    //    $data->slug = str_slug($request->title);
       // $data->parent = $request->parent;
       if($request->hasfile('img'))
        {
           $image = $request->file('img');
           $img = time().$image->getClientOriginalName();
           $path = 'storage/productCategory/';
           $upload = $image->move($path, $img);
           $data->img = $img;
        }

       $data->update();
       return redirect('admin/productCategory')->with('flash_message', 'Product Category Updated Successfully.');
   }

   public function destroy($id)
   {
       $product = ProductCategory::findOrFail($id);
       $product->delete();
       return redirect('admin/productCategory')->with('flash_message', 'Product Category Deleted Successfully.');
   }
   public function feature_category_status(Request $request)
   {
       $id = $request->id;
       $data = ProductCategory::find($id);
       if($data->feature_status==1)
       {
           $data->feature_status = 0;
       }
       else
       {
           $data->feature_status = 1;
       }
       $data->update();
   }
}
