<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function edit()
    {
        $statistic = Statistic::firstOrCreate([]);
        return view('admin.statistics.edit', compact('statistic'));
    }

    public function update(Request $request)
    {
        $statistic = Statistic::firstOrCreate([]);

        $validated = $request->validate([
            'users_count' => 'required|integer|min:0',
            'users_suffix' => 'nullable|string|max:10',
            'reviews_count' => 'required|integer|min:0',
            'reviews_suffix' => 'nullable|string|max:10',
            'countries_count' => 'required|integer|min:0',
            'countries_suffix' => 'nullable|string|max:10',
            'subscribers_count' => 'required|integer|min:0',
            'subscribers_suffix' => 'nullable|string|max:10',
        ]);

        $statistic->update($validated);

        \Illuminate\Support\Facades\Cache::forget('statistics');

        return redirect()->route('admin.statistics.edit')->with('success', 'Statistiques mises à jour avec succès.');
    }
}
