<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Dish;
use App\Restaurant;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $dishes = Dish::whereHas('restaurant', function($q) use($user_id) {
            $q->where('user_id', $user_id);
        })->get();

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'restaurant_id' => 'nullable|exists:restaurant,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:65535',
            'price' => 'required|numeric',
            'visible' => 'sometimes|accepted',
            'image' => 'nullable|image|max:1000'
        ]);

        $data = $request->all();
        $user = Auth::user();
        $restaurant = $user['restaurant'];
        $data['restaurant_id'] = $restaurant->id;
        
        $newDish = new Dish();
        $newDish->fill($data);
        
        $newDish->restaurant_id = $data['restaurant_id'];

        $newDish->slug = $this->getSlug($data['name']);

        $newDish->visible = isset($data['visible']);

        if(isset($data['image'])) {
            $newDish['image'] = Storage::put('uploads', $data['image']);
        }

        $newDish->save();

        return redirect()->route('admin.dishes.show', $newDish['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        if ($dish['restaurant_id'] !== Auth::id()) {
            abort(403);
        }

        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        if ($dish['restaurant_id'] !== Auth::id()) {
            abort(403);
        }

        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'restaurant_id' => 'nullable|exists:restaurant,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:65535',
            'price' => 'required|numeric',
            'visible' => 'sometimes|accepted',
            'image' => 'nullable|image|max:1000'
        ]);

        $data = $request->all();

        if( $dish->name != $data['name'] ) {
            $dish->slug = $this->getSlug($data['name']);
        }
        
        $dish->fill($data);

        if(isset($data['image'])) {
            if ($dish['image']) {
                Storage::delete($dish['image']);
            }

            $dish['image'] = Storage::put('uploads', $data['image']);
        }

        $dish->visible = isset($data['visible']);
    
        $dish->save();

        return redirect()->route('admin.dishes.show', $dish->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        if ($dish['restaurant_id'] !== Auth::id()) {
            abort(403);
        }

        if ($dish['image']) {
            Storage::delete($dish['image']);
        }

        $dish->delete();

        return redirect()->route('admin.dishes.index');
    }

    private function getSlug($name)
    {
        $slug = Str::of($name)->slug('-');
        $count = 1;

        while( Dish::where('slug', $slug)->first() ) {
            $slug = Str::of($name)->slug('-') . "-{$count}";
            $count++;
        }

        return $slug;
    }
}
