<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Http\Requests\TruckUpsertRequest;

class TruckController extends Controller
{
    public function index(Request $request): View
    {
        // $trucks = Truck::all();
        $truckMakers = Truck::all()->unique('maker');
        $mechanics = Mechanic::all();

        // if ($request->mechanic && $request->mechanic != "default" && $request->truck_maker && $request->truck_maker != "default") {
        //     $trucks = Truck::where('mechanic_id', $request->mechanic)
        //         ->where('maker', $request->truck_maker)
        //         ->get();
        // } elseif ($request->mechanic && $request->mechanic != "default") {
        //     $trucks = Truck::where('mechanic_id', $request->mechanic)
        //         ->get();
        // } elseif ($request->truck_maker && $request->truck_maker != "default") {
        //     $trucks = Truck::where('maker', $request->truck_maker)->get();
        // }

        $trucks = QueryBuilder::for(Truck::class)
            ->allowedFilters([
                AllowedFilter::exact('truckMechanic.id'),
                AllowedFilter::exact('maker'),
            ])
            ->get();

        return view('truck.index', [
            'trucks' => $trucks,
            'mechanics' => $mechanics,
            'mechanic_id' => $request->mechanic ?? 0,
            'truck_maker' => $request->truck_maker ?? '',
            'truckMakers' => $truckMakers
        ]);
    }

    public function create(): View
    {
        $mechanics = Mechanic::all();

        return view('truck.create', [
            'mechanics' => $mechanics,
        ]);
    }

    public function store(TruckUpsertRequest $request): RedirectResponse
    {
        Truck::create([
            'maker' => $request->truck_maker,
            'plate' => $request->truck_plate,
            'make_year' => $request->truck_make_year,
            'mechanic_notices' => $request->mechanic_notices,
            'mechanic_id' => $request->mechanic_id,
        ]);


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

    public function edit(Truck $truck): View
    {
        $mechanics = Mechanic::all();

        return view('truck.edit', [
            'truck' => $truck,
            'mechanics' => $mechanics,
            'image' => $truck->getFirstMediaUrl('image'),
        ]);
    }

    public function update(TruckUpsertRequest $request, Truck $truck): RedirectResponse
    {
        $truck->update([
            'maker' => $request->truck_maker,
            'plate' => $request->truck_plate,
            'make_year' => $request->truck_make_year,
            'mechanic_notices' => $request->mechanic_notices,
            'mechanic_id' => $request->mechanic_id
        ]);

        if ($request->file('image')) {
            $truck->addMedia($request->file('image'))
                ->toMediaCollection('image');
        }

        return redirect()
            ->route('truck_index')
            ->with('success_message', 'Sėkmingai pakeista');
    }

    public function destroy(Truck $truck): RedirectResponse
    {
        $truck->delete();

        return redirect()
            ->route('truck_index')
            ->with('success_message', 'Sėkmingai ištrinta');
    }
}
