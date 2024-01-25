<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: /dashboard/login.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            $filename = basename($_SERVER['PHP_SELF']);
            $pageTitle = ucfirst(str_replace('.php', '', $filename));
            $pageTitle = str_replace('_', ' ', $pageTitle); // Replace underscores with spaces
            $pageTitle = ucwords($pageTitle); // Capitalize first letter of each word
            echo "Dashboard - $pageTitle";
        ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a6ebcd5253.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.css" rel="stylesheet" />

</head>

<body class="bg-blue-100 font-sans">
    <div class="flex">
        <!-- Top Bar -->
        <nav class="fixed top-0 z-50 w-full bg-blue-900 border-b border-blue-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="/dashboard/index.php" class="flex ml-2 md:mr-24">
                        <img src="/pic/proton-logo-1.png" class="h-8 mr-3" alt="Logo" />
                    </a>
                </div>

                <!-- Logout Button -->
            <div class="flex items-center">
            <div class="flex items-center ml-3">
            <span class="inline-flex items-center pl-2 pr-4 py-1 text-sm font-semibold leading-none bg-green-200 text-green-600 border-green-600 rounded relative">
            <div class="w-1 h-1 bg-green-800 rounded-full animate-ping mr-2"></div>
            Online
        </span>

        <!-- User Menu Button -->
        <div class="ml-4">
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://a0.anyrgb.com/pngimg/1538/696/material-design-user-profile-account-profile-login-avatar-user-interface-user-button-point.png" alt="user photo">
            </button>
        </div>

        <!-- User Dropdown -->
        <div class="z-50 hidden mx-4 w-64 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
            <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                    <b>Administrator</b>
                </p>
            </div>
            <ul class="py-1" role="none">
                <li>
                    <a href="/dashboard/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out <i class="fa-solid fa-right-from-bracket" style="color: #000000;"></i> </a>
                </li>
            </ul>
        </div>
        </div>
    </div>


            </div>
            </div>
        </nav>
        <!-- End Top Bar -->
        <!-- Side Bar -->
        <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-blue-900 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-900 dark:bg-gray-800">
                <ul class="space-y-4 px-4 font-medium">

                    <!--list for menu dashboard-->
                    <li>
                        <a href="/dashboard/index.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-blue-200 dark:hover:bg-gray-700 group">
                            <svg class="w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                            </svg>
                            <span class="ml-3 text-white group-hover:text-blue-900">Dashboard</span>
                        </a>
                    </li>

                    <!-- SA Menu Start -->
                    <li>
                        <!--button for sales assistant-->
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-blue-200 dark:text-white dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap text-white group-hover:text-blue-900">Sales Assistant</span>
                            <!--<svg class="w-3 h-3 text-white hover:text-blue-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>-->
                        </button>

                        <!--list for menu sales advisor-->
                        <ul id="dropdown-sa" class="ml-4 py-2 space-y-2">
                            <li>
                                <a href="saga.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">Saga</a>
                            </li>
                            <li>
                                <a href="iriz.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">Iriz</a>
                            </li>
                            <li>
                                <a href="persona.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">Persona</a>
                            </li>
                            <li>
                                <a href="s70.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">S70</a>
                            </li>
                            <li>
                                <a href="x50.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">X50</a>
                            </li>
                            <li>
                                <a href="x70.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">X70</a>
                            </li>
                            <li>
                                <a href="x90.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">X90</a>
                            </li>
                        </ul>
                    </li>
                    <!-- SA Menu End -->

                    <!-- Prospect Menu Start -->
                    <li>
                        <!--button for prospect list-->
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-blue-200 dark:text-white dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-blue-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 22">
                            <path fill-rule="evenodd" d="M5.478 5.559A1.5 1.5 0 016.912 4.5H9A.75.75 0 009 3H6.912a3 3 0 00-2.868 2.118l-2.411 7.838a3 3 0 00-.133.882V18a3 3 0 003 3h15a3 3 0 003-3v-4.162c0-.299-.045-.596-.133-.882l-2.412-7.838A3 3 0 0017.088 3H15a.75.75 0 000 1.5h2.088a1.5 1.5 0 011.434 1.059l2.213 7.191H17.89a3 3 0 00-2.684 1.658l-.256.513a1.5 1.5 0 01-1.342.829h-3.218a1.5 1.5 0 01-1.342-.83l-.256-.512a3 3 0 00-2.684-1.658H3.265l2.213-7.191z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v6.44l1.72-1.72a.75.75 0 111.06 1.06l-3 3a.75.75 0 01-1.06 0l-3-3a.75.75 0 011.06-1.06l1.72 1.72V3a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap text-white group-hover:text-blue-900">Prospect List</span>
                            <!--svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>-->
                        </button>

                        <!--list for menu prospect list-->
                        <ul id="dropdown-prospect" class="ml-4 py-2 space-y-2">
                            <li>
                                <a href="saga_prospect.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">Saga</a>
                            </li>
                            <li>
                                <a href="iriz_prospect.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">Iriz</a>
                            </li>
                            <li>
                                <a href="persona_prospect.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">Persona</a>
                            </li>
                            <li>
                                <a href="s70_prospect.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">S70</a>
                            </li>
                            <li>
                                <a href="x50_prospect.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">X50</a>
                            </li>
                            <li>
                                <a href="x70_prospect.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">X70</a>
                            </li>
                            <li>
                                <a href="x90_prospect.php" class="flex items-center w-full p-2 text-white transition duration-75 rounded-lg pl-11 group hover:bg-blue-200 hover:text-blue-900 dark:text-white dark:hover:bg-blue-200">X90</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Proscpect Menu End -->
                
                </ul>
            </div>
        </aside>
        <!-- End Side Bar -->