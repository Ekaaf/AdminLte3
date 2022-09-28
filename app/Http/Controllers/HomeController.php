<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\FoodItems;
use App\Models\Category;
use App\Models\AdmissionInfo;
use App\Models\ExistingStudent;
use App\Service\MenuService;
use DB;
use App\SSP;

class HomeController extends Controller
{
    
    
    public function dashboard(Request $request)
    {   
        return view('admin.dashboard');

    }

    public function foodItems(Request $request){
        return view('admin.foodItems.list');
    }


    public function getAllfooditems(Request $request){
        $table = 
            "(SELECT categories.category, food_items.* from categories inner join food_items on categories.id = food_items.category_id) testtable";

        

        $primaryKey = 'id';
        $columns = array(

            array( 'db' => 'id', 'dt' => 'id' ),

            array( 'db' => 'category', 'dt' => 'category' ),

            array( 'db' => 'title', 'dt' => 'title' ),

            array( 'db' => 'description', 'dt' => 'description' ),

            array( 'db' => 'price', 'dt' => 'price' ),

            array( 'db' => 'image', 'dt' => 'image' )
        );

        $database = config('database.connections.mysql');

        $sql_details = array(
            'user' => $database['username'],
            'pass' => $database['password'],
            'db'   => $database['database'],
            'host' => $database['host']
        );

        $result =  SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns);

        $start=$_REQUEST['start']+1;

        $idx=0;

        foreach($result['data'] as &$res){

            $res[0]=(string)$start;

            $start++;

            $idx++;

        }
        echo json_encode($result);

    }


    public function addFooditems(Request $request){
        $category = Category::all();
        return view('admin.foodItems.addFooditems')->with('category', $category);
    }

    public function saveFooditems(Request $request){
        $items = FoodItems::where('category_id', $request->category_id)->where('title', $request->title)->first();
        if(!is_null($items)){
            return redirect('admin/fooditems/add')->withInput()->with('error', "Same food item already exists");;
        }
        $folder = public_path().'/fooditems';
        $filename = date("Y_m_d_H_i_s").'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($folder,$filename);
        
        $item = new FoodItems();
        $item->category_id = $request->category_id;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = "public/fooditems/".$filename;
        $item->save();

        return redirect('admin/fooditems')->with('success', "Successfully Saved");;
    }

    public function editFooditems(Request $request,$id){
        $category = Category::all();
        $item = FoodItems::find($id);
        return view('admin.fooditems.editfooditems')->with('item', $item)->with('category', $category);
    }

    public function updateFooditems(Request $request,$id){
        $item = FoodItems::where('id', '!=', $id)->where('category_id', $request->category_id)->where('title', $request->title)->first();
        if(!is_null($item)){
            return redirect()->back()->with('error', "Same food item already exists")->withInput();
        }
        $item = FoodItems::find($id);
        $item->category_id = $request->category_id;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;
        if(null !== $request->file('image')){
            $folder = public_path().'/fooditems';
            $filename = date("Y_m_d_H_i_s").'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($folder,$filename);
            $item->image = "public/fooditems/".$filename;
        }
        

        $item->save();
        return redirect('admin/fooditems')->with('success', "Successfully updated");
    }


    public function deleteFooditems(Request $request, $id){
        $item = FoodItems::where('id', $id)->delete();
        if($item){
            return 1;
        }
        else{
            return 0;
        }
    }

}
