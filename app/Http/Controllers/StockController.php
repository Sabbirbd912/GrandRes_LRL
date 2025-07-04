<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\RawMaterial;
use App\Models\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();
        return view("pages.stock.index", compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }

// public function balance()
// {
//     $result = DB::table('stocks')
//         ->join('transaction_types', 'transaction_types.id', '=', 'stocks.transaction_type_id')
//         ->join('raw_materials', 'raw_materials.id', '=', 'stocks.raw_material_id')
//         ->select(
//             'raw_materials.id',
//             'raw_materials.name as raw_material',
//             DB::raw('SUM(stocks.qty) as total')
//         )
//         ->groupBy('stocks.raw_material_id', 'raw_materials.id', 'raw_materials.name')
//         ->get();

//     return view("pages.stock.balance", ["balances" => $result]);
// }


    public function balance()
	{
		$result = DB::table('stocks') // Laravel adds 'core_' prefix
			->join('transaction_types', 'transaction_types.id', '=', 'stocks.transaction_type_id')
			->join('raw_materials', 'raw_materials.id', '=', 'stocks.raw_material_id')
			->select('raw_materials.id', 'raw_materials.name as raw_material', DB::raw('SUM(core_stocks.qty) as total'))
			->groupBy('stocks.raw_material_id', 'raw_materials.id', 'raw_materials.name')
			->get();


		return view("pages.stock.balance",["balances"=>$result]);
	}





}
