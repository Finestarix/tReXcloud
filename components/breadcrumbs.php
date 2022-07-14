<?php
$splitPathUnfiltered = explode("/", $path);
$splitPath = array_values(array_filter($splitPathUnfiltered));
$totalPath = count($splitPath);

if (isset($share)) {
    $splitSharePath = explode("/", $share->path);
    $splitSharePathPrev =  array_values(array_filter(array_slice($splitSharePath, 0, count($splitSharePath) - 2)));
    $splitSharePathHref = $splitSharePathPrev;
    $splitSharePathHref[] = "";
    $splitSharePath = array_values(array_diff($splitPath, $splitSharePathPrev));
    $totalSharePath = count($splitSharePath);
}
?>

<div class="mt-4"
     x-data="{isRenameModalOpen: false, isCreateModalOpen: false}">
    <ol class="flex items-center space-x-1">
        <li>
            <?php
            if (((isset($share)) ? $totalSharePath : $totalPath) > 0) {
                ?>
                <div>
                    <a href="/cloud.php" class="text-gray-600 text-opacity-50 hover:text-opacity-70">
                        <?php
                        if ($id === $_SESSION["USER"]->id) {
                            ?>
                            <svg class="h-6 w-6"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z"/>
                            </svg>
                            <?php
                        } else {
                            ?>
                            <svg class="h-6 w-6"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                            </svg>
                            <?php
                        }
                        ?>
                    </a>
                </div>
                <?php
            } else {
                ?>
                <div class="ml-1 relative inline-block text-left"
                     x-data="{isCloudShowOption: false}">
                    <div>
                        <button type="button"
                                class="flex items-center justify-center w-full rounded-md text-sm font-bold text-sm text-gray-600 text-opacity-50 hover:text-opacity-70"
                                @click="isCloudShowOption = !isCloudShowOption"
                                @click.away="isCloudShowOption = false">
                            <?php
                            if ($id === $_SESSION["USER"]->id) {
                                ?>
                                <svg class="h-6 w-6"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z"/>
                                </svg>
                                <?php
                            } else {
                                ?>
                                <svg class="h-6 w-6"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                                </svg>
                                <?php
                            }
                            ?>
                            <svg class="-mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="absolute left-0 mt-2 w-56 z-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                         x-show="isCloudShowOption">
                        <div class="py-1">
                            <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm"
                                    @click="isCreateModalOpen = !isCreateModalOpen">
                                <svg class="mr-3 h-6 w-6 text-opacity-60"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z"/>
                                </svg>
                                Create New Folder
                            </button>
                            <form action="controllers/fileController.php" method="POST">
                                <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                <input id="path" name="path" type="hidden" value="<?= $path ?>">
                                <button id="dummyFolder" name="dummyFolder" type="submit"
                                        class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                    <svg class="mr-3 h-6 w-6 text-opacity-60"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z"/>
                                    </svg>
                                    Create Dummy Folder
                                </button>
                            </form>
                            <form action="controllers/fileController.php" method="POST">
                                <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                <input id="path" name="path" type="hidden" value="<?= $path ?>">
                                <button id="dummyFile" name="dummyFile" type="submit"
                                        class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                    <svg class="mr-3 h-6 w-6 text-opacity-60"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z"/>
                                    </svg>
                                    Create Dummy File
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </li>
        <?php
        if (((isset($share)) ? $totalSharePath : $totalPath) > 1) {
            ?>
            <li>
                <div class="flex items-center">
                    <svg class="flex flex-shrink-0 h-5 w-5 text-gray-600 text-opacity-40"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" stroke-width="2"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                    </svg>
                    <div class="ml-1 relative inline-block text-left"
                         x-data="{isShowMenu: false}">
                        <div>
                            <button type="button"
                                    class="flex items-center justify-center w-full rounded-md text-sm font-bold text-sm text-gray-600 text-opacity-50 hover:text-opacity-70"
                                    @click="isShowMenu = !isShowMenu"
                                    @click.away="isShowMenu = false">
                                ...
                            </button>
                        </div>
                        <div class="absolute left-0 mt-2 w-44 sm:w-56 z-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                             x-show="isShowMenu">
                            <div class="py-1">
                                <?php
                                for ($pathIndex = 0; $pathIndex < ((isset($share)) ? $totalSharePath : $totalPath) - 1; $pathIndex++) {

                                    ?>
                                    <a href="cloud.php?<?= (isset($share)) ? "id=" . $_GET["id"] . "&" : "" ?>path=/<?= (isset($share) ? implode("/", $splitSharePathHref) : "") . implode("/", array_slice((isset($share) ? $splitSharePath: $splitPath), 0, $pathIndex + 1)) ?>/"
                                       class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm font-medium">
                                        <span class="relative inline-block">
                                            <svg class="ml-2 mr-3 h-6 w-6 text-opacity-40 hover:text-opacity-60"
                                                 fill="currentColor"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path stroke-width="2"
                                                      d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                                            </svg>
                                            <span class="absolute left-0 bottom-0 inline-flex items-center justify-center text-xs transform -translate-x-2 -translate-y-0.5 rounded-full">
                                                <?= sprintf("%02d", $pathIndex + 1) ?>
                                            </span>
                                        </span>
                                        <span class="flex sm:hidden">
                                            <?php
                                            if (isset($share)) {
                                                echo (strlen($splitSharePath[$pathIndex]) > 10 ? substr($splitSharePath[$pathIndex], 0, 10) . "..." : $splitSharePath[$pathIndex]);
                                            } else {
                                                echo (strlen($splitPath[$pathIndex]) > 10 ? substr($splitPath[$pathIndex], 0, 10) . "..." : $splitPath[$pathIndex]);
                                            }
                                            ?>
                                        </span>
                                        <span class="hidden sm:flex">
                                            <?php
                                            if (isset($share)) {
                                                echo $splitSharePath[$pathIndex];
                                            } else {
                                                echo $splitPath[$pathIndex];
                                            }
                                            ?>
                                        </span>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
        <?php
        if (((isset($share)) ? $totalSharePath : $totalPath) > 0) {
            ?>
            <li>
                <div class="flex items-center">
                    <svg class="flex-shrink-0 h-5 w-5 text-gray-600 text-opacity-40"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" stroke-width="2"
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/>
                    </svg>
                    <div class="ml-1 relative inline-block text-left"
                         x-data="{isShowOption: false}">
                        <div>
                            <button type="button"
                                    class="flex items-center justify-center w-full rounded-md text-sm font-bold text-sm text-gray-600 text-opacity-50 hover:text-opacity-70"
                                    @click="isShowOption = !isShowOption"
                                    @click.away="isShowOption = false">
                                <?php
                                if (isset($share)) {
                                    echo (strlen($splitSharePath[$totalSharePath - 1]) > 10 ? substr($splitSharePath[$totalSharePath - 1], 0, 10) . "..." : $splitSharePath[$totalSharePath - 1]);
                                } else {
                                    echo (strlen($splitPath[$totalPath - 1]) > 10 ? substr($splitPath[$totalPath - 1], 0, 10) . "..." : $splitPath[$totalPath - 1]);
                                }
                                ?>
                                <svg class="-mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="absolute left-0 mt-2 w-56 z-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none"
                             x-show="isShowOption">
                            <div class="py-1">
                                <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm"
                                        @click="isCreateModalOpen = !isCreateModalOpen">
                                    <svg class="mr-3 h-6 w-6 text-opacity-60"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z"/>
                                    </svg>
                                    Create New Folder
                                </button>
                                <form action="controllers/fileController.php" method="POST">
                                    <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                    <input id="path" name="path" type="hidden" value="<?= $path ?>">
                                    <button id="dummyFolder" name="dummyFolder" type="submit"
                                            class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                        <svg class="mr-3 h-6 w-6 text-opacity-60"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z"/>
                                        </svg>
                                        Create Dummy Folder
                                    </button>
                                </form>
                                <form action="controllers/fileController.php" method="POST">
                                    <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                    <input id="path" name="path" type="hidden" value="<?= $path ?>">
                                    <button id="dummyFile" name="dummyFile" type="submit"
                                            class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                        <svg class="mr-3 h-6 w-6 text-opacity-60"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z"/>
                                        </svg>
                                        Create Dummy File
                                    </button>
                                </form>
                                <?php
                                if ($id === $_SESSION["USER"]->id) {
                                    ?>
                                    <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm"
                                            @click="isRenameModalOpen = !isRenameModalOpen">
                                        <svg class="mr-3 h-6 w-6 text-opacity-60"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"/>
                                            <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"/>
                                        </svg>
                                        Rename Folder
                                    </button>
                                    <?php
                                }
                                ?>
                                <form action="controllers/fileController.php" method="POST">
                                    <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                    <input id="path" name="path" type="hidden" value="<?= $path ?>">
                                    <button id="downloadFolder" name="downloadFolder" type="submit"
                                            class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                        <svg class="mr-3 h-6 w-6 text-opacity-60"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1.586l-.293-.293a1 1 0 10-1.414 1.414l2 2 .002.002a.997.997 0 001.41 0l.002-.002 2-2a1 1 0 00-1.414-1.414l-.293.293V9z"/>
                                        </svg>
                                        Download Folder
                                    </button>
                                </form>
                            </div>
                            <?php
                            if ($id === $_SESSION["USER"]->id) {
                                ?>
                                <div class="py-1">
                                    <form action="controllers/fileController.php" method="POST">
                                        <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                        <input id="path" name="path" type="hidden" value="<?= $path ?>">
                                        <button id="shareFolder" name="shareFolder" type="submit"
                                                class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                            <svg class="mr-3 h-6 w-6 text-opacity-60"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                            </svg>
                                            Share Folder
                                        </button>
                                    </form>
                                </div>
                                <div class="py-1">
                                    <form action="controllers/fileController.php" method="POST">
                                        <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                        <input id="path" name="path" type="hidden" value="<?= $path ?>">
                                        <input id="type" name="type" type="hidden" value="parent">
                                        <button id="deleteFolder" name="deleteFolder" type="submit"
                                                class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 hover:text-red-600 w-full group flex items-center px-4 py-2 text-sm">
                                            <svg class="mr-3 h-6 w-6 text-opacity-60"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm4 6a1 1 0 100 2h4a1 1 0 100-2H8z"/>
                                            </svg>
                                            Delete Folder
                                        </button>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
    </ol>

    <?php
    if ($totalPath > 0) {
        ?>
        <div class="relative"
             x-show="isRenameModalOpen">
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
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"/>
                                        <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"/>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-600" id="modal-title">
                                        Rename Folder
                                    </h3>
                                    <div class="mt-2">
                                        <form id="rename-form" action="controllers/fileController.php" method="POST">
                                            <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                            <input id="type" name="type" type="hidden" value="parent">
                                            <input id="path" name="path" type="hidden"
                                                   value="<?= implode("/", array_slice($splitPathUnfiltered, 0, count($splitPathUnfiltered) - 2)) . "/" ?>">
                                            <input id="folder" name="folder" type="hidden"
                                                   value="<?= $splitPath[$totalPath - 1] ?>">
                                            <input type="text" name="newFolder" id="newFolder"
                                                   value="<?= $splitPath[$totalPath - 1] ?>" autofocus
                                                   class="text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 focus:border-green-600 focus:ring-0 block w-full sm:text-sm font-medium border-2 border-gray-300 rounded-md">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button form="rename-form" id="renameFolder" name="renameFolder" type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-green-100 shadow-sm px-4 py-2 bg-green-600 bg-opacity-80 text-base font-medium text-white hover:bg-opacity-100 sm:ml-3 sm:w-auto sm:text-sm">
                                Rename
                            </button>
                            <button type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                    @click="isRenameModalOpen = !isRenameModalOpen">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="relative"
         x-show="isCreateModalOpen">
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
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-600" id="modal-title">
                                    Create New Folder
                                </h3>
                                <div class="mt-2">
                                    <form id="create-form" action="controllers/fileController.php" method="POST">
                                        <input id="id" name="id" type="hidden" value="<?= $id ?>">
                                        <input id="path" name="path" type="hidden"
                                               value="<?= implode("/", $splitPathUnfiltered) ?>">
                                        <input type="text" name="newFolder" id="newFolder" autofocus
                                               class="text-gray-600 text-opacity-80 hover:text-opacity-90 hover:text-green-600 focus:border-green-600 focus:ring-0 block w-full sm:text-sm font-medium border-2 border-gray-300 rounded-md">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button form="create-form" id="createFolder" name="createFolder" type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-green-100 shadow-sm px-4 py-2 bg-green-600 bg-opacity-80 text-base font-medium text-white hover:bg-opacity-100 sm:ml-3 sm:w-auto sm:text-sm">
                            Create
                        </button>
                        <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                @click="isCreateModalOpen = !isCreateModalOpen">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>