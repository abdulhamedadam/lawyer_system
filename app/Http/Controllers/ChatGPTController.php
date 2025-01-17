<?php
namespace App\Http\Controllers;

use App\Models\AiTrainingData;
use App\Services\OpenAIService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class ChatGPTController extends Controller
{
    private $openAIService;

    /*******************************************************/
    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    /*******************************************************/
    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = $request->message;

        $keywords = $this->analyzeMessage($message);
        $databaseResponse = '';
        if (!empty($keywords)) {
            $databaseResponse = $this->fetchDataFromDatabase($keywords);
        }

        $aiResponse = $this->askOpenAI($message);


        $databaseResponse = $this->sanitizeDatabaseResponse($databaseResponse);

        if ($databaseResponse) {
            $responseMessage = "Database Response:\n" . $databaseResponse . "\n\nAI Response: " ;
        } else {
            $responseMessage = "AI Response: " . $aiResponse;
        }

        return response()->json([
             $responseMessage,
        ], 200);
    }


    /******************************************************/
    private function analyzeMessage($message)
    {
        // Normalize the message to lowercase
        $normalizedMessage = strtolower($message);
        $keywords = [];

        // Get all the table names
        $tableNames = $this->getAllTableNames();

        // Check if the message contains any table or column names
        foreach ($tableNames as $table) {
            if (strpos($normalizedMessage, strtolower($table)) !== false) {
                $keywords[] = $table;
            }
        }

        return $keywords;
    }

    /******************************************************/
    private function getAllTableNames()
    {
        // Retrieve all table names from the MySQL database dynamically
        $tables = \DB::select('SHOW TABLES');
        $tableNames = [];

        foreach ($tables as $table) {
            // Get the table name dynamically from the result
            $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};
            $tableNames[] = $tableName;
        }

        return $tableNames;
    }

    /*******************************************************/
    private function fetchDataFromDatabase($keywords)
    {
        // Initialize an empty response
        $databaseResponse = '';

        foreach ($keywords as $keyword) {
            // Query the MySQL table to get some data (e.g., 5 rows)
            $data = \DB::table($keyword)->limit(5)->get();

            if ($data->isNotEmpty()) {
                $databaseResponse .= "Data from table '{$keyword}':\n" . $this->formatDataAsTable($data) . "\n";
            } else {
                $databaseResponse .= "No data found in the '{$keyword}' table.\n";
            }
        }

        return $databaseResponse;
    }

    /*******************************************************/
    private function sanitizeDatabaseResponse($response)
    {
        $response = preg_replace('/\| COLUMN_NAME \|.*\|/', '', $response);

        return $response;
    }
    /*******************************************************/
    private function extractTableNameFromKeyphrase($keyphrase)
    {
        // Logic to extract the table name or key from the keyphrase
        preg_match('/table (\w+)/', $keyphrase, $matches);

        return $matches[1] ?? null; // Return the table name or null if not found
    }

    /*******************************************************/
    private function formatDataAsTable($data)
    {
        // Begin the table with scrollable container
        $tableHtml = "<div style='overflow-x:auto;'>";
        $tableHtml .= "<table border='1' cellpadding='5' cellspacing='0' style='width: 100%; table-layout: auto; border-collapse: collapse; border: 1px solid black;'>";

        // Add table headers
        $firstRow = $data->first();
        if ($firstRow) {
            $tableHtml .= "<thead><tr>";
            foreach ($firstRow as $column => $value) {
                $tableHtml .= "<th style='border: 1px solid black; padding: 5px;'>" . ucfirst($column) . "</th>";
            }
            $tableHtml .= "</tr></thead><tbody>";
        }

        // Add rows
        foreach ($data as $row) {
            $tableHtml .= "<tr>";
            foreach ($row as $column => $value) {
                $tableHtml .= "<td style='border: 1px solid black; padding: 5px;'>" . htmlspecialchars($value) . "</td>";
            }
            $tableHtml .= "</tr>";
        }

        // Close table and div
        $tableHtml .= "</tbody></table></div>";

        return $tableHtml;
    }


    /*******************************************************/
    private function askOpenAI($message)
    {
        $messages = [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $message],
        ];

        try {
            $response = $this->openAIService->chat($messages);
            return $response['choices'][0]['message']['content'] ?? 'I am unable to respond at the moment.';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }











}
