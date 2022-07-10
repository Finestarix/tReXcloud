<?php
$splitPath = array_values(array_filter(explode("/", $path)));
$totalPath = count($splitPath);
?>

<div class="mt-4">

    <ol class="flex items-center space-x-1">
        <li>
            <?php
            if ($totalPath > 0) {
                ?>
                <div>
                    <a href="/cloud.php" class="text-gray-600 text-opacity-50 hover:text-opacity-70">
                        <svg class="h-6 w-6"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z"/>
                        </svg>
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
                            <svg class="h-6 w-6"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5.5 16a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 16h-8z"/>
                            </svg>
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
                            <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                <svg class="mr-3 h-6 w-6 text-opacity-60"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z"/>
                                </svg>
                                New Folder
                            </button>
                            <form action="controllers/dummyController.php" method="POST">
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
                            <form action="controllers/dummyController.php" method="POST">
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
        if ($totalPath > 1) {
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
                                for ($pathIndex = 0; $pathIndex < $totalPath - 1; $pathIndex++) {
                                    ?>
                                    <a href="cloud.php?path=/<?= implode("/", array_slice($splitPath, 0, $pathIndex + 1)) ?>/"
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
                                           <?= (strlen($splitPath[$pathIndex]) > 10 ? substr($splitPath[$pathIndex], 0, 10) . "..." : $splitPath[$pathIndex]) ?>
                                        </span>
                                        <span class="hidden sm:flex">
                                            <?= $splitPath[$pathIndex] ?>
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
        if ($totalPath > 0) {
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
                                <?= (strlen($splitPath[count($splitPath) - 1]) > 10 ? substr($splitPath[count($splitPath) - 1], 0, 10) . "..." : $splitPath[count($splitPath) - 1]) ?>
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
                                <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                    <svg class="mr-3 h-6 w-6 text-opacity-60"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1H8a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V9z"/>
                                    </svg>
                                    New Folder
                                </button>
                                <form action="controllers/dummyController.php" method="POST">
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
                                <form action="controllers/dummyController.php" method="POST">
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
                                <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                    <svg class="mr-3 h-6 w-6 text-opacity-60"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"/>
                                        <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"/>
                                    </svg>
                                    Rename Folder
                                </button>
                                <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                    <svg class="mr-3 h-6 w-6 text-opacity-60"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm7 5a1 1 0 10-2 0v1.586l-.293-.293a1 1 0 10-1.414 1.414l2 2 .002.002a.997.997 0 001.41 0l.002-.002 2-2a1 1 0 00-1.414-1.414l-.293.293V9z"/>
                                    </svg>
                                    Download Folder
                                </button>
                            </div>
                            <div class="py-1">
                                <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 w-full group flex items-center px-4 py-2 text-sm">
                                    <svg class="mr-3 h-6 w-6 text-opacity-60"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                    </svg>
                                    Share Folder
                                </button>
                            </div>
                            <div class="py-1">
                                <button class="font-bold text-gray-600 text-opacity-50 hover:text-opacity-70 hover:text-red-600 w-full group flex items-center px-4 py-2 text-sm">
                                    <svg class="mr-3 h-6 w-6 text-opacity-60"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm4 6a1 1 0 100 2h4a1 1 0 100-2H8z"/>
                                    </svg>
                                    Delete Folder
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
    </ol>
</div>