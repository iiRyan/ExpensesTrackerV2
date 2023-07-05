<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Resources\ExpensesResource;
use App\Models\Expense;
use App\Models\Month;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{

    public function index()
    {
        $query = Expense::all();

        return ExpensesResource::collection($query);
    }
    /**
     * Display a listing of the resource.
     */
    public function getExpensesByMonth($monthId)
    {
        return ExpensesResource::collection(
            Expense::where('month_id', $monthId)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $request->validated($request->all());

        $expense = Expense::create([
            'description' => $request->description,
            'month_id' => $request->month_id,
            'amount' => $request->amount,
            'bank_account' => $request->bank_account,
            'status' => $request->status,


        ]);

        return new ExpensesResource($expense);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
