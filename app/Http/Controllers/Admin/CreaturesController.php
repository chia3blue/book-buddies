<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Creature;

class CreaturesController extends Controller
{
    private $creature;

    public function __construct(Creature $creature){
        $this->creature = $creature;
    }

    public function index(){
        $all_creatures = $this->creature->latest()->paginate(5);

        return view('admin.creatures.index')->with('all_creatures', $all_creatures);
    }

    public function create(){
        return view('admin.creatures.create');
    }

    public function store(Request $request){
        #1. Validate all form data
        $request->validate([
            'name' => 'required|min:1|max:255',
            'image_stage_1' => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'image_stage_2' => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'image_stage_3' => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'image_stage_4' => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'image_stage_5' => 'required|mimes:jpeg,jpg,png,gif|max:1048',
            'image_stage_6' => 'required|mimes:jpeg,jpg,png,gif|max:1048',
        ]);

        #2. Save the data
        $this->creature->name = $request->name;

        // $this->creature->image_stage_1 = 'data:image/' . $request->image_stage_1->extension() . ';base64,' . base64_encode(file_get_contents($request->image_stage_1));

        for($i = 1; $i <= 6; $i ++){
            $inputName = "image_stage_$i";

            if ($request->hasFile($inputName)) {
                $imageData = base64_encode(file_get_contents($request->file($inputName)));
                $mime = $request->file($inputName)->extension();

                $this->creature->{"image_stage_$i"} = "data:image/$mime;base64,$imageData";
            }
        }

        $this->creature->save();

        // [later] リダイレクト先 showへ変更
        return redirect()->route('admin.creatures');
    }

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id)
    {
        $creature = $this->creature->findOrFail($id);
        $creature->delete();

        return redirect()->route('admin.creatures');
    }
}
