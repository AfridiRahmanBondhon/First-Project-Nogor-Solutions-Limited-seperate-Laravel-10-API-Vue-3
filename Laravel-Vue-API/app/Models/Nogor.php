<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nogor extends Model
{
    use HasFactory;
    private  static $form;
    public  static function saveInfo($request ,$id=null){

        if ($id!=null){
            self::$form = Nogor::find($id);
        }else{
            self::$form = new  Nogor();
        }
        self::$form->name = $request->name;
        self::$form->email = $request->email;
        if ($request->file('image')){
            if (self::$form->image){
                if (file_exists(self::$form->image)){
                    unlink(self::$form->image);
                }
            }
            self::$form->image = self::saveImage($request);
        }
        /*if ($request->flexRadioDefault1){
            self::$form->gender = "Male";
        }
        else{
            self::$form->gender = "Female";
        }*/
        self::$form->gender = implode('',$request->gender);

        /*$x = $request->skills;
        $x2 = implode(',',$x);*/
        self::$form->skills = implode(',',$request->skills);

        self::$form->save();
    }

    public static $image,$imageNewName,$dir,$imgUrl,$slug;
    private static function saveImage($request){
        self::$image = $request->file('image');
        self::$imageNewName = rand().'.'.self::$image->extension();
        self::$dir = 'assets/image/';
        self::$imgUrl = self::$dir.self::$imageNewName;
        self::$image->move(self::$dir,self::$imageNewName);
        return self::$imgUrl;
    }

    public static function deleteInfo($id){
        self::$form=Nogor::find($id);
        self::$form->delete();
    }
}
