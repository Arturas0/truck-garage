<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use App\Http\Requests\TruckUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trucks = Truck::all();
        $truckMakers = Truck::all()->unique('maker');
        $mechanics = Mechanic::all();


        if ($request->mechanic && $request->mechanic != "default" && $request->truck_maker && $request->truck_maker != "default") {
            $trucks = Truck::where('mechanic_id', $request->mechanic)
                ->where('maker', $request->truck_maker)
                ->get();
        } elseif ($request->mechanic && $request->mechanic != "default") {
            $trucks = Truck::where('mechanic_id', $request->mechanic)
                ->get();
        } elseif ($request->truck_maker && $request->truck_maker != "default") {
            $trucks = Truck::where('maker', $request->truck_maker)->get();
        }

        return view('truck.index', [
            'trucks' => $trucks,
            'mechanics' => $mechanics,
            'mechanic_id' => $request->mechanic ?? 0,
            'truck_maker' => $request->truck_maker ?? '',
            'truckMakers' => $truckMakers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mechanics = Mechanic::all();
        return view('truck.create', ['mechanics' => $mechanics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'truck_maker' => ['required', 'max:255'],
                'truck_plate' => ['required', 'alpha_dash', 'max:20'],
                'truck_make_year' => ['required', 'numeric', 'digits:4']
            ],

            ['truck_maker.required' => 'Truck maker is missing']

        );

        $request->flash();

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        $truck = new Truck;
        $truck->maker = $request->truck_maker;
        $truck->plate = $request->truck_plate;
        $truck->make_year = $request->truck_make_year;
        $truck->mechanic_notices = $request->mechanic_notices;
        $truck->mechanic_id = $request->mechanic_id;
        $truck->save();

        return redirect()
            ->route('truck_index')
            ->with('success_message', 'Sėkmingai įrašyta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $mechanics = Mechanic::all();
        return view('truck.edit', [
            'truck' => $truck,
            'mechanics' => $mechanics,
            'image' => $truck->getFirstMediaUrl('image'),
        ]);
    }

    public function update(TruckUpdateRequest $request, Truck $truck): RedirectResponse
    {
        $request->flash();

        $truck->update([
            'maker' => $request->truck_maker,
            'plate' => $request->truck_plate,
            'make_year' => $request->truck_make_year,
            'mechanic_notices' => $request->mechanic_notices,
            'mechanic_id' => $request->mechanic_id
        ]);

        $truck->addMedia($request->file('image'))
            ->toMediaCollection('image');

        return redirect()->route('truck_index')
            ->with('success_message', 'Sėkmingai pakeista');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect()->route('truck_index')
            ->with('success_message', 'Sėkmingai ištrinta');
    }
}
