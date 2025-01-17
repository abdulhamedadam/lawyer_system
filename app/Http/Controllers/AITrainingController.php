<?php

namespace App\Http\Controllers;

use App\Models\AiTrainingData;
use App\Services\AITrainingService;
use Illuminate\Http\Request;

class AITrainingController extends Controller
{
    private $trainingService;

    public function __construct(AITrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    /**************************************************/

    public function trainingHistory()
    {
        $lastTrainingData = AiTrainingData::OrderBy('id','desc')->get();
        return view('dashbord.admin.openAi.train-ai', compact('lastTrainingData'));
    }
    /**************************************************/


    public function train(Request $request)
    {
        $request->validate([
            'keyphrase' => 'required|string|max:255',
            'response'  => 'required|string|max:1000',
        ]);

        $this->trainingService->trainAI($request->keyphrase, $request->response);
        return redirect()->back()->with('status', 'AI has been successfully trained.');
    }
}
