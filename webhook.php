
<?php
// Your Page Access Token and Verify Token
$PAGE_ACCESS_TOKEN = 'EABvZC4IbiSOQBO1DwYYxISR8rznApwCNvZBOn4NGVZAo9d6EarlaSOXWgZAgq2m01EVJAfuNZCe0ezbkC8oJhYKs4HJd6SXImE4l9JKA8jxPZBMnjhAlQCt1XkS7sPQMRDLiXHGkv02aDoXPuK9ez1SmbikjQj7oNn4ZCAokGMSs10Haf801pruyyEPDnmvpm87ZBQZDZD';
$VERIFY_TOKEN = 'EABvZC4IbiSOQBO1DwYYxISR8rznApwCNvZBOn4NGVZAo9d6EarlaSOXWgZAgq2m01EVJAfuNZCe0ezbkC8oJhYKs4HJd6SXImE4l9JKA8jxPZBMnjhAlQCt1XkS7sPQMRDLiXHGkv02aDoXPuK9ez1SmbikjQj7oNn4ZCAokGMSs10Haf801pruyyEPDnmvpm87ZBQZDZD';


// Handle verification
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['hub_verify_token'])) {
    if ($_GET['hub_verify_token'] === $VERIFY_TOKEN) {
        echo $_GET['hub_challenge'];
        exit;
    } else {
        http_response_code(403);
        exit;
    }
}

// Handle incoming requests
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['entry'][0]['messaging'][0])) {
    $message = $input['entry'][0]['messaging'][0];

    $senderId = $message['sender']['id'];
    if (isset($message['message']['text'])) {
        $text = $message['message']['text'];
        handleTextMessage($senderId, $text);
    }
}

function handleTextMessage($senderId, $text) {
    global $PAGE_ACCESS_TOKEN;

    // Example quiz question
    $question = "What is the capital of France?";
    $correctAnswer = "Paris";

    if (strtolower($text) === strtolower($correctAnswer)) {
        $response = "Correct! The capital of France is Paris.";
    } else {
        $response = "Sorry, that's incorrect. The correct answer is Paris.";
    }

    $messageData = [
        'recipient' => ['id' => $senderId],
        'message' => ['text' => $response]
    ];

    sendApiRequest('https://graph.facebook.com/v2.6/me/messages', $messageData);
}

function sendApiRequest($url, $data) {
    global $PAGE_ACCESS_TOKEN;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $PAGE_ACCESS_TOKEN
    ]);

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
?>
