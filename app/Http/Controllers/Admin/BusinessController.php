<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index()
    {
        $business =Business::paginate(10);
        return response()->json($business);
    }

    public function store(REQUEST $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'user_id'=>'required',
            'status'=>'required',
            'opening_hours'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson());
        }
        Business::create(array_merge($validator->validated()));
        return response()->json('business is added');

    }
    
    public function update(Request $request,$id)
    {
        $business=Business::findOrFails($id);
        $validator=validator::make($request->all(),[
            'name'=>'required',
            'user_id'=>'required',
            'status'=>'required',
            'opening_hours'=>'required'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors()->toJson());
        }
        $business->update(array_merge($validator->validated()));
        return response()->json('business is updated');
    }

    public function destroy($id)
    {
        $business=Business::findOrFail($id);
        $business->delete();
        return response()->json('business is deleted');
    }
}
