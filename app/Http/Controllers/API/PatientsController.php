<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Patients;

use Illuminate\Http\Request;


class PatientsController extends Controller
{
    
   
    public function index()
    {  
        $patients = Patients::all()->toArray();
        return array_reverse($patients);
    }
   

    
    public function add(Request $request)
    {
           // new Application
   

       
            // new Application
            $patient =new Patients([
                'user_id' => 1,
                'firstname' => $request->input('firstname'),
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'dateofbirth' => $request->input('dateofbirth'),
                'bloodgroup' => $request->input('bloodgroup'),
                'weigh' => $request->input('weigh'),
                'height' => $request->input('height'),
                'allergy' => $request->input('allergy'),
                'chronicdisease' => $request->input('chronicdisease'),

               
                
                
            ]);
            $patient->save();
       
            return response()->json('patient created!');
          
            
    }
    public function edit($id)
    {
        $patient= Patients::find($id);
        return response()->json($patient);
    }
    public function update($id, Request $request)
    {
        $patient = Patients::find($id);
        $request->validate([
            'firstname',
            'name',
            'address',
            'phone',
            'dateofbirth',
            'bloodgroup',
            'weigh',
            'height',
            'allergy',
            'chronicdisease',
        ]);

        $input = $request->all();
        
        $patient->update($input);

        return response()->json(['success'=> 'patient update successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patients  $patients
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    { 
        $patient = Patients::find($id);
        $patient->delete();
        return response()->json(['success'=> 'patient deleted successfully']);
}
}
