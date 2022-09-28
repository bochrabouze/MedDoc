<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perspection;

class PerspectionController extends Controller
{
    public function index()
    {
        $perspections = Perspection::all()->toArray();
        return array_reverse($perspections);
    }

    
    public function add(Request $request)
    {

        $perspection =new Perspection([
            'user_id' => 1,
            'patient_id' => 1,
            'medication' => $request->input('medication'),
            'startingdate' => $request->input('startingdate'),
            'duration' => $request->input('duration'),
            
           
            
            
        ]);
        $perspection->save();
   
        return response()->json('perspection created!');


    }

    
    public function edit($id)
    {
        $perspection = Perspection::find($id);
        return response()->json($perspection);
    }

    
    public function update($id, Request $request)
    {
        $perspection = Perspection::find($id);
        $request->validate([
            'medication',
            'startingdate',
            'duration',
        ]);

        $input = $request->all();
        
        $perspection->update($input);

        return response()->json(['success'=> 'perspection update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\perspection  $perspection
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $perspection = Perspection::find($id);
        $perspection->delete();
        return response()->json(['success'=> 'perspection deleted successfully']);

    }
}
