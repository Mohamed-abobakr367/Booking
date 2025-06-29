<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
  
    public function index()
    {
        $business = Business::where('user_id',Auth::id())->first();
        $service= Service::where('business_id',$business->id)->paginate(10);
        return response()->json($service);
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|between:2,100',
            'price'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->tojson(),400);
        }
        $business= Business::where('user_id',Auth::id())->first();
        $service = new Service();
            $service->name = $request->name;
            $service->description = $request->desciption;
            $service->price = $request->price;
            $service->business_id =$business->id;
            $service->save();
        return response()->json('Service is added');
    }

    public function update($id,Request $request)
    {
        $service=Service::findOrFail($id);
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|between:2,100',
            'price'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->tojson(),400);
        }
        $service->name = $request->name;
        $service->description = $request->desciption;
        $service->price = $request->price;
        $service->save();
        return response()->json('Servic is added');
    }

    public function destroy($id) 
    {
    $service=Service::findOrFails($id);
    $service->delete();
    return response()->json('Servic is deleted');
    }
}
