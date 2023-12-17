<?php

namespace App\Http\Controllers;


use \Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Electric;
use App\Models\Merek;

class ElectricController extends Controller
{
    function index(){
        return view('electric');
    }

    
    public function getData()
    {
        $electrics = Electric::with('merek', 'category')->get();

        return DataTables::of($electrics)
            ->addColumn('merek_nama', function(Electric $electric) {
                return $electric->merek ? $electric->merek->nama_merek : '';
            })
            ->addColumn('category_nama', function(Electric $electric) {
                return $electric->category ? $electric->category->nama_kategori : '';
            })
            ->addColumn('action', 'electric.action')
            ->make(true);
    }
}
