<?php
$title = "Login Page";
require_once("components/header.php");

if (isset($_SESSION["USER"])) {
    header("Location: " . $_SERVER["HTTP_ORIGIN"] . "/cloud.php");
    die("Oops. Something when wrong.");
}
?>

<body>
<div class="min-h-screen bg-white flex">

    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">

            <div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    or
                    <a href="/register.php" class="font-medium text-green-600 hover:text-green-500">
                        create your free account
                    </a>
                </p>
            </div>

            <div class="mt-8">
                <div class="mt-6">
                    <form action="controllers/loginController.php" method="POST" class="space-y-3">

                        <div class="space-y-1">
                            <label for="username" class="block text-sm font-medium text-gray-700">
                                Email Address / Username
                            </label>
                            <div class="mt-1">
                                <input id="username" name="username" type="text"
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password"
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>

                        <?php
                        if (isset($_SESSION["ERROR"])) {
                            ?>
                            <div class="p-3 rounded-md bg-red-50">
                                <div class="flex justify-center">
                                    <h3 class="text-sm text-center font-medium text-red-800">
                                        <?= $_SESSION["ERROR"] ?>
                                    </h3>
                                </div>
                            </div>
                            <?php
                            unset($_SESSION["ERROR"]);
                        }
                        ?>

                        <div class="pt-1">
                            <button id="login" name="login" type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Sign In
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="hidden lg:block relative w-0 flex-1">
        <img class="absolute inset-0 h-full w-full object-cover"
             src="public/background/background-login.jpg"
             alt="Login Background">
    </div>

</div>
</body>
