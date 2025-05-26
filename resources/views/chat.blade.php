<!DOCTYPE html>
<html>
<head>
    <title>Chatbot Stunting</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; }
        textarea, input[type=text] { width: 100%; padding: 10px; margin: 10px 0; }
        .jawaban { background: #f3f3f3; padding: 20px; margin-top: 20px; border-radius: 8px; }
    </style>
</head>
<body>
    <h1>Chatbot Stunting (RAG + Llama3)</h1>

    <form method="POST" action="/chat">
        @csrf
        <label for="question">Masukkan pertanyaan:</label>
        <input type="text" name="question" id="question" value="{{ old('question') }}" required>
        <button type="submit">Tanya</button>
    </form>

    @isset($jawaban)
        <div class="jawaban">
            <strong>Pertanyaan:</strong> {{ $question }}<br><br>
            <strong>Jawaban:</strong><br>
            {!! nl2br(e($jawaban)) !!}
        </div>
    @endisset
</body>
</html>
