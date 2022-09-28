<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visits;

class VisitsController extends Controller
{
    public function index()
    {
        $visits = Visits::all()->toArray();
        return array_reverse($visits);
    }

    
    public function add(Request $request)
    {

        $visit =new Visits([
            'user_id' => 1,
            'patient_id' => 1,
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'diagnostic' => $request->input('diagnostic'),
            'synthesis' => $request->input('synthesis'),
            'tests' => $request->input('tests'),
            
           
            
            
        ]);
        $visit->save();
   
        return response()->json('visit created!');


    }

    
    public function edit($id)
    {
        $visit = Visits::find($id);
        return response()->json($visit);
    }

    
    public function update($id, Request $request)
    {
        $visit = Visits::find($id);
        $request->validate([
        'date',
        'time',
        'diagnostic',
        'synthesis',
        'tests'
        ]);

        $input = $request->all();
        
        $visit->update($input);

        return response()->json(['success'=> 'visit update successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visits  $visits
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $visit = Visits::find($id);
        $visit->delete();
        return response()->json(['success'=> 'visit deleted successfully']);

    }
}
