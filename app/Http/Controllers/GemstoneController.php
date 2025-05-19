<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\Gemstone;
use Illuminate\Support\Facades\Validator;


class GemstoneController extends Controller
{   
    function index()
    {
        $gemstones = Gemstone::all(); //Items per pagination
        return view('gemstones.index',['gemstones' => $gemstones]);
    }

    function create()
    {   
        $grades = Grade::all();
        return view('gemstones.create',  ['grades' => $grades]);
    }

    function about()
    {
        return view('gemstones.about');
    }

    private function validateGemstone($request)
    {
        // Validating the request data using validation rules.
        $rules=[
            'name' => 'required|string|max:100|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'location' => 'required|string|max:100|regex:/^([a-zA-Z,]+)(\s[a-zA-Z,]+)*$/',
            'colour'  => 'required|string|max:100|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'association' => 'required|string|max:100|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'meaning' => 'required|string|max:100|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'grade_id'=>'required|aray',
        ];
        //Error messages to be printed to the user.
        $messages = [
            'name.required' => 'The name is required.',
            'location.required' => 'Please enter a location.',
            'colour.required' => 'A colour is required.',
            'association.required' => 'Please enter an association.',
            'meaning.required' => 'A meaning is required.',
            'grade_id.required'=> 'Please select one or more grades',
        ];
        //This perform validation automatically
        return Validator::make($request->all(), $rules, $messages);
    }
    function store(Request $request) 
    {   
        //Validator instance 
        $validator = $this->validateGemstone(($request));
        
        //Creating the Gemstone
        $gemstone = Gemstone::create([
            'name'=>$request->name,
            'location'=>$request->location,
            'colour'=>$request->colour,
            'association'=>$request->association,
            'meaning'=>$request->meaning,
        ]);

        //Attach grades pivot table
        $gemstone->grades()->attach($request->grade_id);

        return redirect('/gemstones'); 
    }
    
    function show($id) 
    {
        $gemstone = Gemstone::find($id);
    
        return view('gemstones.show', ['gemstone' => $gemstone]);
    }

    function edit($id)
    {
        $gemstone = Gemstone::findOrFail($id);
        $grades = Grade::all();
        return view('gemstones.edit', ['gemstone' => $gemstone, 'grades'=>$grades]);
    }

    function update(Request $request, $id)
    {
        $validator = $this->validateGemstone(($request));
       
        $gemstone = Gemstone::find($id);
        $gemstone->update([
            'name'=>$request->name,
            'location'=>$request->location,
            'colour'=>$request->colour,
            'association'=>$request->association,
            'meaning'=>$request->meaning,
        ]);
        //Sync grades. 
        $gemstone->grades()->sync($request->grade_id);
        return redirect('/gemstones');
    }

    function destroy(Request $request, $id)
    {   
        $gemstone = Gemstone::find($id);
        $gemstone->delete();
        return redirect('/gemstones');
    }


}
