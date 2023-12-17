<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merek;
use App\Models\Category;

class SurveyController extends Controller
{
    function index()
    {

        // Menampilkan survei milik pengguna tersebut beserta pertanyaan dan jawabannya
        $authUserId = Auth::id();

        // Melakukan query untuk mendapatkan survei, pertanyaan, dan jawaban berdasarkan ID pengguna yang diautentikasi
        $surveys = Survey::with(['user', 'questions', 'answers', 'answers.electrics.category', 'answers.electrics.merek'])
            ->where('user_id', $authUserId)
            ->get();

        $category = Category::All();
        $merek = Merek::All();

        return view('survey', compact('surveys','category','merek'));
    }
}
