<?php

namespace App\Http\Controllers;


use \Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Electric;
use App\Models\Merek;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ElectricController extends Controller
{
    function index()
    {
        $category = Category::All();
        $merek = Merek::All();
        return view('electric', compact('category', 'merek'));
    }

    public function editWatt(Request $request)
    {
        // Validate the request data if needed
        $request->validate([
            'id' => 'required|numeric', // Add more validation rules as needed
            'watt' => 'required|numeric',
        ]);

        // Find the model by ID
        $electrics = Electric::findOrFail($request->id);

        // Update the 'watt' field
        $electrics->update(['watt' => $request->watt]);

        // You can return a response as needed (e.g., success message)
        return response()->json(['status' => 'success', 'data' => $electrics]);
    }

    public function show($id)
    {
        // Fetch the Electric item by ID
        $electric = Electric::findOrFail($id);

        // Check if it's an AJAX request
        if (request()->ajax()) {
            // Return JSON response for AJAX request
            return response()->json([
                'electric' => $electric,
            ]);
        }

        // Return the view with the Electric data
        return view('electric.show', compact('electric'));
    }


    public function getData()
    {
        $electrics = Electric::with('merek', 'category')->orderBy('id', 'desc')->get();


        return DataTables::of($electrics)
            ->addColumn('merek_nama', function (Electric $electric) {
                return $electric->merek ? $electric->merek->nama_merek : '';
            })
            ->addColumn('category_nama', function (Electric $electric) {
                return $electric->category ? $electric->category->nama_kategori : '';
            })
            ->addColumn('action', function (Electric $electric) {
                return '<button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editModal" data-electric-id="' . $electric->id . '">Edit Watt</button>';
            })
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

    function store(Request $request)
    {
        $request->validate([
            'SKU' => 'required',
            'kategori' => 'required|not_in:Pilih',
            'merek' => 'required|not_in:Pilih',
        ]);


        DB::beginTransaction();

        try {
            // Step 1: Check if data already exists in 'mereks' table
            $merek = DB::table('mereks')->where('id', ucwords($request->merek))->first();

            if (!$merek) {
                // If not exists, insert data
                $merekId = DB::table('mereks')->insertGetId([
                    'nama_merek' => ucwords($request->merek),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // If exists, use existing ID
                $merekId = $merek->id;
            }

            // Step 2: Check if data already exists in 'categories' table
            $kategori = DB::table('categories')->where('id', ucwords($request->kategori))->first();

            if (!$kategori) {
                // If not exists, insert data
                $kategoriId = DB::table('categories')->insertGetId([
                    'nama_kategori' => ucwords($request->kategori),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // If exists, use existing ID
                $kategoriId = $kategori->id;
            }

            // Step 3: Insert data into 'electrics' table
            $electricId = DB::table('electrics')->insert([
                'nama_electric' => ucwords($request->SKU),
                'id_merek' => $merekId,
                'id_kategori' => $kategoriId,
                'watt' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            // If any exception occurs, rollback the transaction
            DB::rollback();

            // You can handle the exception here or log it
            return response()->json(['error' => $e], 500);
        }

        // If everything is successful, you can return a success response
        return response()->json(['success' => true], 200);
    }
}
