<div class="fixed inset-0 flex z-30 lg:hidden"
     x-show="isShowMobileNav">

    <div class="fixed inset-0 bg-gray-600 bg-opacity-95"
         x-show="isShowMobileNav"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="isShowMobileNav = false"></div>

    <div class="relative flex-1 flex flex-col sm:max-w-xs w-full pt-5 pb-4 bg-green-600"
         x-show="isShowMobileNav"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full">

        <div class="absolute top-0.5 right-14 -mr-12 pt-2"
             x-show="isShowMobileNav"
             x-transition:enter="ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <button class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    @click="isShowMobileNav = false">
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="flex-shrink-0 flex items-center px-4">
            <img class="h-12 w-auto" src="/public/logo/logo.png" alt="Logo">
        </div>

        <nav class="mt-5 flex-shrink-0 h-full divide-y divide-white overflow-y-auto">
            <div class="px-2 space-y-1">
                <a href="#"
                   class="bg-green-700 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
                    <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                    </svg>
                    My Cloud
                </a>
                <a href="#"
                   class="text-white hover:text-green-700 hover:bg-green-100 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                    <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Recent
                </a>
            </div>
            <div class="mt-5 pt-5">
                <div class="px-2 space-y-1">
                    <form action="/controllers/logoutController.php" method="POST">
                        <button name="logout"
                                class="w-full text-white hover:text-red-700 hover:bg-green-100 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                            <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </nav>

    </div>

</div>

<div class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex flex-col w-64">
        <div class="flex flex-col flex-grow bg-green-600 pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <img class="h-10 w-auto" src="/public/logo/logo.png" alt="Logo">
            </div>
            <nav class="mt-5 flex-1 flex flex-col divide-y divide-white overflow-y-auto">
                <div class="px-2 space-y-1">
                    <a href="/cloud.php"
                       class="bg-green-700 text-white group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md"
                       aria-current="page">
                        <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                        </svg>
                        My Cloud
                    </a>
                    <a href="#"
                       class="text-white hover:text-green-700 hover:bg-green-100 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Recent
                    </a>
                </div>
                <div class="mt-5 pt-5">
                    <div class="px-2 space-y-1">
                        <form action="/controllers/logoutController.php" method="POST">
                            <button name="logout"
                                    class="w-full text-white hover:text-red-700 hover:bg-green-100 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                                <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>