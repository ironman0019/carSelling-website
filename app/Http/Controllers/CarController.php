<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = User::find(1)->cars()->with(['primaryImage', 'maker', 'model'])->latest()->paginate(15);
        return view('car.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('car.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search()
    {
        $query = Car::where('published_at', '<', now())->with(['primaryImage', 'city', 'maker', 'model', 'carType', 'fuelType'])->orderBy('published_at', 'desc');


        $cars = $query->paginate(15);

        return view('car.search', compact('cars'));
    }

    public function watchlist()
    {
        $cars = User::find(4)->favouriteCars()->with(['primaryImage', 'city', 'maker', 'model', 'carType', 'fuelType'])->paginate(15);
        return view('car.watchlist', compact('cars'));
    }
    
}
