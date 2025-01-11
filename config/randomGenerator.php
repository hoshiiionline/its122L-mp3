<?php
# zodiac signs 
$zodiacSigns = [
    "Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", 
    "Libra", "Scorpio", "Sagittarius", "Capricorn", "Aquarius", "Pisces"
];

# zodiac signs symbols (for monthly matches)
$zodiacSignsSymbol = [
    "Aries ♈︎", "Taurus ♉︎", "Gemini ♊︎", "Cancer ♋︎", "Leo ♌︎", "Virgo ♍︎", 
    "Libra ♎︎", "Scorpio ♏︎", "Sagittarius ♐︎", "Capricorn ♑︎", "Aquarius ♒︎", "Pisces ♓︎"
];

# daily horoscope messages
$horoscopeMessages = [
    "You will find great joy in unexpected places today.",
    "A pleasant surprise awaits you this afternoon.",
    "Today is a good day to start something new.",
    "You will meet someone who will change your life.",
    "Good fortune is heading your way.",
    "An old friend will reach out to you today.",
    "You will overcome a challenge with ease.",
    "Your hard work will pay off soon.",
    "A financial opportunity will present itself.",
    "You will feel a sense of peace and tranquility.",
    "An exciting adventure is on the horizon.",
    "You will receive good news from a loved one.",
    "Today is a day for self-reflection.",
    "You will make a new connection that benefits you.",
    "A creative project will bring you joy.",
    "You will find clarity in a confusing situation.",
    "Your patience will be rewarded.",
    "You will discover a hidden talent.",
    "Today is a day for relaxation and self-care.",
    "You will achieve your goals with determination.",
    "An opportunity for growth will arise.",
    "You will find support from an unexpected source.",
    "Your positive attitude will attract good things.",
    "A new hobby will bring you happiness.",
    "You will receive recognition for your efforts.",
    "A meaningful conversation will uplift you.",
    "You will feel more connected to nature.",
    "A new perspective will bring you clarity.",
    "You will find balance in your life.",
    "An old problem will find a new solution.",
    "You will be inspired to make a positive change.",
    "Your intuition will guide you today.",
    "You will have a moment of profound insight.",
    "A chance encounter will bring you joy.",
    "You will feel a deep sense of gratitude.",
    "A close friend will offer valuable advice.",
    "You will experience a burst of creativity.",
    "A new opportunity will come your way.",
    "You will feel a renewed sense of purpose.",
    "An act of kindness will brighten your day.",
    "You will make progress on a personal goal.",
    "Today is a day for celebration.",
    "You will find joy in simple pleasures.",
    "A new friendship will blossom.",
    "You will feel a strong sense of accomplishment.",
    "An unexpected gift will come your way.",
    "You will have a moment of pure happiness.",
    "You will feel more confident in your abilities.",
    "A dream you have will come closer to reality.",
    "You will find peace in a difficult situation."
];

// gets daily horoscope message
function getDailyHoroscope($sign, $messages) {
    $date = date('Y-m-d'); 
    $seed = strtotime($date) + crc32($sign); 

    mt_srand($seed);
    shuffle($messages);

    return $messages[0];
}

// retrieves daily horoscope (unique) per sign
$horoscopeAries = getDailyHoroscope("Aries", $horoscopeMessages);
$horoscopeTaurus = getDailyHoroscope("Taurus", $horoscopeMessages);
$horoscopeGemini = getDailyHoroscope("Gemini", $horoscopeMessages);
$horoscopeCancer = getDailyHoroscope("Cancer", $horoscopeMessages);
$horoscopeLeo = getDailyHoroscope("Leo", $horoscopeMessages);
$horoscopeVirgo = getDailyHoroscope("Virgo", $horoscopeMessages);
$horoscopeLibra = getDailyHoroscope("Libra", $horoscopeMessages);
$horoscopeScorpio = getDailyHoroscope("Scorpio", $horoscopeMessages);
$horoscopeSagittarius = getDailyHoroscope("Sagittarius", $horoscopeMessages);
$horoscopeCapricorn = getDailyHoroscope("Capricorn", $horoscopeMessages);
$horoscopeAquarius = getDailyHoroscope("Aquarius", $horoscopeMessages);
$horoscopePisces = getDailyHoroscope("Pisces", $horoscopeMessages);

// return monthly matches in home.php
function getRandomZodiacSigns($zodiacSignsSymbol, $numSigns) {
    if ($numSigns > count($zodiacSignsSymbol)) {
        return "Error: Requested number of signs exceeds available unique signs.";
    }

    mt_srand();
    shuffle($zodiacSignsSymbol);
    return array_slice($zodiacSignsSymbol, 0, $numSigns);
}

# setting monthly matches categories; ensuring that once reloaded, page won't randomized selection again
if (!isset($_SESSION['cosmicAllies'])) {
    $_SESSION['cosmicAllies'] = getRandomZodiacSigns($zodiacSignsSymbol, 3);
}
if (!isset($_SESSION['cosmicClashes'])) {
    $_SESSION['cosmicClashes'] = getRandomZodiacSigns($zodiacSignsSymbol, 3);
}
if (!isset($_SESSION['celestialLoveMatches'])) {
    $_SESSION['celestialLoveMatches'] = getRandomZodiacSigns($zodiacSignsSymbol, 3);
}
if (!isset($_SESSION['astralPals'])) {
    $_SESSION['astralPals'] = getRandomZodiacSigns($zodiacSignsSymbol, 3);
}
if (!isset($_SESSION['fortuneStars'])) {
    $_SESSION['fortuneStars'] = getRandomZodiacSigns($zodiacSignsSymbol, 3);
}

$cosmicAllies = $_SESSION['cosmicAllies'];
$cosmicClashes = $_SESSION['cosmicClashes'];
$celestialLoveMatches = $_SESSION['celestialLoveMatches'];
$astralPals = $_SESSION['astralPals'];
$fortuneStars = $_SESSION['fortuneStars'];

// set dates for horoscopes
$horoscopeDates = [
    "Aries" => "20250321T000000Z/20250419T235959",
    "Taurus" => "20250420T000000Z/20250520T235959",
    "Gemini" => "20250521T000000Z/20250620T235959",
    "Cancer" => "20250621T000000Z/20250722T235959",
    "Leo" => "20250723T000000Z/20250822T235959",
    "Virgo" => "20250823T000000Z/20250922T235959",
    "Libra" => "20250923T000000Z/20251022T235959",
    "Scorpio" => "20251023T000000Z/20251121T235959",
    "Sagittarius" => "20251122T000000Z/20251221T235959",
    "Capricorn" => "20251222T000000Z/20260119T235959",
    "Aquarius" => "20240120T000000Z/20250218T235959",
    "Pisces" => "20250219T000000Z/20250320T235959"
];


?>