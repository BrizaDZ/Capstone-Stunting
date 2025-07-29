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

        $response = Http::post('https://l2tsvbfz6w3mmb-8000.proxy.runpod.net/chatbot/ask', [
            'question' => $question,
            'user_id' => auth()->id() ?? 1
        ]);

        $jawaban = $response->json()['jawaban'];

        return response()->json([
            'question' => $question,
            'jawaban' => $jawaban
        ]);
    }

}
