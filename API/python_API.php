<?php


function call_python_api($url, $method = "GET", $data = null)
{
    $baseUrl = "http://127.0.0.1:5000";
        
    if (!preg_match("~^https?://~i", $url)) {
        if (substr($url, 0, 1) !== "/") {
            $url = "/" . $url;
        }
        $fullUrl = $baseUrl . $url;
    } else {
        $fullUrl = $url;
    }

    if (strtoupper($method) === "GET" && !empty($data) && is_array($data)) {
        $queryString = http_build_query($data);
        $fullUrl .= (strpos($fullUrl, "?") === false ? "?" : "&") . $queryString;
    }

    $options = [
        "http" => [
            "method" => strtoupper($method),
            "header" => "Content-Type: application/json\r\n",
            "timeout" => 5,
            "ignore_errors" => true
        ]
    ];

    if (strtoupper($method) === "POST" && !empty($data)) {
        $options["http"]["content"] = is_array($data) ? json_encode($data) : $data;
    }

    $context = stream_context_create($options);
    $response = @file_get_contents($fullUrl, false, $context);

    if ($response === false) {
        return [
            "status" => false,
            "error" => "Unable to connect to Python API server at " . $fullUrl
        ];
    }

    $decoded = json_decode($response, true);
    return $decoded !== null ? $decoded : ["status" => false, "raw" => $response];
}


?>
