<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merek;
use App\Models\Category;
use App\Models\SurveyAnswer;

class DashboardController extends Controller
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

        return view('dashboard', compact('surveys', 'category', 'merek'));
    }
}
