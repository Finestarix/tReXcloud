<?php
$title = "Register Page";
require_once("components/header.php");
?>

<body>
<div class="min-h-screen bg-white flex">

    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">

            <div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Create your free account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    or
                    <a href="login.php" class="font-medium text-green-600 hover:text-green-500">
                        sign in to your account
                    </a>
                </p>
            </div>

            <div class="mt-8">
                <form action="controllers/registerController.php" method="POST" class="space-y-4">

                    <div class="flex flex-row justify-between">
                        <div class="mr-1 space-y-1">
                            <label for="firstname" class="text-sm font-medium text-gray-700">
                                First Name
                            </label>
                            <div class="mt-1">
                                <input id="firstname" name="firstname" type="text"
                                       class="appearance-none px-3 py-2 w-full border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="ml-1 space-y-1">
                            <label for="lastname" class="text-sm font-medium text-gray-700">
                                Last Name
                            </label>
                            <div class="mt-1">
                                <input id="lastname" name="lastname" type="text"
                                       class="appearance-none px-3 py-2 w-full border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="username" class="text-sm font-medium text-gray-700">
                            Username
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input id="username" name="username" type="text"
                                   class="appearance-none px-3 py-2 w-full border border-gray-300 rounded-l-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            <span class="inline-flex items-center px-3 rounded-r-md border border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                @trexcloud.com
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-row justify-between mt-1">
                        <div class="mr-1 space-y-1">
                            <label for="password" class="text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password"
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="ml-1 space-y-1">
                            <label for="confirmpassword" class="text-sm font-medium text-gray-700">
                                Confirm Password
                            </label>
                            <div class="mt-1">
                                <input id="confirmpassword" name="confirmpassword" type="password"
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="phonenumber" class="text-sm font-medium text-gray-700">
                            Phone Number
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                +62
                            </span>
                            <input id="phonenumber" name="phonenumber" type="tel"
                                   class="appearance-none px-3 py-2 w-full border border-gray-300 rounded-r-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="birthdate" class="block text-sm font-medium text-gray-700">
                            Birthdate
                        </label>
                        <?php
                        $monthList = ["January", "February", "March", "April", "May", "June",
                            "July", "August", "September", "October", "November", "December"];
                        ?>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <select id="birthdateday" name="birthdateday"
                                    class="appearance-none px-3 py-2 w-36 border border-gray-300 rounded-l-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                <option value="-" disabled selected>Day</option>
                                <?php
                                foreach (range(1, 31) as $day) {
                                    echo "<option value='$day'>$day</option>";
                                }
                                ?>
                            </select>
                            <select id="birthdatemonth" name="birthdatemonth"
                                    class="appearance-none px-3 py-2 w-full border border-gray-300 shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                <option value="-" disabled selected>Month</option>
                                <?php
                                foreach (range(0, 11) as $month) {
                                    echo "<option value='" . ($month + 1) . "'>$monthList[$month]</option>";
                                }
                                ?>
                            </select>
                            <select id="birthdateyear" name="birthdateyear"
                                    class="appearance-none px-3 py-2 w-36 border border-gray-300 rounded-r-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                <option value="-" disabled selected>Year</option>
                                <?php
                                foreach (range(1990, date("Y")) as $year) {
                                    echo "<option value='$year'>$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="gender" class="block text-sm font-medium text-gray-700">
                            Gender
                        </label>
                        <div class="mt-1 flex flex-row items-center">
                            <div class="mr-4 flex items-center">
                                <input id="male" name="gender" value="male" type="radio"
                                       class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                                <label for="male" class="ml-2 text-sm font-medium text-gray-700">
                                    Male
                                </label>
                            </div>
                            <div class="mr-4 flex items-center">
                                <input id="female" name="gender" value="female" type="radio"
                                       class="h-4 w-4 text-green-600 border-gray-300 focus:ring-green-500">
                                <label for="female" class="ml-2 text-sm font-medium text-gray-700">
                                    Female
                                </label>
                            </div>
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
                        <button id="register" name="register" type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Register
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="hidden lg:block relative w-0 flex-1">
        <img class="absolute inset-0 h-full w-full object-cover"
             src="public/background/background-register.jpg"
             alt="Register Background">
    </div>

</div>
</body>
