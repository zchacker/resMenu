<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MenuCategoriesModel;
use App\Models\MenusModel;
use App\Models\RestrantsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class Menu extends Controller
{

    public function categories(Request $request)
    {

        $user_id = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();
        
        if ($restrant) {

            $restrant_id = $restrant->id;
            $menu = MenusModel::where(['restrant_id' => $restrant_id])->first();

            if ($menu) {

                $menu_id = $menu->id;
                $categories = MenuCategoriesModel::where(['menu_id' => $menu_id])->get();
                return view('client_dashboard.menu.categories', compact('categories'));

            } else {

                abort(Response::HTTP_NOT_FOUND);

            }

        } else {

            abort(Response::HTTP_NOT_FOUND);

        }

    }

    public function add_category(Request $request)
    {
        return view('client_dashboard.menu.add_category');
    }


    public function add_category_submit(Request $request)
    {
        $user_id = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();
        $menu = MenusModel::where(['restrant_id' => $restrant->id])->first();
        $rules = array(
            'name' => 'required'
        );

        $messages = [
            'name.required' => __('category_name_required')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails() == true) {

            $error     = $validator->errors();
            $allErrors = "";

            foreach ($error->all() as $err) {
                $allErrors .= $err . " <br/>";
            }

            return back()->withErrors(['error' => $allErrors]);

        } else {

            $category = new MenuCategoriesModel();
            $category->title_ar = $request->name;            
            $category->title_en = $request->name;            
            $category->menu_id = $menu->id;            

            if ($category->save()) {
                
                return back()->with(['success' => __('added_successfuly')]);

            } else {
                
                return back()->withErrors(['error' => __('unknown_error')]);

            }
        }
    }

}
