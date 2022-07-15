<?php
$title = "Home Page";
require_once("components/header.php");
?>

<div class="relative overflow-hidden">

    <nav class="relative pt-6 pb-6 bg-white shadow-lg"
         x-data="{isShowMobileNav: false}">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <nav class="relative flex items-center justify-between sm:h-10 md:justify-center">
                <div class="flex items-center flex-1 md:absolute md:inset-y-0 md:left-0">
                    <div class="flex items-center justify-between w-full md:w-auto">
                        <a href="/index.php">
                            <img class="h-10 w-auto" src="/public/logo/logo.png" alt="Logo">
                        </a>
                        <div class="-mr-2 flex items-center md:hidden">
                            <button type="button"
                                    class="bg-gray-50 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500"
                                    @click="isShowMobileNav = true">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="hidden md:flex md:space-x-10">
                    <a href="#product" class="font-medium text-gray-500 hover:text-gray-900">
                        Product
                    </a>
                    <a href="#feature" class="font-medium text-gray-500 hover:text-gray-900">
                        Feature
                    </a>
                    <a href="#company" class="font-medium text-gray-500 hover:text-gray-900">
                        Company
                    </a>
                    <a href="#team" class="font-medium text-gray-500 hover:text-gray-900">
                        Team
                    </a>
                </div>
                <div class="hidden md:absolute md:flex md:items-center md:justify-end md:inset-y-0 md:right-0">
                    <span class="inline-flex rounded-md shadow">
                        <a href="/login.php"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-gray-50">
                            Log In
                        </a>
                    </span>
                </div>
            </nav>
        </div>

        <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
             x-show="isShowMobileNav"
             x-transition:enter="duration-150 ease-out"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="duration-100 ease-in"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="px-5 pt-4 flex items-center justify-between">
                    <div>
                        <img class="h-10 w-auto" src="/public/logo/logo.png" alt="Logo">
                    </div>
                    <div class="-mr-2">
                        <button type="button"
                                class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500"
                                @click="isShowMobileNav = false">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="px-2 pt-2 pb-3">
                    <a href="#product"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                       @click="isShowMobileNav = false">
                        Product
                    </a>
                    <a href="#feature"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                       @click="isShowMobileNav = false">
                        Features
                    </a>
                    <a href="#company"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                       @click="isShowMobileNav = false">
                        Marketplace
                    </a>
                    <a href="#team"
                       class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50"
                       @click="isShowMobileNav = false">
                        Team
                    </a>
                </div>
                <a href="/login.php"
                   class="block w-full px-5 py-3 text-center font-medium text-green-600 bg-gray-50 hover:bg-gray-100">
                    Log In
                </a>
            </div>
        </div>

    </nav>

    <div id="product" class="mt-5 py-14 px-4 sm:px-6 lg:px-8 mx-auto max-w-7xl bg-green-50 text-center">
        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block xl:inline">
                Store, access, and share
            </span>
            <span class="block text-green-600 xl:inline">
                files in one place
            </span>
        </h1>
        <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Store any and every file.
            Access files anytime, anywhere from your desktop and mobile devices.
            Control how files are shared.
        </p>
        <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
            <div class="rounded-md shadow">
                <a href="/register.php"
                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg md:px-10">
                    Get started
                </a>
            </div>
            <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                <a href="/cloud.php"
                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-green-600 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                    Go To My Cloud
                </a>
            </div>
        </div>
    </div>

    <div id="feature" class="py-14 px-4 sm:px-6 lg:px-8 mx-auto max-w-7xl bg-white">
        <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
            <div class="relative">
                <dt>
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-600 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">
                        Get all the storage capacity you need
                    </p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    We provides flexible storage options so you will always have enough space for you files.
                </dd>
            </div>
            <div class="relative">
                <dt>
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-600 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">
                        Control how your files are shared
                    </p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    Keep files private until you decide to share them.
                    You can give shared files a permission to view and download.
                </dd>
            </div>
            <div class="relative">
                <dt>
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-600 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">
                        Organized files in a shared space
                    </p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    Any files added to shared drives are owned collectively by the user, so everyone stays up to date.
                </dd>
            </div>
            <div class="relative">
                <dt>
                    <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-green-600 text-white">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <p class="ml-16 text-lg leading-6 font-medium text-gray-900">
                        Use less of your PC/Mac disk space
                    </p>
                </dt>
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    You can access files directly from you web browser, without impacting all of your disk space.
                </dd>
            </div>
        </div>
    </div>

    <div id="company" class="py-14 px-4 sm:py-20 sm:px-6 lg:px-8 mx-auto max-w-7xl bg-green-50">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
            <h2 class="max-w-md mx-auto text-3xl font-extrabold text-green-600 text-center lg:max-w-xl lg:text-left">
                The world's most innovative companies use tReXcloud
            </h2>
            <div class="flow-root self-center mt-8 lg:mt-0">
                <div class="-mt-4 -ml-8 flex flex-wrap justify-between lg:-ml-4">
                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                        <svg class="h-12" fill="none" height="48" viewBox="0 0 189 48" width="189" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#6b7280"
                                  d="m63.2666 35.6415h3.718l3.1022-10.9409 3.126 10.9409h3.718l4.6415-16.577h-3.4338l-3.1733 12.2906-3.4812-12.2906h-2.7944l-3.4575 12.2906-3.1733-12.2906h-3.4338z"/>
                            <path fill="#6b7280"
                                  d="m87.5508 35.973c3.4812 0 6.2756-2.7233 6.2756-6.2519 0-3.5285-2.7944-6.2519-6.2756-6.2519s-6.2519 2.7234-6.2519 6.2519c0 3.5286 2.7707 6.2519 6.2519 6.2519zm0-2.9838c-1.7998 0-3.197-1.3499-3.197-3.2681s1.3972-3.268 3.197-3.268c1.8235 0 3.2207 1.3498 3.2207 3.268s-1.3972 3.2681-3.2207 3.2681z"/>
                            <path fill="#6b7280"
                                  d="m99.0304 25.8374v-2.0367h-3.0549v11.8408h3.0549v-5.6599c0-2.4865 2.0126-3.197 3.5996-3.0075v-3.4102c-1.492 0-2.9839.6631-3.5996 2.2735z"/>
                            <path fill="#6b7280"
                                  d="m115.334 35.6415-4.902-5.9914 4.76-5.8494h-3.647l-4.073 5.21v-9.9462h-3.055v16.577h3.055v-5.3757l4.31 5.3757z"/>
                            <path fill="#6b7280" clip-rule="evenodd"
                                  d="m46.3417 20.4503-7.596-4.3857v20.3714h8.8804v1.9735h-43.41603v-1.9735h3.94693v-12.5505l-3.67837.9196-.47863-1.9145 20.8091-5.2023h3.0813c-.3401.8066-.5661 1.6571-.6713 2.5247l-.4758 3.9222 5.0952-2.9418v15.2426h4.9337v-20.3702l-7.5941 4.3847c.2187-1.8034 1.0965-3.5088 2.5313-4.7358h-4.0644c1.35-1.7975 3.4998-2.9602 5.9213-2.9602.2139 0 .4269.0092.636.0271l-5.5176-3.18575c2.0679-.88157 4.5106-.81376 6.6074.39688 1.0253.59177 1.8559 1.39197 2.4678 2.31597.6119-.924 1.4415-1.7242 2.4668-2.31597 2.0968-1.21064 4.5405-1.27845 6.6084-.39688l-5.5186 3.18575c.2101-.0179.4231-.0271.638-.0271 2.4205 0 4.5703 1.1627 5.9203 2.9602h-4.0654c1.4358 1.227 2.3136 2.9324 2.5323 4.7356zm-18.4501 15.9857v-9.8672h-5.9204v9.8672zm-10.854-7.8937c0 1.0899-.8836 1.9734-1.9735 1.9734s-1.9734-.8835-1.9734-1.9734.8835-1.9735 1.9734-1.9735 1.9735.8836 1.9735 1.9735z"
                                  fill-rule="evenodd"/>
                            <path fill="#6b7280"
                                  d="m122.496 35.9733c2.321 0 4.334-1.2315 5.352-3.0786l-2.652-1.5156c-.474.9709-1.492 1.5629-2.724 1.5629-1.823 0-3.173-1.3498-3.173-3.2206 0-1.8946 1.35-3.2444 3.173-3.2444 1.208 0 2.226.6157 2.7 1.5867l2.629-1.5393c-.971-1.8235-2.984-3.055-5.305-3.055-3.6 0-6.252 2.7234-6.252 6.252 0 3.5285 2.652 6.2519 6.252 6.2519z"/>
                            <path fill="#6b7280"
                                  d="m138.278 23.801v1.3972c-.853-1.0657-2.132-1.7288-3.86-1.7288-3.15 0-5.755 2.7234-5.755 6.252 0 3.5285 2.605 6.2519 5.755 6.2519 1.728 0 3.007-.6631 3.86-1.7288v1.3972h3.055v-11.8407zm-3.292 9.2594c-1.871 0-3.268-1.3498-3.268-3.339 0-1.9893 1.397-3.3391 3.268-3.3391 1.895 0 3.292 1.3498 3.292 3.3391 0 1.9892-1.397 3.339-3.292 3.339z"/>
                            <path fill="#6b7280"
                                  d="m150.876 26.7375v-2.9365h-2.676v-3.3154l-3.055.9236v2.3918h-2.06v2.9365h2.06v4.9257c0 3.197 1.444 4.4522 5.731 3.9785v-2.7707c-1.753.0947-2.676.071-2.676-1.2078v-4.9257z"/>
                            <path fill="#6b7280"
                                  d="m154.545 22.3801c1.042 0 1.895-.8525 1.895-1.8708s-.853-1.8946-1.895-1.8946c-1.018 0-1.871.8763-1.871 1.8946s.853 1.8708 1.871 1.8708zm-1.515 13.2616h3.055v-11.8407h-3.055z"/>
                            <path fill="#6b7280"
                                  d="m164.517 35.9733c3.481 0 6.275-2.7234 6.275-6.2519 0-3.5286-2.794-6.252-6.275-6.252s-6.252 2.7234-6.252 6.252c0 3.5285 2.771 6.2519 6.252 6.2519zm0-2.9839c-1.8 0-3.197-1.3498-3.197-3.268s1.397-3.2681 3.197-3.2681c1.823 0 3.22 1.3499 3.22 3.2681s-1.397 3.268-3.22 3.268z"/>
                            <path fill="#6b7280"
                                  d="m179.525 23.4694c-1.587 0-2.818.5921-3.529 1.6578v-1.3262h-3.055v11.8407h3.055v-6.394c0-2.0603 1.113-2.9365 2.605-2.9365 1.374 0 2.345.8289 2.345 2.4392v6.8913h3.055v-7.2702c0-3.1496-1.966-4.9021-4.476-4.9021z"/>
                        </svg>
                    </div>
                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                        <svg class="h-12" fill="none" viewBox="0 0 105 48" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#6b7280" fill-rule="evenodd" d="M18 4L0 10v19.5l6 2V37l18 6V11.5l-6 2V4zM8 32.167L18 35.5V15.608l4-1.333v25.95L8 35.56v-3.392z" clip-rule="evenodd"/>
                            <path fill="#6b7280" d="M42.9 20.45V31h4.446V20.45h3.53v-3.392H39.39v3.393h3.51zM53.105 25.248c0 3.978 2.3 6.006 6.376 6.006 3.9 0 6.396-1.853 6.396-6.045v-8.151h-4.446v7.995c0 1.833-.39 2.73-1.95 2.73-1.58 0-1.97-.897-1.97-2.71v-8.015h-4.406v8.19z"/>
                            <path fill="#6b7280" fill-rule="evenodd" d="M68.965 31V17.058h5.558c4.017 0 5.733 1.794 5.733 4.777v.078c0 2.906-1.93 4.544-5.538 4.544h-1.346V31h-4.407zm5.323-7.507h-.916v-3.14h.936c1.15 0 1.755.43 1.755 1.502v.078c0 1.033-.605 1.56-1.775 1.56z" clip-rule="evenodd"/>
                            <path fill="#6b7280" d="M82.563 31V17.058h4.427v10.53h5.07V31h-9.497zM94.562 17.058V31h10.218v-3.393h-5.811v-2.086h4.368v-3.1h-4.368v-1.97h5.499v-3.393h-9.906z"/>
                        </svg>
                    </div>
                    <div class="mt-4 ml-8 flex flex-grow flex-shrink-0 justify-center lg:flex-grow-0 lg:ml-4">
                        <svg class="h-12" fill="none" viewBox="0 0 110 48" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#6b7280" fill-rule="evenodd" clip-rule="evenodd"
                                  d="M43.6 33.612v-15.6a2.01 2.01 0 014.02 0v15.6a2.01 2.01 0 01-4.02 0zm19.2.452c-1.24 1.056-2.852 1.72-4.916 1.72-4.256 0-7.404-2.992-7.404-7.328v-.052c0-4.048 2.88-7.38 7.008-7.38 4.732 0 6.824 3.888 6.824 6.824 0 1.164-.82 1.932-1.88 1.932h-7.96c.4 1.824 1.668 2.776 3.464 2.776a4.63 4.63 0 002.856-.952c.292-.212.56-.32.98-.32.9 0 1.56.692 1.56 1.588 0 .532-.24.928-.528 1.192zm-8.38-6.8h6.056c-.24-1.796-1.296-3.012-2.988-3.012-1.668 0-2.752 1.188-3.068 3.016zm20.552 6.748c-.448 1.028-1.192 1.744-2.276 1.744h-.208c-1.088 0-1.828-.688-2.28-1.744L65.88 23.988a2.672 2.672 0 01-.212-.98c0-.952.872-1.88 1.956-1.88s1.664.612 1.96 1.432l3.04 8.224 3.092-8.28c.264-.684.82-1.372 1.88-1.372a1.903 1.903 0 011.928 1.904c0 .344-.132.764-.212.952l-4.336 10.024zm18.12.052c-1.24 1.056-2.856 1.72-4.92 1.72-4.256 0-7.404-2.992-7.404-7.328v-.052c0-4.048 2.88-7.38 7.008-7.38 4.732 0 6.824 3.888 6.824 6.824 0 1.164-.82 1.932-1.88 1.932h-7.96c.4 1.824 1.668 2.776 3.464 2.776a4.63 4.63 0 002.856-.952c.292-.212.56-.32.98-.32.9 0 1.56.692 1.56 1.588 0 .532-.24.928-.528 1.192zm-8.384-6.8h6.056c-.24-1.796-1.296-3.012-2.988-3.012-1.668 0-2.752 1.188-3.068 3.016zm12.908 6.348v-15.6a2.01 2.01 0 014.02 0v15.6a2.01 2.01 0 01-4.02 0zM12.2 16h16a2 2 0 010 4h-16a2 2 0 010-4zm5.8 8h16a2 2 0 010 4H18a2 2 0 010-4zM8 32h16a2 2 0 010 4H8a2 2 0 110-4z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="team" class="py-14 px-4 lg:py-20 sm:px-6 lg:px-8 mx-auto max-w-7xl bg-white">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3 lg:gap-8">
            <div class="space-y-5 sm:space-y-4">
                <h2 class="text-3xl font-extrabold tracking-tight sm:text-4xl">
                    Meet our team
                </h2>
                <p class="text-xl text-gray-500">
                    Choose from thousands of trusted person to help you move to, build, and work in the cloud.
                </p>
            </div>
            <div class="lg:col-span-2">
                <ul class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-12 sm:space-y-0 lg:gap-x-8">
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairTheCaesar&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=CollarSweater&clotheColor=Gray01&eyeType=Close&eyebrowType=Angry&mouthType=Serious&skinColor=Light"
                                 alt="FL21-2">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Felix G.</h3>
                                    <h3>(FL21-2)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">Co-Founder / CEO</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairDreads01&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Wink&eyebrowType=RaisedExcited&mouthType=Smile&skinColor=Light"
                                 alt="RX19-2">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Renaldy</h3>
                                    <h3>(RX19-2)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">Co-Founder / COO</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairTheCaesarSidePart&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=CollarSweater&clotheColor=Black&eyeType=Default&eyebrowType=Default&mouthType=Tongue&skinColor=Light"
                                 alt="HE21-1">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Hansen A.</h3>
                                    <h3>(HE21-1)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">Co-Founder / CTO</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=LongHairStraight2&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=GraphicShirt&clotheColor=Pink&graphicType=Bear&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Twinkle&skinColor=Light"
                                 alt="LA21-1">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Julieta</h3>
                                    <h3>(LA21-1)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">Co-Founder / CFO</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=MoustacheMagnum&facialHairColor=Black&clotheType=ShirtVNeck&clotheColor=Gray01&eyeType=Happy&eyebrowType=RaisedExcited&mouthType=Grimace&skinColor=Light"
                                 alt="EN21-1">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Erwin</h3>
                                    <h3>(EN21-1)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">Co-Founder / CMO</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShaggyMullet&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=Gray01&eyeType=Default&eyebrowType=RaisedExcited&mouthType=Smile&skinColor=Light"
                                 alt="JG21-1">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Jose G.</h3>
                                    <h3>(JG21-1)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">VP, Penetration Tester</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortFlat&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=CollarSweater&clotheColor=Black&eyeType=Default&eyebrowType=RaisedExcitedNatural&mouthType=Twinkle&skinColor=Light"
                                 alt="LT20-1">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Lukas T. K.</h3>
                                    <h3>(LT20-1)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">VP, Designer</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortRound&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=BlazerSweater&eyeType=Squint&eyebrowType=Default&mouthType=Eating&skinColor=Light"
                                 alt="CA21-2">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Cristoper A.</h3>
                                    <h3>(CA21-2)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">VP, User Experience</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortFlat&accessoriesType=Blank&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=Black&eyeType=Wink&eyebrowType=UpDownNatural&mouthType=Default&skinColor=Light"
                                 alt="AD21-1">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Andre S. W.</h3>
                                    <h3>(AD21-1)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">VP, Front-End Developer</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <img class="w-20 h-20 rounded-full lg:w-24 lg:h-24"
                                 src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortRound&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=ShirtCrewNeck&clotheColor=Gray02&eyeType=Default&eyebrowType=FlatNatural&mouthType=Disbelief&skinColor=Light"
                                 alt="FX21-1">
                            <div class="font-medium text-md sm:text-lg leading-6 space-y-1">
                                <div class="flex flex-col sm:flex-row sm:space-x-1">
                                    <h3>Felix N.</h3>
                                    <h3>(FX21-1)</h3>
                                </div>
                                <p class="text-green-600 text-sm sm:text-lg">VP, Back-End Developer</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mb-5 py-14 px-4 sm:px-6 lg:py-16 lg:px-8 mx-auto max-w-7xl bg-green-50 text-center">
        <p class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            <span class="block">
                Start today - It's easy.
            </span>
        </p>
        <p class="mt-2 text-lg tracking-tight text-gray-400 sm:text-xl">
            <span class="block">
                If you need help there's 24/7 email, chat, and phone support from a real person.
            </span>
        </p>
        <div class="mt-8 flex justify-center">
            <div class="inline-flex rounded-md shadow">
                <a href="/register.php"
                   class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    Get Started
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-white shadow-inner">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="flex justify-center space-x-6 md:order-2">
                <a href="https://www.facebook.com/SoftwareLabCenter" target="_blank"
                   class="text-gray-500 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/slcbinusuniv/" target="_blank"
                   class="text-gray-500 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                    </svg>
                </a>
                <a href="https://github.com/bluejacketslc" target="_blank"
                   class="text-gray-500 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                    </svg>
                </a>
            </div>
            <div class="mt-8 md:mt-0 md:order-1">
                <p class="text-base text-gray-500">
                    &copy; 2022 tReXcloud - New Assistant Recuitment (NAR) 22-2.
                </p>
                <p class="text-base text-gray-400">
                    Inspired by <a href="https://workspace.google.com/intl/en/products/drive">Google Drive</a> &
                    <a href="https://www.microsoft.com/en-ww/microsoft-365/onedrive/">Microsoft OneDrive</a>.
                </p>
                <p class="text-base text-gray-400">
                    Created using <a href="https://tailwindui.com">Tailwind UI</a>.
                </p>
            </div>
        </div>
    </footer>

</div>
