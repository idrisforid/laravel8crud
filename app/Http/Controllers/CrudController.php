<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crud;
use Session;

class CrudController extends Controller
{
    public function showData(){
       // $showData = Crud::all();
       //$showData = Crud::paginate(5);
       $showData = Crud::simplePaginate(5);
        return view('show_data',compact('showData'));
    }

    public function addData(){
        return view('add_data');
    }

    public function storeData(Request $request){
        $rules=[
            'name'=> 'required|max:10',
            'email'=> 'required|email',
        ];
        $cm=[
            'name.required'=>'Enter Your name',
            'name.max'     => 'Name must be contain 10 characters',
            'email.required'=>'Enter Your email',
            'email.email'=>'Enter a valid email',
        ];
        $this->validate($request,$rules,$cm);

        $crud = new Crud();
        $crud->name = $request->name;
        $crud->email= $request->email;
        $crud->save();
        Session::flash('msg','Data successfully Added');
        return redirect('/');
    }

    public function editData($id=null){
        $editData = Crud::find($id);
        return view('edit_data',compact('editData'));
    }

    public function updateData(Request $request,$id){
        $rules=[
            'name'=> 'required|max:10',
            'email'=> 'required|email',
        ];
        $cm=[
            'name.required'=>'Enter Your name',
            'name.max'     => 'Name must be contain 10 characters',
            'email.required'=>'Enter Your email',
            'email.email'=>'Enter a valid email',
        ];
        $this->validate($request,$rules,$cm);

        $crud = Crud::find($id);
        $crud->name = $request->name;
        $crud->email= $request->email;
        $crud->save();
        Session::flash('msg','Data successfully Updated');
        return redirect('/');
    }

}
