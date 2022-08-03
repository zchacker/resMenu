<?php

namespace App\Http\Controllers;

use App\Models\MenuCategoriesModel;
use App\Models\MenueItemsModel;
use App\Models\MenusModel;
use App\Models\RestrantsModel;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index(Request $request)
    {
        
        return view('home.index');
    }

    public function menu(Request $request)
    {

        $restrant = RestrantsModel::where(['slug' => $request->slug])->first();

        if($restrant == NULL){
            return "no menu found";
        }else{
            
            // get menue 
            $menu = MenusModel::where(['restrant_id' => $restrant->id])->first();

            if($menu == NULL){
                
                return "menu NOT found";

            }else{

                $menucategories = MenuCategoriesModel::where(['menu_id' => $menu->id])->get();
                $menueitems     = MenueItemsModel::where(['menu_id' => $menu->id])
                ->join('files' , 'menueitems.image_file_id', '=' , 'files.id')
                ->get(['menueitems.*' , 'files.file_name']);                                           

                return view('menu1' , compact('menucategories' , 'menueitems'));

            }
        }

        //return view('home.index');
    }

}
