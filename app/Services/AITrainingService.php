<?php

namespace App\Services;

use App\Models\AiTrainingData;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Schema;

class AITrainingService
{
    public function trainAI($keyphrase, $response)
    {
        AiTrainingData::create([
            'keyphrase' => $keyphrase,
            'response'  => $response,
        ]);
    }

}
