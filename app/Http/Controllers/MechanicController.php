<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    public function index(): View
    {
        $mechanics = Mechanic::all();
        return view('mechanic.index', ['mechanics' => $mechanics]);
    }

    public function create(): View
    {
        return view('mechanic.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $mechanic = new Mechanic();
        $mechanic->name = $request->mechanic_name;
        $mechanic->surname = $request->mechanic_surname;
        $mechanic->save();

        return redirect()
            ->route('mechanic_index')
            ->with('success_message', 'Sėkmingai įrašytas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function show(Mechanic $mechanic)
    {
        //
    }

    public function edit(Mechanic $mechanic): View
    {
        return view('mechanic.edit', ['mechanic' => $mechanic]);
    }

    public function update(Request $request, Mechanic $mechanic): RedirectResponse
    {
        $mechanic->name = $request->mechanic_name;
        $mechanic->surname = $request->mechanic_surname;
        $mechanic->save();

        return redirect()
            ->route('mechanic_index')
            ->with('success_message', 'Sėkmingai pakeistas');
    }

    public function destroy(Mechanic $mechanic): RedirectResponse
    {
        if ($mechanic->mechanicTrucks->count()) {
            return redirect()->route('mechanic_index')
                ->with('info_message', 'Trinti negalima, nes turi automobilių.');
        }

        $mechanic->delete();

        return redirect()
            ->route('mechanic_index')
            ->with('success_message', 'Sėkmingai ištrinta');
    }
}
