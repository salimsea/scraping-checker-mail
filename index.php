<?php
include 'curl.php';
header("Content-Type: application/json");

function checkerMail ($email) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.mailtester.ninja/ninja.php?email=$email&key=ec11b4c0f6c9e0b4b13182d311a8e5a2",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Connection: keep-alive',
        'sec-ch-ua: " Not;A Brand";v="99", "Google Chrome";v="97", "Chromium";v="97"',
        'sec-ch-ua-mobile: ?0',
        'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36',
        'sec-ch-ua-platform: "macOS"',
        'Content-type: application/json',
        'Accept: application/json"',
        'Origin: https://mailtester.ninja',
        'Sec-Fetch-Site: same-site',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Dest: empty',
        'Referer: https://mailtester.ninja/',
        'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7,tr;q=0.6',
    ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $obj = json_decode($response);
    if($obj->code == "ok") {
        $data = array(
            "status"=>true,
            "check"=>"$check"
        );
    }
    $data = array(
        "status"=>($obj->code == "ko"?false:true),
        "message"=>$obj->message,
        "email" => $obj->email
    );

    return json_encode($data, JSON_PRETTY_PRINT);
}

$email = $_GET['email'];
$key = $_GET['key'];
if ($email != null and $key != null) {
    if($key == "keysalim") {
        print_r(checkerMail("salimajah01@gmail.com"));
    } else {
        $data = array(
            "status"=>false,
            "message"=> "key salah",
            "email" => null
        );
        print_r(json_encode($data, JSON_PRETTY_PRINT));
    }
} else {
    $data = array(
        "status"=>false,
        "message"=> "ada proses yang salah",
        "email" => null
    );
    print_r(json_encode($data, JSON_PRETTY_PRINT));
}