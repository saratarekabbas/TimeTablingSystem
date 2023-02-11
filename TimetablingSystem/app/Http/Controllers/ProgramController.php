<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $data = Program::get();
        //compact is to pass $data basically
        return view('/office-assistant/program/program-list', compact('data'));
    }

    public function addProgram()
    {
        return view('/office-assistant/program/add-program');
    }

    public function saveProgram(Request $request)
    {
//        Validation
        $request->validate([
            'program_name' => 'required|unique:programs,program_name',
            'program_code' => 'required|string|min:9|max:9|unique:programs,program_code',
        ]);

        $program_name = $request->program_name;
        $program_code = $request->program_code;

//        Create a model in our Eloquent Model Program
        $programdata = new Program();
        $programdata->program_name = $program_name;
        $programdata->program_code = $program_code;
        $programdata->save();

        return redirect()->back()->with('success', 'Successful: Program has been created successfully');
    }

    public function editProgram($id)
    {
        $data = Program::where('id', '=', $id)->first();
        return view('/office-assistant/program/edit-program', compact('data'));
    }

    public function updateProgram(Request $request)
    {
        //        Validation
        $request->validate([
            'program_name' => 'required|unique:programs,program_name',
            'program_code' => 'required|string|min:9|max:9|unique:programs,program_code',
        ]);

        $id = $request->id;
        $program_name = $request->program_name;
        $program_code = $request->program_code;

//        Create the update query by calling our Program Eloquent Model
        Program::where('id', '=', $id)->update([
            'program_name' => $program_name,
            'program_code' => $program_code,
        ]);

        return redirect()->back()->with('success', 'Successful: Program has been updated successfully');
    }

    public function deleteProgram($id)
    {
        Program::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Successful: Program has been deleted successfully');
    }
}
