<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();

        return response()->json(['cars'=>$cars]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'color'           => 'required',
            'model_name'      => 'required',
            'year_production' => 'required',
        ]);

        $car = Car::create([
            'color'           => $request->color,
            'model_name'      => $request->model_name,
            'year_production' => $request->year_production,
        ]);

        return response()->json(['message'=> Session::flash('success', 'Car Created Successfully') ,'car'=>$car]);
    }

    public function update($id, Request $request)
    {   
        $this->validate($request, [
            'color'           => 'required',
            'model_name'      => 'required',
            'year_production' => 'required',
        ]);

        $car = Car::find($id);

        $car->update($request->all());
        
        return response()->json(['message'=> Session::flash('success', 'Car Updated Successfully'),'car'=>$car]);
        
    }

    public function destroy($id)
    {
        $car = Car::find($id)->delete();

        return response()->json(['message'=> Session::flash('success', 'Car Deleted Successfully') ]);
    }
}
