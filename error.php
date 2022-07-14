<?php
$title = "Login Page";
require_once("components/header.php");
?>

<body>
<div class="p-16 relative flex items-center justify-center h-screen w-screen bg-green-100">
    <div class="container flex flex-col items-center justify-center z-10">
        <div class="p-2 sm:p-5 flex flex-col align-center justify-center text-center rounded-lg bg-opacity-50 bg-white">
            <div class="text-2xl font-semibold md:text-3xl text-black">Oops! Something when wrong.</div>
            <div class="mt-4 text-black">The page you are looking for does not exist.</div>
            <div class="text-black">It might have been moved or deleted.</div>
            <div class="mt-4 mb-3">
                <a href="/cloud.php" class="underline underline-offset-2 font-semibold rounded text-black hover:text-green-600">Go To My Cloud</a>
            </div>
        </div>
    </div>
    <img class="absolute bottom-0 right-0 left-0 mx-auto px-7" src="public/background/background-error.png">
</div>
</body>