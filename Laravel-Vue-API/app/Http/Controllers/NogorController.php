<?php

namespace App\Http\Controllers;

use App\Models\Nogor;
use Illuminate\Http\Request;

class NogorController extends Controller
{
    public function index(){
        return view('view',[
            'forms'=>Nogor::all()
        ]);
    }
    public function add(){
        return view('form');
    }
    public function store(Request $request){
        $request->validate([
            'name'        => 'required | string | max:200 | min:3',
            'email'         => 'required | string',
            'image'        => 'required | image | mimes:jpg,png',
            'gender'        => 'required',
            'skills'        => 'required',
        ],
            [
                'name.required' => 'Please Sir, Give A Name!',
                'name.string' => 'Input must be string',
                'name.min' => 'Name must be more than 3 Character',
                'name.max' => 'Name must be less than 200 Character',
                'email.required' => 'Email is a must',
                'image.string' => 'Image is required',
                'gender.required'=> 'Select a Gender',
                'skills.required'=>'Please Sir, Select Skills',
            ]);
        Nogor::saveInfo($request);
        return redirect(route('home'));
    }
    public function edit($id){
        return view('edit',[
            'form'=>Nogor::find($id)
        ]);
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'        => 'required | string | max:200 | min:3',
            'email'         => 'required | string',
            'image'        => 'nullable | image | mimes:jpg,png',
            'gender'        => 'required',
            'skills'        => 'required',
        ],
            [
                'name.required' => 'Please Sir, Give A Name!',
                'name.string' => 'Input must be string',
                'name.min' => 'Name must be more than 3 Character',
                'name.max' => 'Name must be less than 200 Character',
                'email.nullable' => 'Email is a default',
                'image.string' => 'Image is required',
                'gender.required'=> 'Select a Gender',
                'skills.required'=>'Please Sir, Select Skills',
            ]);
        Nogor::saveInfo($request,$id);
        return redirect(route('home'));
    }
    public function destroy($id){
        Nogor::deleteInfo($id);
        return redirect(route('home'));
    }
}
