<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\MechanicUpsertRequest;
use App\Models\Mechanic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function store(MechanicUpsertRequest $request): RedirectResponse
    {
        Mechanic::query()->create([
            'firstname' => $request->validated('firstname'),
            'lastname' => $request->validated('lastname'),
        ]);

        return redirect()
            ->route('mechanic_index')
            ->with('success_message', trans('messages.mechanic.created'));
    }

    public function show(Mechanic $mechanic)
    {
        //
    }

    public function edit(Mechanic $mechanic): View
    {
        return view('mechanic.edit', ['mechanic' => $mechanic]);
    }

    public function update(MechanicUpsertRequest $request, Mechanic $mechanic): RedirectResponse
    {
        $mechanic->update([
            'firstname' => $request->validated('firstname'),
            'lastname' => $request->validated('lastname'),
        ]);

        return redirect()
            ->route('mechanic_index')
            ->with('success_message', trans('messages.mechanic.updated'));
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
