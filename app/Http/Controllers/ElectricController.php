<?php

namespace App\Http\Controllers;


use \Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Electric;
use App\Models\Merek;

class ElectricController extends Controller
{
    function index()
    {
        return view('electric');
    }


    public function getData()
    {
        $electrics = Electric::with('merek', 'category')->get();

        return DataTables::of($electrics)
            ->addColumn('merek_nama', function (Electric $electric) {
                return $electric->merek ? $electric->merek->nama_merek : '';
            })
            ->addColumn('category_nama', function (Electric $electric) {
                return $electric->category ? $electric->category->nama_kategori : '';
            })
            ->addColumn('action', 'electric.action')
            ->make(true);
    }


    public function getDataElectric(Request $request)
    {
        try {
            $kategori = $request->input('kategori');
            $merek = $request->input('merek');
            $pemakaian = $request->input('pemakaian');
            $sku = $request->input('sku');

            // Start with a base query
            $query = Electric::with('merek', 'category');

            // Apply filters based on request parameters
            if ($kategori) {
                $query->whereHas('category', function ($query) use ($kategori) {
                    $query->where('id', $kategori);
                });
            }

            if ($merek) {
                $query->whereHas('merek', function ($query) use ($merek) {
                    $query->where('id', $merek);
                });
            }

            // Fetch data with applied filters
            $electrics = $query->get();

            // Return the data as JSON
            return response()->json(['status' => 'success', 'data' => $electrics]);
        } catch (\Exception $e) {
            // Handle any errors that may occur
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
