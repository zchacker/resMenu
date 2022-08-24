<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\FileModel;
use App\Models\RestrantsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Home extends Controller
{

    public function index(Request $request)
    {

        return view('client_dashboard.home');
    }

    public function shop(Request $request)
    {
        $user_id = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();

        $cover_img = '';
        $avatar_img = '';


        if( ! empty($restrant->cover) )
        {
            $cover_img_query = DB::table('files')
            ->select('file_name')
            ->where('id' , '=' , $restrant->cover )
            ->get();

            if($cover_img_query != NULL){
                $cover_img = $cover_img_query[0]->file_name;
            }
        }
        

        if(! empty($restrant->avatar))
        {
            $avatar_img_query = DB::table('files')
            ->select('file_name')
            ->where('id' , '=' , $restrant->avatar )
            ->get();

            if($avatar_img_query != NULL){
                $avatar_img = $avatar_img_query[0]->file_name;
            }
        }
        
        return view('client_dashboard.shop', compact( 'restrant' , 'cover_img', 'avatar_img' ));
    }

    public function updateShop(Request $request)
    {
        $user_id  = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();

        $rules = array(
            'name' => 'required',
            'address' => 'required',
            'working_hours' => 'required',
            'phone' => 'required',
            'avatar' => 'mimes:jpeg,png,jpg|image|max:7000',
            'cover' => 'mimes:jpeg,png,jpg|image|max:7000',
        );

        $messages = [
            'name.required' => __('shop_name_required'),
            'address.required' => __('shop_address_required'),
            'working_hours.required' => __('working_hours_required'),
            'phone.required' => __('phone_required'),            
            'avatar.mimes' => __('item_img_notvalid'),
            'avatar.max' => __('item_img_size_notvalid' , ['size' => '7']),
            'avatar.image' => __('item_img_notvalid'),
            'cover.mimes' => __('item_img_notvalid'),
            'cover.max' => __('item_img_size_notvalid' , ['size' => '7']),
            'cover.image' => __('item_img_notvalid'),
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
            
            // upload avatar image            
            $this->upload_avatar( $request , $restrant);

            // upload cover image
            $this->upload_cover( $request , $restrant);

            $restrant->name = $request->name;
            $restrant->message = $request->message;
            $restrant->address = $request->address;
            $restrant->phone = $request->phone;
            $restrant->working_hours = $request->working_hours;
            $restrant->slug = $request->slug;
            $restrant->latitude = $request->latitude;
            $restrant->longitude = $request->longitude;
            $restrant->orders_allow = $request->orders_allow;
            $restrant->payment_allow = $request->payment_allow;
            $restrant->payment_token = $request->payment_token;

            if ($restrant->update()) {
                
                return back()->with(['success' => __('updated_successfuly')]);

            } else {
                
                return back()->withErrors(['error' => __('unknown_error')]);

            }
        }
    }


    private function upload_avatar(&$request , &$restrant)
    {
        // if the user upload image
        if($request->has('avatar')){            

            $temp_hash  = hash_file('sha256', $request->avatar->getRealPath());
            $fileDB     = FileModel::where(['hash' => $temp_hash])->first();        
            
            // look for file via hash                
            if( $fileDB === NULL){

                // TODO: this to change file name
                /*
                    $file_extension = $request->file->extension();
                    $file_mime_type = $request->file->getClientMimeType();
                    $original_file_name = $request->file->getClientOriginalName();
                    
                    $file = Input::file('upfile')->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                */                    
                
                $original_file_name = $request->avatar->getClientOriginalName();
                $fileName = time() . '_' . $original_file_name. '.' . $request->avatar->extension();
                $request->avatar->storeAs('imgs', $fileName); // save in private path

                $filepath = storage_path('app/imgs/' . $fileName);
                $hash =  hash_file('sha256', $filepath);

                $fileAdded = FileModel::create([
                    'file_name' => $fileName,
                    'hash' => $hash,
                ]);                   

                $restrant->avatar = $fileAdded->id;

            }else{
                
                $restrant->avatar = $fileDB->id;

            }

        }// end image upload
    }

    private function upload_cover(&$request , &$restrant)
    {
        // if the user upload image
        if($request->has('cover')){

            $temp_hash  = hash_file('sha256', $request->cover->getRealPath());
            $fileDB     = FileModel::where(['hash' => $temp_hash])->first();        
            
            // look for file via hash                
            if( $fileDB === NULL){

                // TODO: this to change file name
                /*
                    $file_extension = $request->file->extension();
                    $file_mime_type = $request->file->getClientMimeType();
                    $original_file_name = $request->file->getClientOriginalName();
                    
                    $file = Input::file('upfile')->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                */                    
                
                $original_file_name = $request->cover->getClientOriginalName();
                $fileName = time() . '_' . $original_file_name. '.' . $request->cover->extension();
                $request->cover->storeAs('imgs', $fileName); // save in private path

                $filepath = storage_path('app/imgs/' . $fileName);
                $hash =  hash_file('sha256', $filepath);

                $fileAdded = FileModel::create([
                    'file_name' => $fileName,
                    'hash' => $hash,
                ]);                   

                $restrant->cover = $fileAdded->id;

            }else{
                
                $restrant->cover = $fileDB->id;

            }

        }// end image upload
    }

}
