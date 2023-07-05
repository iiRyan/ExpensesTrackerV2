<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMonthRequest;
use App\Http\Resources\MonthsResource;
use App\Models\Month;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonthsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MonthsResource::collection(
            Month::where('user_id', Auth::user()->id)->get()
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMonthRequest $request)
    {
        $request->validated($request->all());

        $month = Month::create([
            'user_id' => Auth::user()->id,
            'month' => $request->month,
            'income' => $request->income
        ]);

        return new MonthsResource($month);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $id)
    {
        $month = Month::where('id', $id)->get();

        return $month;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
}
