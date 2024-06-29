<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OpenAIService;
use Illuminate\Http\Request;

class OpenAIController extends Controller
{
    protected $openaiService;

    public function __construct(OpenAIService $openaiService)
    {
        $this->openaiService = $openaiService;
    }


    /*****************************************************/
    public function ask_ai()
    {
        return view('dashbord.admin.openAi.open_ai_form');
    }
    /*****************************************************/

    public function generateText(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $prompt = $request->input('prompt');
        $response = $this->openaiService->generateText($prompt);

        return redirect(route('admin.ask_ai'))->with('generated_text', $response['choices'][0]['text']);
    }
}
