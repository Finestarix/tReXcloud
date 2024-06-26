<?php
$title = "Home Page";
require_once("components/header.php");

if (!isset($_SESSION["USER"])) {
    header("Location: " . $_SERVER["HTTP_ORIGIN"] . "/login.php");
    die("Oops. Something when wrong.");
}

require_once("controllers/core/shareController.php");
require_once("utils/file.php");
require_once("utils/validator.php");

$id = $_SESSION["USER"]->id;
$path = "/";
if (isset($_GET["id"])) {
    $share = getShareById($_GET["id"]);
    if (!$share) {
        header("Location: " . $_SERVER["HTTP_ORIGIN"] . "/cloud.php");
        die("Oops. Something when wrong.");
    }
    if (!checkFoldersFiles($share->userId, $share->path)) {
        header("Location: " . $_SERVER["HTTP_ORIGIN"] . "/error.php");
        die("Oops. Something when wrong.");
    }

    $id = $share->userId;
    if (!isset($_GET["path"])) {
        $path = $share->path;
    }
}
if (isset($_GET["path"])) {
    $pathParameter = $_GET["path"];
    if (str_starts_with($pathParameter, "/")) {
        $pathParameter = substr($pathParameter, 1);
    }
    $path .= $pathParameter;
    if (!str_ends_with($path, "/")) {
        $path .= "/";
    }
    if (isset($share)) {
        if (!str_starts_with($path, $share->path)) {
            header("Location: " . $_SERVER["HTTP_ORIGIN"] . "/error.php");
            die("Oops. Something when wrong.");
        }
    }
}

if (isset($_SESSION["share"])) {
    $shareURL = $_SESSION["share"];
    unset($_SESSION["share"]);
}

$result = getFoldersFiles($id, $path);
if (!$result) {
    $_SESSION["MESSAGE"] = "Failed to get list of folders and files.";
    $_SESSION["MESSAGE_TYPE"] = "error";
    $folders = [];
    $files = [];
} else {
    [$folders, $files] = $result;
}
?>

<body class="select-none">
<div class="h-screen flex overflow-hidden bg-gray-50"
     x-data="{isShowMobileNav: false}">
    <?php
    require_once("components/sidebar.php");
    ?>

    <div class="relative flex-1 h-screen overflow-auto focus:outline-none"
         ondragover="onDragOver(event)" ondragleave="onDragLeave(event)" ondrop="onDrop(event)">
        <div class="z-50 absolute bottom-0 left-0 right-0 mx-auto bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-green-600 mr-4"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <form action="controllers/fileController.php" method="POST" enctype="multipart/form-data">
                    <div class="flex flex-row">
                        <p class="font-bold mr-1">Upload File</p>
                        <p id="uploadTotalContainer" class="hidden">(<span id="uploadTotal"></span> files)</p>
                    </div>
                    <p class="font-sm flex flex-row">
                        <span class="hidden sm:flex"><span class="font-medium">Drag and drop</span>&nbsp;your files here, or&nbsp;</span>
                        <span><button type="button" class="underline" onclick="onClickFile()"><span class="font-medium">Click here</span></button>&nbsp;to browse files</span>
                    </p>
                    <input id="id" name="id" type="hidden" value="<?= $id ?>">
                    <input id="path" name="path" type="hidden" value="<?= $path ?>">
                    <input id="uploadFile" name="files[]" class="hidden" type="file" multiple/>
                    <button id="uploadFiles" name="uploadFiles" type="submit"
                            class="bg-green-600 font-medium text-white hover:text-green-200 mt-2 px-3 py-1 rounded-md shadow-lg">
                        Upload
                    </button>
                </form>
            </div>
        </div>

        <main class="flex-1 relative z-0 h-screen overflow-y-auto">
            <div class="bg-green-600 lg:bg-white relative z-10 flex-shrink-0 flex h-24 border-b border-gray-200 lg:border-none">
                <button class="flex lg:hidden items-center px-4 border-r border-gray-200 text-white lg:hidden"
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

            <?php
            require_once("components/snackbar.php");
            ?>

            <div id="uploadContainer"
                 class="pb-52 sm:pb-44 max-w-6xl min-h-[calc(100vh_-_96px)] border border-4 border-gray-50 mx-auto px-4 sm:px-6 lg:px-8">
                <?php
                require_once("components/breadcrumbs.php");
                ?>

                <div>
                    <?php
                    if (count($folders) > 0) {
                        ?>
                        <div class="mt-8">
                            <h2 class="text-lg leading-6 font-medium text-green-600 text-opacity-80">Folders</h2>
                            <div class="mt-2 grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                                <?php
                                foreach ($folders as $key => $folder) {
                                    ?>
                                    <div class="relative inline-block bg-white cursor-pointer text-md text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 shadow-md rounded-lg"
                                         x-data="{isOpenFolder<?= $key ?>: false}">
                                        <div class="px-5 py-3"
                                             @mouseenter="isOpenFolder<?= $key ?> = true"
                                             @mouseleave="isOpenFolder<?= $key ?> = false">
                                            <div id="<?= $key . "_folderroot" ?>">
                                                <div class="flex items-center"
                                                     @click="(function(){window.location.href = 'cloud.php?<?= (isset($share)) ? "id=" . $_GET["id"] . "&" : "" ?>path=<?= $path . $folder ?>/'})()">
                                                    <div class="flex-shrink-0">
                                                        <svg class="h-6 w-6 opacity-70" fill="currentColor"
                                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path stroke-width="2"
                                                                  d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                                        </svg>
                                                    </div>
                                                    <div class="ml-5 w-0 flex-1 font-medium truncate">
                                                        <?= $folder ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="<?= $key . "_foldermenu" ?>"
                                                 class="absolute flex flex-row justify-between left-0 top-10 mt-2 w-full z-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-x divide-gray-100 focus:outline-none"
                                                 x-show="isOpenFolder<?= $key ?>">
                                                <?php
                                                if ($id === $_SESSION["USER"]->id) {
                                                    ?>
                                                    <div class="flex-1 flex justify-center">
                                                        <button class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm"
                                                                onclick="onClickRenameFolder('<?= $folder ?>', '<?= $key ?>')">
                                                            <svg class="h-6 w-6 opacity-70"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                      d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"/>
                                                                <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="flex-1 flex justify-center">
                                                    <form action="controllers/fileController.php" method="POST">
                                                        <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                                        <input id="path" name="path" type="hidden"
                                                               value="<?= $path . $folder . '/' ?>">
                                                        <button id="downloadFolder" name="downloadFolder" type="submit"
                                                                class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                                                            <svg class="h-6 w-6 opacity-70"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                      d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1.586l-.293-.293a1 1 0 10-1.414 1.414l2 2 .002.002a.997.997 0 001.41 0l.002-.002 2-2a1 1 0 00-1.414-1.414l-.293.293V9z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                                <?php
                                                if ($id === $_SESSION["USER"]->id) {
                                                    ?>
                                                    <div class="flex-1 flex justify-center">
                                                        <form action="controllers/fileController.php" method="POST">
                                                            <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                                            <input id="path" name="path" type="hidden"
                                                                   value="<?= $path . $folder . '/' ?>">
                                                            <button id="shareFolder" name="shareFolder" type="submit"
                                                                    class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                                                                <svg class="h-6 w-6 opacity-70"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20"
                                                                     fill="currentColor">
                                                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if ($id === $_SESSION["USER"]->id) {
                                                    ?>
                                                    <div class="flex-1 flex justify-center">
                                                        <form action="controllers/fileController.php" method="POST">
                                                            <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                                            <input id="path" name="path" type="hidden"
                                                                   value="<?= $path . $folder . '/' ?>">
                                                            <input id="type" name="type" type="hidden" value="child">
                                                            <button id="deleteFolder" name="deleteFolder" type="submit"
                                                                    class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-red-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                                                                <svg class="h-6 w-6 opacity-70"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20"
                                                                     fill="currentColor">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                          d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm4 6a1 1 0 100 2h4a1 1 0 100-2H8z"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
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
                                foreach ($files as $key => $file) {
                                    $fileName = pathinfo($file, PATHINFO_FILENAME);
                                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                    if (in_array($fileExtension, ["docx", "xlsx", "pptx"])) {
                                        $fileExtension = substr($fileExtension, 0, 3);
                                    }
                                    $fileImage = "public/extensions/" . $fileExtension . ".png";
                                    ?>
                                    <div class="relative inline-block bg-white cursor-pointer text-md text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 shadow-md rounded-lg"
                                         x-data="{isOpenFile<?= $key ?>: false}">
                                        <div class="px-5 py-3"
                                             @mouseenter="isOpenFile<?= $key ?> = true"
                                             @mouseleave="isOpenFile<?= $key ?> = false">
                                            <div id="<?= $key . "_fileroot" ?>" class="flex items-center">
                                                <div class="flex-shrink-0">
                                                    <img width="24" height="24" src="<?= $fileImage ?>"
                                                         alt="<?= $fileExtension ?>">
                                                </div>
                                                <div class="ml-5 w-0 flex-1 font-medium truncate">
                                                    <?= $file ?>
                                                </div>
                                            </div>
                                            <div id="<?= $key . "_filemenu" ?>"
                                                 class="absolute flex flex-row flex-wrap justify-between left-0 top-10 mt-2 w-full z-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-x divide-gray-100 focus:outline-none"
                                                 x-show="isOpenFile<?= $key ?>">
                                                <?php
                                                if ($id === $_SESSION["USER"]->id) {
                                                    ?>
                                                    <div class="flex-1 flex justify-center">
                                                        <button class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm"
                                                                onclick="onClickRenameFile('<?= $file ?>', '<?= $key ?>', '<?= $fileImage ?>', '<?= $fileExtension ?>')">
                                                            <svg class="h-6 w-6 opacity-70"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                      d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="flex-1 flex justify-center">
                                                    <form action="controllers/fileController.php" method="POST">
                                                        <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                                        <input id="path" name="path" type="hidden"
                                                               value="<?= $path . $file ?>">
                                                        <button id="downloadFile" name="downloadFile" type="submit"
                                                                class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                                                            <svg class="h-6 w-6 opacity-70"
                                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                      d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                                <?php
                                                if ($id === $_SESSION["USER"]->id) {
                                                    ?>
                                                    <div class="flex-1 flex justify-center">
                                                        <form action="controllers/fileController.php" method="POST">
                                                            <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                                            <input id="path" name="path" type="hidden"
                                                                   value="<?= $path . $file ?>">
                                                            <button id="deleteFile" name="deleteFile" type="submit"
                                                                    class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-red-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                                                                <svg class="h-6 w-6 opacity-70"
                                                                     xmlns="http://www.w3.org/2000/svg"
                                                                     viewBox="0 0 20 20"
                                                                     fill="currentColor">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                          d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
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
    </div>
</div>

<?php
if (isset($shareURL)) {
    ?>
    <div class="relative"
         x-data="{isShareModalOpen: true}"
         x-show="isShareModalOpen">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-40"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>
        <div class="fixed inset-0 overflow-y-auto z-40">
            <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                <div class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg w-full z-[200]"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gray-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-600" id="modal-title">
                                    Share Folder
                                </h3>
                                <div class="mt-2">
                                    <input type="text" name="shareLink" id="shareLink" value="<?= $shareURL ?>" readonly
                                           class="text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 focus:border-green-600 focus:ring-0 block w-full sm:text-sm font-medium border-2 border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button class="w-full inline-flex justify-center rounded-md border border-green-100 shadow-sm px-4 py-2 bg-green-600 bg-opacity-80 text-base font-medium text-white hover:bg-opacity-100 sm:ml-3 sm:w-auto sm:text-sm"
                                onclick="onShareCopyClipboard(event)">
                            Copy
                        </button>
                        <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                @click="isShareModalOpen = !isShareModalOpen">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
</body>

<script>
    <?php
    if (isset($shareURL)) {
    ?>
    function onShareCopyClipboard(e) {
        navigator.clipboard.writeText($("#shareLink").val());
        e.preventDefault();
    }
    <?php
    }
    ?>

    function onClickFile() {
        $("#uploadFile").click();
    }

    $("#uploadFile").on("change", function (e) {
        $("#uploadTotalContainer").removeClass("hidden");
        $("#uploadTotal").text(e.target.files.length);
        e.preventDefault();
    });

    function onDrop(e) {
        document.getElementById('uploadFile').files = e.dataTransfer.files;
        $("#uploadTotalContainer").removeClass("hidden");
        $("#uploadTotal").text(e.dataTransfer.files.length);
        onDragLeave(e);
        e.preventDefault();
    }

    function onDragOver(e) {
        $("#uploadContainer").addClass("border-green-600 border-dashed").removeClass("border-gray-50");
        e.preventDefault();
    }

    function onDragLeave(e) {
        $("#uploadContainer").removeClass("border-green-600 border-dashed").addClass("border-gray-50");
        e.preventDefault();
    }

    <?php
    if ($id === $_SESSION["USER"]->id) {
    ?>
    function onClickRenameFolder(folder, key) {
        const user = "<?= $id ?>";
        const path = "<?= $path ?>";
        $("#" + key + "_folderroot").html(`
            <div class="flex flex-row">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 opacity-70" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path stroke-width="2"
                              d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
                <input form="${key + "_folderform"}" type="text" name="newFolder" id="${key + "_foldername"}" value="${folder}" autofocus
                       class="focus:border-green-600 focus:ring-0 block w-full ml-5 px-1 py-0 sm:text-sm font-medium border-0 border-b-2 border-gray-300">
            </div>
        `);
        $("#" + key + "_foldermenu").html(`
            <div class="flex-1 flex justify-center">
                <button class="mx-3 font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-red-600 w-full group flex items-center justify-center px-2 py-2 text-sm"
                        onclick="onClickRenameFolderBack('${folder}', '${key}')">
                    <svg class="h-6 w-6 opacity-70"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex justify-center">
                <form id="${key + "_folderform"}" action="controllers/fileController.php" method="POST">
                    <input id="id" name="id" type="hidden" value="${user}">
                    <input id="type" name="type" type="hidden" value="child">
                    <input id="path" name="path" type="hidden" value="${path}">
                    <input id="folder" name="folder" type="hidden" value="${folder}">
                    <button id="renameFolder" name="renameFolder" type="submit"
                            class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                        <svg class="h-6 w-6 opacity-70"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        `);
    }

    function onClickRenameFile(file, key, image, extension) {
        const user = "<?= $id ?>";
        const path = "<?= $path ?>";
        $("#" + key + "_fileroot").html(`
            <div class="flex flex-row">
                <div class="flex-shrink-0">
                    <img width="24" height="24" src="${image}"
                         alt="${extension}">
                </div>
                <input form="${key + "_fileform"}" type="text" name="newFile" id="${key + "_filename"}" value="${file}" autofocus
                       class="focus:border-green-600 focus:ring-0 block w-full ml-5 px-1 py-0 sm:text-sm font-medium border-0 border-b-2 border-gray-300">
            </div>
        `);
        $("#" + key + "_filemenu").html(`
            <div class="flex-1 flex justify-center">
                <button class="mx-3 font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-red-600 w-full group flex items-center justify-center px-2 py-2 text-sm"
                        onclick="onClickRenameFileBack('${file}', '${key}', '${image}', '${extension}')">
                    <svg class="h-6 w-6 opacity-70"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex justify-center">
                <form id="${key + "_fileform"}" action="controllers/fileController.php" method="POST">
                    <input id="id" name="id" type="hidden" value="${user}">
                    <input id="path" name="path" type="hidden" value="${path}">
                    <input id="file" name="file" type="hidden" value="${file}">
                    <button id="renameFile" name="renameFile" type="submit"
                            class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                        <svg class="h-6 w-6 opacity-70"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        `);
    }

    function onClickRenameFolderBack(folder, key) {
        const user = "<?= $id ?>";
        const path = "<?= $path ?>";
        const sharePath = "<?= (isset($share)) ? 'id=' . $_GET['id'] . '&' : '' ?>";
        $("#" + key + "_folderroot").html(`
            <div class="flex items-center"
                 @click="(function(){window.location.href = 'cloud.php?${sharePath}path=${path + folder}/'})()">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 opacity-70" fill="currentColor"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path stroke-width="2"
                              d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1 font-medium truncate">
                    ${folder}
                </div>
            </div>
        `);
        $("#" + key + "_foldermenu").html(`
            <div class="flex-1 flex justify-center">
                <button class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm"
                        onclick="onClickRenameFolder('${folder}', '${key}')">
                    <svg class="h-6 w-6 opacity-70"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"/>
                        <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex justify-center">
                <form action="controllers/fileController.php" method="POST">
                    <input id="id" name="id" type="hidden" value="${user}">
                    <input id="path" name="path" type="hidden" value="${path + folder + '/'}">
                    <button id="downloadFolder" name="downloadFolder" type="submit"
                            class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                        <svg class="h-6 w-6 opacity-70"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1.586l-.293-.293a1 1 0 10-1.414 1.414l2 2 .002.002a.997.997 0 001.41 0l.002-.002 2-2a1 1 0 00-1.414-1.414l-.293.293V9z"/>
                        </svg>
                    </button>
                </form>
            </div>
            <div class="flex-1 flex justify-center">
                <button class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                    <svg class="h-6 w-6 opacity-70"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex justify-center">
                <form action="controllers/fileController.php" method="POST">
                    <input id="id" name="id" type="hidden" value="${user}">
                    <input id="path" name="path" type="hidden" value="${path + folder + '/'}">
                    <input id="type" name="type" type="hidden" value="child">
                    <button id="deleteFolder" name="deleteFolder" type="submit"
                            class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-red-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                        <svg class="h-6 w-6 opacity-70"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm4 6a1 1 0 100 2h4a1 1 0 100-2H8z"/>
                        </svg>
                    </button>
                </form>
            </div>
        `);
    }

    function onClickRenameFileBack(file, key, image, extension) {
        const user = "<?= $id ?>";
        const path = "<?= $path ?>";
        $("#" + key + "_fileroot").html(`
            <div class="flex-shrink-0">
                <img width="24" height="24" src="${image}"
                     alt="${extension}">
            </div>
            <div class="ml-5 w-0 flex-1 font-medium truncate">
                ${file}
            </div>
        `);
        $("#" + key + "_filemenu").html(`
            <div class="flex-1 flex justify-center">
                <button class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm"
                        onclick="onClickRenameFile('${file}', '${key}', '${image}', '${extension}')">
                    <svg class="h-6 w-6 opacity-70"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex justify-center">
                <form action="controllers/fileController.php" method="POST">
                    <input id="id" name="id" type="hidden" value="${user}">
                    <input id="path" name="path" type="hidden" value="${path + file}">
                    <button id="downloadFile" name="downloadFile" type="submit"
                            class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                        <svg class="h-6 w-6 opacity-70"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"/>
                        </svg>
                    </button>
                </form>
            </div>
            <div class="flex-1 flex justify-center">
                <form action="controllers/fileController.php" method="POST">
                    <input id="id" name="id" type="hidden" value="${user}">
                    <input id="path" name="path" type="hidden" value="${path + file}">
                    <button id="deleteFile" name="deleteFile" type="submit"
                            class="font-bold text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-red-600 w-full group flex items-center justify-center px-2 py-2 text-sm">
                        <svg class="h-6 w-6 opacity-70"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm1 8a1 1 0 100 2h6a1 1 0 100-2H7z"/>
                        </svg>
                    </button>
                </form>
            </div>
        `);
    }
    <?php
    }
    ?>
</script>