<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Utilitie;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class UtilitiesController extends Controller
{
    public function index(){

            return view('admin.vitrine.index');

    }

    public function store(Request $request){
         $utilities = Utilitie::first();
         if (!isset($utilities)) {
            $utilities = Utilitie::create([
                'emails'=> NULL,
                'phones' => NULL,
                'logo'=> NULL,
                'banner1'=> NULL,
                'banner2'=> NULL,
                'banner3'=> NULL
            ]);
         }
         $data = json_encode($request->all());
         $params = json_decode($data,true);
        if ($request->has('logo')) {
            $image = $request->file('logo');
            $fileName = time().'_logo.'.$image->getClientOriginalExtension();
            $image->storeAs('public','utilities/pictures/'.$fileName);
            $utilities->update([
                'logo' => 'storage/utilities/pictures/'.$fileName
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'logo has been added !'
            ]);
        }else if ($request->has('banner1')) {
            $image = $request->file('banner1');
            $fileName = time().'_banner1.'.$image->getClientOriginalExtension();
            $image->storeAs('public','utilities/pictures/'.$fileName);
            $utilities->update([
                'banner1' => 'storage/utilities/pictures/'.$fileName
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'banner 1 has been added !'
            ]);
        }else if ($request->has('banner2')) {
            $image = $request->file('banner2');
            $fileName = time().'_banner2.'.$image->getClientOriginalExtension();
            $image->storeAs('public','utilities/pictures/'.$fileName);
            $utilities->update([
                'banner2' => 'storage/utilities/pictures/'.$fileName
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'banner 2 has been added !'
            ]);
        }else if ($request->has('banner3')) {
            $image = $request->file('banner3');
            $fileName = time().'_banner3.'.$image->getClientOriginalExtension();
            $image->storeAs('public','utilities/pictures/'.$fileName);
            $utilities->update([
                'banner3' => 'storage/utilities/pictures/'.$fileName
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'banner 3 has been added !'
            ]);
        }else {
            $utilities->update($params);
            return response()->json([
                'status' => 200,
                'message' => json_encode($params)
            ]);
        }
    }

    public function show(){
        $utilities = Utilitie::first();
        if (!isset($utilities)) {
            return response()->json([
                'status' => 404,
                'message' => 'Set Utilities !'
            ]);
        } else {
            $params = [
                'emails'=> json_decode($utilities['emails']),
                'phones' => json_decode($utilities['phones']),
                'logo'=> $utilities['logo'],
                'banner1'=> $utilities['banner1'],
                'banner2'=> $utilities['banner2'],
                'banner3'=> $utilities['banner3']
            ];

            return response()->json([
                           'status' => 200,
                           'data' => $params
            ]);
        }


    }
}
