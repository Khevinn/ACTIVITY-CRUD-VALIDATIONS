<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroes = Hero::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('heroes.index', compact('heroes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('heroes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'unique:heroes', 'max:255'],
            'description' => ['required'],
            'photo' => ['mimes:jpeg,png','dimensions:min_width=100,min_height=100'],

        ]);

         $hero = new Hero( $validatedData);

        $hero->user_id = Auth::id();
        $hero->save();

        if($request->hasFile('photo') and $request->file('photo')->isValid()){
            $extension = $request->photo->extension();
           
           
            $photo = now()->toDateTimeString()."_".substr(base64_encode(sha1(mt_rand())),0,10);

            $path = $request->photo->storeAs('heroes', $photo.".".$extension,'public');

    }
        $hero = new Hero($validatedData);

        $hero->user_id = Auth::id();

        $hero->save();

        return redirect('heroes')->with('success', 'Hero has been added with success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function show(Hero $hero)
    {
        return view('heroes.show', compact('hero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function edit(Hero $hero)
    {
        if($hero->user_id === Auth::id()){
            return view('heroes.edit', compact('hero'));
        }else{
            return redirect()->route('heroes.index')
            ->with('error', "You don't have permission to edit this, because are not the author!")
            ->withInput();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hero $hero)
    {

         $validatedData = $request->validate([
            'name' => ['required', Rule::unique('heroes')->ignore($hero), 'max:255'],
            'description' => ['required'],
            'photo' => ['mimes:jpeg,png','dimensions:min_width=100,min_height=100'],

        ]);


          if($hero->user_id === Auth::id()){
                $hero->update($request->all());

          if($request->hasFile('photo') and $request->file('photo')->isValid()){
                $hero->photo->delete();

                $extension = $request->photo->extension();

                $photo = now()->toDateTimeString()."_".substr(base64_encode(sha1(mt_rand())),0,10);

                $path = $request->photo->storeAs('heroes',$photo.".".$extension,'public');

                $photo = new photo();
                $photo->path = $path;
                $photo->hero_id = $hero->id;
                $photo->save(); 
    

            }


            return redirect()->route('heroes.index')->with('success', 'Hero has been updated!');
         }else{
            return redirect()->route('heroes.index')
            ->with('error', "You don't have permission to edit this, because are not the author!")
            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hero  $hero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hero $hero)
    {
        if($hero->user_id === Auth::id()){
            $hero->delete();
        return redirect()->route('heroes.index')->with ('success', 'Hero has been deleted!');

        }else{
            return redirect()->route('heroes.index')
            ->with('error', "You don't have permission to delete this, because are not the author!")
            ->withInput();
        }
    }
}
