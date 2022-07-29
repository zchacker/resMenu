<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\FileModel;
use App\Models\MenuCategoriesModel;
use App\Models\MenueItemsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuItem extends Controller
{
    
    public function items(Request $request)
    {

        $category_id = $request->category_id;
        $category = MenuCategoriesModel::where(['id' => $request->category_id])->first();
        $items = MenueItemsModel::where(['menu_category_id' => $request->category_id])
        ->join('files' , 'menueitems.image_file_id', '=' , 'files.id')
        ->get(['menueitems.*' , 'files.file_name']);

        return view('client_dashboard.menu_item.items', compact('category' , 'items' , 'category_id'));
    }

    public function add_item(Request $request)
    {
        $category_id = $request->category_id;
        return view('client_dashboard.menu_item.add_item' , compact('category_id'));
    }

    public function add_item_submit(Request $request)
    {

        $category_id = $request->category_id;

        if($category_id == NULL){
            return back()->withErrors(['error' => __('unknown_error')]);
        }

        $category = MenuCategoriesModel::where(['id' => $category_id])->first();

        if($category == NULL){
            return back()->withErrors(['error' => __('unknown_error')]);
        }

        $menu_id = $category->menu_id;

        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            //'offer_price' => 'required',
            'item_img' => 'required|mimes:jpeg,png,jpg,gif,svg|image|max:7000'
        );

        $messages = [
            'name.required' => __('item_name_required'),
            'description.required' => __('item_description_required'),
            'price.required' => __('item_price_required'),
            'offer_price.required' => __('item_offer_price_required'),
            'item_img.required' => __('item_img_required'),
            'item_img.mimes' => __('item_img_notvalid'),
            'item_img.max' => __('item_img_size_notvalid' , ['size' => '7']),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails() == true) {

            $error     = $validator->errors();
            $allErrors = "";

            foreach ($error->all() as $err) {
                $allErrors .= $err . " <br/>";
            }

            return back()->withErrors(['error' => $allErrors])
                         ->withInput($request->all());

        } else {

            $temp_hash  = hash_file('sha256', $request->item_img->getRealPath());
            $fileDB     = FileModel::where(['hash' => $temp_hash])->first();        
            // look for file vis hash

            if ($fileDB == null) {

                // TODO: this to change file name
                /*
                    $file = Input::file('upfile')->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                */
                
                $fileName = time() . '.' . $request->item_img->extension();
                $request->item_img->storeAs('imgs', $fileName); // save in private path

                $filepath = storage_path('app/imgs/' . $fileName);
                $hash =  hash_file('sha256', $filepath);

                $fileAdded = FileModel::create([
                    'file_name' => $fileName,
                    'hash' => $hash,
                ]);

                $file_id = $fileAdded->id;
                
                $item = new MenueItemsModel();
                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->offer_price = $request->offer_price;
                $item->menu_id = $menu_id;
                $item->menu_category_id = $category_id;
                $item->image_file_id = $file_id;
              
                if ($item->save()) {
                    
                    return back()->with(['success' => __('added_successfuly')]);
    
                } else {
                    
                    return back()->withErrors(['error' => __('unknown_error')])->withInput($request->all());
    
                }
                
            } else {

                $file_id = $fileDB->id;

                $item = new MenueItemsModel();
                $item->name = $request->name;
                $item->description = $request->description;
                $item->price = $request->price;
                $item->offer_price = $request->offer_price;
                $item->menu_id = $menu_id;
                $item->menu_category_id = $category_id;
                $item->image_file_id = $file_id;
              
                if ($item->save()) {
                    
                    return back()->with(['success' => __('added_successfuly')]);
    
                } else {
                    
                    return back()->withErrors(['error' => __('unknown_error')])->withInput($request->all());
    
                }

            }
        

        }
    }

    public function edit_item(Request $request)
    {
        $category_id = $request->category_id;
        return view('client_dashboard.menu_item.edit_item' , compact('category_id'));
    }


}
