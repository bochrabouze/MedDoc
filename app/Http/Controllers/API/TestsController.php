<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test;


class TestsController extends Controller
{
    public function index()
    {
        $tests = Test::all()->toArray();
        return array_reverse($tests);
    }

    public function add(Request $request)
    {
      
       

        $input =  $request->validate([
           
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           
        ]);
        $imageName = NULL;
        if ($image = $request->file('file')) {
            $destinationPath = 'img/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $imageName;
        }

       Test::create($input);

        return response()->json(['success'=> 'Test created successfully']);
    }

    public function delete($id)
    {
        $test = Test::find($id);
        $test->delete();
        unlink('img/'.$test->image);
        return response()->json(['success'=> 'test deleted successfully']);

    }
}
