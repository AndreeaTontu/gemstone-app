<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    function index(){
        //In a many-to-many relationship, we may want to display each grade and its associated gemstones.
        //load gemstones associated with each grade
        $grades = Grade::with('gemstones')->get();
        return view('grades.index', ['grades' => $grades]);
    }
}
