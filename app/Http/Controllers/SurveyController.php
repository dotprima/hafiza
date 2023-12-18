<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merek;
use App\Models\Category;
use App\Models\SurveyAnswer;
use App\Models\Electric;
use Illuminate\Support\Facades\DB;

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
            'pemakaian' => 'required|integer',
            'SKU' => 'required',
            'kategori' => 'required|not_in:Pilih',
            'merek' => 'required|not_in:Pilih',
        ]);

        $electric = Electric::where('id_kategori', $request->SKU)->where('id_kategori', $request->kategori)->where('id_merek', $request->merek)->first();

        if ($electric) {
            $request->merge(['electric_id' => $electric->id]);
            $request->merge(['user_id' => Auth::id()]);

            $surveyAnswer = SurveyAnswer::create($request->all());

            return response()->json(['message' => 'Survey answer created successfully', 'data' => $surveyAnswer], 201);
        } else {
            DB::beginTransaction();

            try {
                // Step 1: Insert data into 'mereks' table
                $merekId = DB::table('mereks')->insertGetId([
                    'nama_merek' => ucwords($request->merek),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Step 2: Insert data into 'categories' table
                $kategoriId = DB::table('categories')->insertGetId([
                    'nama_kategori' => ucwords($request->kategori),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Step 3: Insert data into 'electrics' table
                $electrciId = DB::table('electrics')->insert([
                    'nama_electric' => ucwords($request->SKU),
                    'id_merek' => $merekId,
                    'id_kategori' => $kategoriId,
                    'watt' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('survey_answers')->insert([
                    'electric_id' => $electrciId,
                    'user_id' => Auth::id(),
                    'pemakaian' => $request->pemakaian,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::commit();
            } catch (\Exception $e) {
                // If any exception occurs, rollback the transaction
                DB::rollback();

                // You can handle the exception here or log it
                return response()->json(['error' => 'Error occurred while inserting data.'], 500);
            }

            // If everything is successful, you can return a success response
            return response()->json(['success' => true], 200);
        }
    }

    public function deleteSurvey($id)
    {
        try {
            $surveyAnswer = SurveyAnswer::find($id);

            if (!$surveyAnswer) {
                return redirect()->route('survey.index')
                    ->with('error', 'Survey answer not found.');
            }

            // Check if the authenticated user's ID matches the user_id of the SurveyAnswer
            if ($surveyAnswer->user_id !== auth()->user()->id) {
                return redirect()->route('survey.index')
                    ->with('error', 'You do not have permission to delete this survey answer.');
            }

            $surveyAnswer->delete();

            return redirect()->route('survey.index')
                ->with('success', 'Survey answer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('survey.index')
                ->with('error', 'An error occurred while deleting the survey answer.');
        }
    }
}
