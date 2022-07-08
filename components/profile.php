<?php
if ($_SESSION["USER"]->gender == "male") {
    $avatar = "https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Happy&eyebrowType=UpDownNatural&mouthType=Twinkle&skinColor=Light";
} else {
    $avatar = "https://avataaars.io/?avatarStyle=Circle&topType=LongHairStraight2&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Happy&eyebrowType=UpDownNatural&mouthType=Twinkle&skinColor=Light";
}

date_default_timezone_set("Asia/Jakarta");
$hour = date('G');
if ($hour >= 5 && $hour <= 11) {
    $welcomeMessage = "Morning";
} else if ($hour >= 12 && $hour <= 15) {
    $welcomeMessage = "Afternoon";
} else {
    $welcomeMessage = "Evening";
}

$name = $_SESSION["USER"]->name;

$birthdateRaw = date_create($_SESSION["USER"]->birthdate);
$birthdate = date_format($birthdateRaw, "d M Y");

$phone = "+" . $_SESSION["USER"]->phone;
?>

<div class="w-full bg-green-600 lg:bg-white shadow-md">
    <div class="px-4 sm:px-6 lg:max-w-6xl lg:mx-auto lg:px-8">
        <div class="py-4 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
            <div class="flex-1 min-w-0">
                <div class="flex items-center">
                    <img class="hidden h-16 w-16 bg-gray-100 rounded-full sm:block"
                         src="<?= $avatar ?>"
                         alt="Avatar">
                    <div>
                        <div class="flex items-center">
                            <img class="h-16 w-16 bg-green-100 rounded-full sm:hidden"
                                 src="<?= $avatar ?>"
                                 alt="Avatar">
                            <h1 class="flex ml-3 text-lg sm:text-2xl leading-7 text-white lg:text-gray-900 sm:leading-9 sm:truncate">
                                <span class="mr-1">
                                    <?= $welcomeMessage ?>,
                                </span>
                                <span class="font-bold hidden sm:flex">
                                    <?= $name ?>
                                </span>
                                <span class="font-bold flex sm:hidden">
                                    <?= explode(" ", $name)[0] ?>
                                </span>
                            </h1>
                        </div>
                        <dl class="hidden sm:flex mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                            <dd class="flex items-center text-sm text-gray-200 lg:text-gray-600 font-medium capitalize sm:mr-6">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-200 lg:text-gray-600"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                                </svg>
                                <?= $birthdate ?>
                            </dd>
                            <dd class="mt-3 flex items-center text-sm text-gray-200 lg:text-gray-600 font-medium sm:mr-6 sm:mt-0 capitalize">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-200 lg:text-gray-600"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <?= $phone ?>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>