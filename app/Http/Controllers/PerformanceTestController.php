<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PerformanceTestController extends Controller
{
    public function testPerformance(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'url' => 'required|url',
            'platform' => 'required|in:mobile,desktop',
        ]);

        // Get input values
        $url = $request->input('url');
        $platform = $request->input('platform');

        // Get the API key from the environment variables
        $apiKey = env('GOOGLE_API_KEY');
        
        // Construct the API URL with the key
        $apiUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&strategy={$platform}&key={$apiKey}";

        try {
            // Call Google Lighthouse API
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true);

            // Check if the performance score exists in the response
            if (isset($data['lighthouseResult']['categories']['performance']['score'])) {
                // Extract performance score
                $performanceScore = $data['lighthouseResult']['categories']['performance']['score'] * 100;
                return response()->json(['score' => $performanceScore]);
            } else {
                return response()->json(['error' => 'Performance score not found'], 404);
            }
        } catch (\Exception $e) {
            // Handle exceptions and return an error response
            return response()->json(['error' => 'Failed to retrieve performance data: ' . $e->getMessage()], 500);
        }
    }
}
