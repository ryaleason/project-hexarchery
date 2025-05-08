<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return view('schedule.index', compact('schedules'));
    }

    public function indexadmin()
    {
        $schedules = Schedule::all();
        return view('admin.index', compact('schedules'));
    }


    public function create()
    {
        return view('schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'day' => 'required|string',
            'week' => 'required|string',
        ]);

        Schedule::create([
            'name' => $request->name,
            'day' => $request->day,
            'week' => $request->week,
        ]);

        return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'day' => 'required|string',
            'week' => 'required|string',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'name' => $request->name,
            'day' => $request->day,
            'week' => $request->week,
        ]);

        return redirect()->route('schedule.index')->with('success', 'Jadwal berhasil diupdate!');
    }
}
