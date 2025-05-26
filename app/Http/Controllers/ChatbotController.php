<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function ask(Request $request)
    {
        $question = $request->input('question');

        // Kirim ke Python API
        $response = Http::post('http://127.0.0.1:5000/ask', [
            'question' => $question
        ]);


        // Ambil jawaban dari Python
        $jawaban = $response->json()['jawaban'] ?? 'Jawaban tidak tersedia.';

        return view('chat', [
            'question' => $question,
            'jawaban' => $jawaban
        ]);
    }
}
