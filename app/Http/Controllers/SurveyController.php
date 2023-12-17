<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merek;
use App\Models\Category;
use App\Models\SurveyAnswer;
use App\Models\Electric;


class SurveyController extends Controller
{
    function index()
    {
        // Menampilkan survei milik pengguna tersebut beserta pertanyaan dan jawabannya
        $authUserId = Auth::id();

        // Melakukan query untuk mendapatkan survei, pertanyaan, dan jawaban berdasarkan ID pengguna yang diautentikasi
        $surveys = SurveyAnswer::with(['user', 'electric.category', 'electric.merek'])
            ->where('user_id', $authUserId)
            ->get();


        $category = Category::All();
        $merek = Merek::All();

        return view('survey', compact('surveys', 'category', 'merek'));
    }

    function storeSurvey(Request $request)
    {
        $request->validate([
            'pemakaian' => 'required|string',
            'SKU' => 'required',
            'kategori' => 'required',
            'merek' => 'required',
        ]);

        $electric = Electric::where('id_kategori', $request->SKU)->where('id_kategori', $request->kategori)->where('id_merek', $request->merek)->first();

        if ($electric) {
            $request->merge(['electric_id' => $electric->id]);
            $request->merge(['user_id' => Auth::id()]);

            $surveyAnswer = SurveyAnswer::create($request->all());

            return response()->json(['message' => 'Survey answer created successfully', 'data' => $surveyAnswer], 201);
        } else {
            echo "tidak";
        }
    }
}
