<?php

namespace App\Http\Controllers;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\Animal;
use App\Models\Adoption;

class AdoptionController extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       
        $user = auth()->user();
        $animalid = $request->input('animal_id');
        $adoption = new Adoption;
        $adoption->userid = $user->id;
        $adoption->animalid = $animalid;
        
        $adoption->created_at = now();
        $adoption->save();
        return back()->with('success', 'Your adoption has been posted');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(){
        $adoptionsQuery = Adoption::all();
        if(Gate::denies('create-animal')) {
            $adoptionsQuery=$adoptionsQuery->where('userid',auth()->user()->id);
        }
        return view('adoptions',array('adoptions'=>$adoptionsQuery));

    }
    /**
     * Update the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function approve($id){

        $adoption = Adoption::find($id);
        #finds the animal with the animal id in the adoption and updaes the userid
        $animalid = $adoption->animalid;
        $animal = Animal::find($animalid);
        $animal->userid = $adoption->userid;
        #changes the approval to TRUE and updates the animal and the adoption request
        $adoption->approved = TRUE;
        $animal->update;
        $adoption->update;
        return redirect('adoptions');

    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deny($id){
        $adoption = Adoption::find($id);
        $adoption->delete();
        return redirect('adoptions');

    }
}
