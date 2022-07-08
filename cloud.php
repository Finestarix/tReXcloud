<?php
$title = "Home Page";
require_once("components/header.php");

if (!isset($_SESSION["USER"])) {
    header("Location: " . $_SERVER["HTTP_ORIGIN"] . "/login.php");
    die("Oops. Something when wrong.");
}

require_once("utils/file.php");

$id = $_SESSION["USER"]->id;
$path = "/";
if (isset($_GET["path"])) {
    $path = $_GET["path"];
}

[$directories, $files] = getFoldersFiles($id, $path);
?>

<body class="select-none">
<div class="h-screen flex overflow-hidden bg-gray-50"
     x-data="{isShowMobileNav: false}">

    <?php
    require_once("components/sidebar.php");
    ?>

    <div class="flex-1 overflow-auto focus:outline-none">

        <main class="h-full flex-1 relative pb-8 z-0 overflow-y-auto">

            <div class="bg-green-600 lg:bg-white relative z-10 flex-shrink-0 flex h-30 border-b border-gray-200 lg:border-none">

                <button class="flex lg:hidden items-center px-4 border-r border-gray-200 text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden"
                        @click="isShowMobileNav = true">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h8m-8 6h16"/>
                    </svg>
                </button>

                <?php
                require_once("components/profile.php");
                ?>

            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

                <?php
                require_once("components/breadcrumbs.php");
                ?>

                <div>

                    <?php
                    if (count($directories) > 0) {
                        ?>
                        <div class="mt-8">
                            <h2 class="text-lg leading-6 font-medium text-green-600 text-opacity-80">Folders</h2>
                            <div class="mt-2 grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                                <?php
                                foreach ($directories as $directory) {
                                    ?>
                                    <div class="bg-white cursor-pointer text-md text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 overflow-hidden shadow-md rounded-lg">
                                        <div class="px-5 py-3">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-6 w-6 opacity-70" fill="currentColor"
                                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                        <path stroke-width="2"
                                                              d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                                    </svg>
                                                </div>
                                                <div ondblclick="(function(){window.location.href = 'cloud.php?path=<?= $path . $directory ?>/'})()"
                                                     class="ml-5 w-0 flex-1 font-medium truncate">
                                                    <?= $directory ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <?php
                    if (count($files) > 0) {
                        ?>
                        <div class="mt-8">
                            <h2 class="text-lg leading-6 font-medium text-green-600 text-opacity-80">Files</h2>
                            <div class="mt-2 grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                                <?php
                                foreach ($files as $file) {
                                    ?>
                                    <div class="bg-white cursor-pointer text-md text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 overflow-hidden shadow-md rounded-lg">
                                        <div class="px-5 py-3">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <?php
                                                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                    if (in_array($fileExtension, ["docx", "xlsx", "pptx"])) {
                                                        $fileExtension = substr($fileExtension, 0, 3);
                                                    }
                                                    $fileImage = "public/extensions/" . $fileExtension . ".png";
                                                    ?>
                                                    <img width="24" height="24" src="<?= $fileImage ?>"
                                                         alt="<?= $fileExtension ?>">
                                                </div>
                                                <div class="ml-5 w-0 flex-1 font-medium truncate">
                                                    <?= $file ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>

            </div>

        </main>

        <!-- TODO: add right side bar for folder/file information -->

    </div>

</div>
</body>