<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Restaurant;
use App\Type;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $restaurant = $user['restaurant'];

        return view('admin.restaurants.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:user,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|max:1000',
            'types' => 'required'
        ]);

        $data = $request->all();
        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);

        $newRestaurant['user_id'] = Auth::id();

        $newRestaurant->slug = $this->getSlug($data['name']);

        if(isset($data['image'])) {
            $newRestaurant['image'] = Storage::put('uploads', $data['image']);
        }

        $newRestaurant->save();


        $newRestaurant->types()->sync($data['types']);

        return redirect()->route('admin.restaurants.show', $newRestaurant['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        if ($restaurant['user_id'] !== Auth::id()) {
            abort(403);
        }

        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        if ($restaurant['user_id'] !== Auth::id()) {
            abort(403);
        }

        $types = Type::all();

        $restaurantTypes = $restaurant->types->map(function ($item) {
            return $item->id;
        })->toArray();

        return view('admin.restaurants.edit', compact('restaurant', 'types', 'restaurantTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'user_id' => 'nullable|exists:user,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|max:1000',
            'types' => 'required'
        ]);
        
        $data = $request->all();
        
        if( $restaurant->name != $data['name'] ) {
            $restaurant->slug = $this->getSlug($data['name']);
        }

        $restaurant->fill($data);

        if(isset($data['image'])) {
            if ($restaurant['image']) {
                Storage::delete($restaurant['image']);
            }

            $restaurant['image'] = Storage::put('uploads', $data['image']);
        }

        $restaurant->save();

        $types = isset($data['types']) ? $data['types'] : [];

        $restaurant->types()->sync($types);
        
        return redirect()->route('admin.restaurants.show', $restaurant->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant['user_id'] !== Auth::id()) {
            abort(403);
        }

        if ($restaurant['image']) {
            Storage::delete($restaurant['image']);
        }

        $restaurant->delete();

        return redirect()->route('admin.restaurants.index');
    }

    private function getSlug($name)
    {
        $slug = Str::of($name)->slug('-');
        $count = 1;

        while( Restaurant::where('slug', $slug)->first() ) {
            $slug = Str::of($name)->slug('-') . "-{$count}";
            $count++;
        }

        return $slug;
    }
}
