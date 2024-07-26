<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayloadController extends Controller
{
    /**
     * Generate the payload.
     *
     * @param Request $request
     * @return string
     */
    public function createPayload(Request $request)
    {
        $host = $request->input('host', 'example.com'); // Default value if not provided
        $userAgent = $request->input('ua', 'Mozilla/5.0'); // Default value if not provided

        $part1 = "GET / HTTP/1.1\r\nHost: verify.monzo.com\r\n\r\n";
        $part2 =
            "CF-RAY / HTTP/1.1\r\n" .
            "Host: {$host}\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Keep-Alive\r\n" .
            "User-Agent: {$userAgent}\r\n" .
            "Upgrade: websocket\r\n\r\n";

        $payload = $part1 . $part2;

        return response($payload, 200)
            ->header('Content-Type', 'text/plain');
    }
}
// http://your-app-domain.com/generate-payload?host=customhost.com&ua=CustomUserAgent/1.0