<?php

if(isset($_GET['prompt']) && $_GET['prompt']!='' && isset($_GET['role']) && $_GET['role']!=''){


// ChatGPT API endpoint
$endpoint = "https://api.openai.com/v1/chat/completions";

// ChatGPT secret key
$secret_key = "Enter_your_secret_key _here";

// Prompt to send to ChatGPT
$messages = array(
    array(
        "role" => "system",
        "content" => $_GET['role']
    ),
    array(
        "role" => "user",
        "content" => $_GET['prompt']
    )
);

// Data to be sent in the request
$data = array(
    "model" => "gpt-3.5-turbo",
    "messages" => $messages
);

// Prepare headers
$headers = array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $secret_key
);

// Initialize curl
$ch = curl_init($endpoint);

// Set options for curl
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute curl request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

// Close curl session
curl_close($ch);

// Output response
header('Content-Type: application/json');
echo $response;

}else{
  return ['message'=>false];
}
?>
