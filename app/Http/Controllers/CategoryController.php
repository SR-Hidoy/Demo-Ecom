<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    //addcategory
    function addcategory(){
      $categories = Category::all();
      $deleted_categories = Category::onlyTrashed()->get();

      return view('admin.category.index', compact('categories', 'deleted_categories'));
    }
    function addcategorypost(Request $request){
      $request->validate([
        'category_name' => 'required|unique:categories,category_name',
        'category_photo' => 'required|image',
      ],[
        'category_name.required' => 'তোমার ক্যেটাগরি  কই..?',
        'category_name.unique' => 'You can not use this category name!!',
        // 'category_image.required' => 'The category photo must be an Image file.!',


      ]);


      // Laravel

    $category_id = Category::insertGetId([
        'category_name' => $request->category_name,
        'user_id' =>  Auth::user()->id,
        'category_photo' => $request->category_name,
        'created_at' => Carbon::now()
      ]);
      // Photos Upload start
      $uploaded_photo = $request->file('category_photo');
      $new_name = $category_id .".". $uploaded_photo->getClientOriginalExtension();
      $new_upload_location = base_path('public/uploads/category_photos/'.$new_name);
      image::make($uploaded_photo)->save($new_upload_location, 50);
      // Photos Upload end
      Category::find($category_id)->update([
          'category_photo' => $new_name
      ]);
      return back()->with('success_message', 'Your category added successfully!');

      // echo $request->category_name;
      // return view('admin.category.index');
    }
    function updatecategory($category_id){
      // echo $category_id;
      $category_name = Category::find($category_id)->category_name;
      return view('admin.category.update', compact('category_name', 'category_id'));
    }
    function updatecategorypost(Request $request){
      // print_r($request->category_name);
      // print_r($request->category_id);
      Category::find($request->category_id)->update([
        'category_name' => $request->category_name
      ]);
      return redirect('add/category')->with('update_status', 'Category Updated Successfully..!');
    }
    function deletecategory($category_id){
      // echo $category_id;
      Category::find($category_id)->delete();
      return back()->with('delete_status', 'Category Deleted Successfully.!');
      // $category_name = Category::find($category_id)->category_name;
      // return view('admin.category.delete', compact('category_name', 'category_id'));
    }
    function restorecategory($category_id){
      Category::withTrashed()->find($category_id)->restore();
      return back()->with('restore_status', 'Category Restored Successfully.!');
    }
    function harddeletecategory($category_id){
      Category::onlyTrashed()->find($category_id)->forceDelete();
      return back()->with('force_delete_status', 'Your Category force delete Successfully.!');
    }
}
