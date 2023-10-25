<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function index(){
        $f=Form::all();
        if ($f->count()>0){
            $data=[
                'status'=>200,
                'forms'=>$f
            ];
            return response()->json($data,200);
        }else{
            $data=[
                'status'=>404,
                'forms'=>'No Records found'
            ];
            return response()->json($data,404);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:191|min:3',
            'email'=>'required|email|max:191',
            'image'=>'required',
            'gender'=>'required',
            'skills'=>'required'
        ]);
        if ($validator->fails()){
            $data=[
                'status'=>202,
                'error'=>$validator->messages(),
            ];
            return response()->json($data,202);
        }else{

            $f=Form::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'image'=> Storage::disk('local')->put('images', $request->image),
                'gender'=>$request->gender,
                'skills'=> $request->skills,
            ]);
            if ($f){
                return response()->json([
                    'status'=>200,
                    'message'=>"Data Created Successfully"
                ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"Something went wrong"
                ],500);
            }
        }
    }
    public function show($id){
        $f = Form::find($id);
        if ($f){
            return response()->json([
                'status'=>200,
                'forms'=>$f
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"No Such Data Found"
            ],500);
        }
    }
    public function edit($id){
        $f = Form::find($id);
        if ($f){
            return response()->json([
                'status'=>200,
                'forms'=>$f
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"No Such Data Found"
            ],500);
        }
    }
    public function update(Request $request, int $id){
    /*return [Storage::disk('local')->put('images', $request->image), $request->image];*/
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:191',
            'email'=>'required|email|max:191',
            'image'=>'nullable',
            'gender'=>'nullable',
            'skills'=>'nullable'
        ]);
        if ($validator->fails()){
            $data=[
                'status'=>202,
                'error'=>$validator->messages(),
            ];
            return response()->json($data,202);
        }else{
            $f = Form::find($id);
            if ($f){
                /*return [json_encode(Storage::exists($f->getRawOriginal('image'))), $f->getRawOriginal('image')];*/
                if($request->hasFile('image')){
                    if(Storage::exists($f->getRawOriginal('image'))){
                        Storage::delete($f->getRawOriginal('image'));
                    }
                    $image = Storage::disk('local')->put('images', $request->image);
                }else{
                    $image = $f->getRawOriginal('image');
                }

                $f->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'image'=>  $image,//Storage::disk('local')->put('images', $request->image),
                    'gender'=>$request->gender,
                    'skills'=>$request->skills,
                ]);
                return response()->json([
                    'status'=>200,
                    'message'=>"Form Updated Successfully"
                ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"No Such Data Found!"
                ],500);
            }
        }
    }
    public function destroy($id){
        $f = Form::find($id);
        if ($f){
            if(Storage::exists($f->getRawOriginal('image'))){
                Storage::delete($f->getRawOriginal('image'));
            }
            $f->forceDelete();
            return response()->json([
                'status'=>200,
                'message'=>"Data Deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"No Such Data Found!"
            ],500);
        }
    }
    public function softDestroy($id){
        $f = Form::find($id);
        if ($f){
            $f->delete();
            //$f->trashed();
            return response()->json([
                'status'=>200,
                'message'=>"Data Deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"No Such Data Found!"
            ],500);
        }
    }
}
