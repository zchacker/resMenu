<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RestrantsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Qr extends Controller
{
    public function showQr(Request $request)
    {
        $user_id = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();
        $avatar_img = '';

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

        

        return view('client_dashboard.qr.updateQr' , compact('avatar_img' , 'restrant'));
    }


    public function updateQr(Request $request)
    {

        $user_id  = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();

        $rules = array(
            'qr_size' => 'required',
            'qr_with_logo' => 'required'                        
        );

        $messages = [
            'qr_size.required' => __('qr_size_required'),
            'qr_with_logo.required' => __('qr_with_logo_required')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ( $validator->fails() == true ) {

            $error     = $validator->errors();
            $allErrors = "";

            foreach ($error->all() as $err) {
                $allErrors .= $err . " <br/>";
            }

            return back()->withErrors(['error' => $allErrors]);

        } else {
                       
            $restrant->qr_size      = $request->qr_size;
            $restrant->qr_with_logo = $request->qr_with_logo;

            if ($restrant->update()) {
                
                return back()->with(['success' => __('updated_successfuly')]);

            } else {
                
                return back()->withErrors(['error' => __('unknown_error')]);

            }

        }

    }

    public function total_ram_cpu_usage(Request $request)
    {

        //RAM usage
        $free = shell_exec('free'); 
        $free = (string) trim($free);
        $free_arr = explode("\n", $free);
        $mem = @explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $usedmem = @$mem[2];
        $usedmemInGB = number_format($usedmem / 1048576, 2) . ' GB';
        @$memory1 = $mem[2] / $mem[1] * 100;
        $memory = round($memory1) . '%';
        @$fh = fopen('/proc/meminfo', 'r');
        $mem = 0;
        while (@$line = fgets($fh)) {
            $pieces = array();
            if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line, $pieces)) {
                $mem = $pieces[1];
                break;
            }
        }
        @fclose($fh);
        $totalram = number_format($mem / 1048576, 2) . ' GB';
        
        //cpu usage
        @$cpu_load = sys_getloadavg(); 
        $load = $cpu_load[0] . '% / 100%';
        
        return view('details',compact('memory','totalram','usedmemInGB','load'));

    }


}
