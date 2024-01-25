<?php
include 'controller/db.php';
include 'controller/calculator.php';

/*session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: /dashboard/login.php"); // Redirect to login if not logged in
    exit();
}*/
?>
<?php include 'layout/header.php'; ?>

<div class="flex-1 p-8 sm:ml-64 mt-10">
    <div class="grid grid-cols-12 gap-6 mt-5">

            <!--card for last month prospect-->    
            <a class="transform hover:scale-105 transition duration-300 shadow rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-yellow-200"
                href="last_month_prospect.php">
                <div class="p-5">
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <div class="<?php echo $percentageIncreaseCombined >= 0 ? 'bg-green-500' : 'bg-red-500'; ?> rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                            <span class="flex items-center">
                                <?php
                                $percentageIncreaseFormatted = abs(round($percentageIncreaseCombined));
                                echo $percentageIncreaseCombined >= 0 ? "+$percentageIncreaseFormatted%" : "-$percentageIncreaseFormatted%";
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8"><?php echo $totalProspectsLastMonth; ?></div>

                            <div class="mt-1 text-base text-black">Last Month Prospect</div>
                        </div>
                    </div>
                </div>
            </a>

            <!--card for this month prospect-->
            <a class="transform hover:scale-105 transition duration-300 shadow rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-purple-300"
                href="this_month_prospect.php">
                <div class="p-5">
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <div class="<?php echo $percentageIncreaseSalesCombined >= 0 ? 'bg-green-500' : 'bg-red-500'; ?> rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                            <span class="flex items-center">
                                <?php
                                $percentageIncreaseFormatted = abs(round($percentageIncreaseSalesCombined));
                                echo $percentageIncreaseSalesCombined >= 0 ? "+$percentageIncreaseFormatted%" : "-$percentageIncreaseFormatted%";
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8"><?php echo $totalSalesCombinedCurrentMonth; ?></div>

                            <div class="mt-1 text-base text-gray-600">This Month Prospect</div>
                        </div>
                    </div>
                </div>
            </a>

            <!--card for yesterday prospect-->
            <a class="transform hover:scale-105 transition duration-300 shadow rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-red-300"
                href="yesterday_prospect.php">
                <div class="p-5">
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        <div
                            class="<?php echo $percentageIncreaseYesterday >= 0 ? 'bg-green-500' : 'bg-red-500'; ?> rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                            <span class="flex items-center">
                                <?php
                                $percentageIncreaseFormatted = abs(round($percentageIncreaseYesterday));
                                echo $percentageIncreaseYesterday >= 0 ? "+$percentageIncreaseFormatted%" : "-$percentageIncreaseFormatted%";
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8"><?php echo $totalProspectsCombinedYesterday; ?></div>

                            <div class="mt-1 text-base text-gray-600">Yesterday Prospect</div>
                        </div>
                    </div>
                </div>
            </a>

            <!--class for activa sales assistant-->
            <a class="transform hover:scale-105 transition duration-300 shadow rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-green-300"
                href="#">
                <div class="p-5">
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                        <div
                            class="bg-red-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                            <span class="flex items-center">Inactive SA : <?php echo $totalInactiveSA; ?></span>
                        </div>
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8"><?php echo $totalActiveSA; ?></div>

                            <div class="mt-1 text-base text-gray-600">Active Sales Assistant</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!--card for display chart-->
        <div class="grid mt-5">  
            <div class="grid md:grid-cols-2 gap-4">   
                <div class="flex-1 bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <div class="flex justify-between">
                    <div>
                        <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                            <?php echo $totalProspectsCombinedLastWeek; ?>
                        </h5>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Prospect this week</p>
                    </div>
                    <div class="flex items-center px-2.5 py-0.5 text-base font-semibold <?php echo $percentageIncreaseLastWeek < 0 ? 'text-red-500' : 'text-green-500'; ?> dark:text-green-500 text-center">
                    <?php
                        if ($percentageIncreaseLastWeek < 0) {
                            echo '-' . round(abs($percentageIncreaseLastWeek), 2);
                        } else {
                            echo '+' . round($percentageIncreaseLastWeek, 2);
                        }
                        ?>%
                        
                    </div>
                </div>
                <div id="area-chart"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                    <div class="flex justify-between items-center pt-5">
                        <a href="#"
                            class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                            Prospect Report
                            <svg class="w-2.5 h-2.5 ml-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!--card for display total prospect-->
            <div class="bg-white shadow md:grid-cols-2 rounded-lg p-4 sm:p-6 xl:p-8 ">
                     <div class="mb-4 flex items-center justify-between">
                        <div>
                           <h3 class="text-xl font-bold text-gray-900 mb-2">Total Prospect By Model</h3>
                           <span class="text-base font-normal text-gray-500">This is a list of all time prospect by model.</span>
                        </div>
                        <div class="flex-shrink-0">
                          
                        </div>
                     </div>
                     <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                           <div class="align-middle inline-block min-w-full">
                              <div class="shadow overflow-hidden sm:rounded-lg">
                                 <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                       <tr>
                                          <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                             Model
                                          </th>
                                          <th scope="col" class="p-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                             Total Lead
                                          </th>
                                          <th scope="col" class="p-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                             Percentage
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody class="bg-white">
                                       <!--row table for saga -->
                                            <tr>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                    Saga
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <?php echo $totalProspectsAllTimeSaga; ?>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <p><?php echo number_format($percentageSaga, 0); ?>%</p>
                                                </td>
                                            </tr>

                                            <!--row table for iriz-->
                                            <tr class="bg-gray-50">
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                    Iriz
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <?php echo $totalProspectsAllTimeIriz; ?>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <p><?php echo number_format($percentageIriz, 0); ?>%</p>
                                                </td>
                                            </tr>

                                            <!--row table for persona-->
                                            <tr>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                    Persona
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <?php echo $totalProspectsAllTimePersona; ?>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <p><?php echo number_format($percentagePersona, 0); ?>%</p>
                                                </td>
                                            </tr>

                                            <!--row table for s70-->
                                            <tr class="bg-gray-50">
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                    S70
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <?php echo $totalProspectsAllTimeS70; ?>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <p><?php echo number_format($percentageS70, 0); ?>%</p>
                                                </td>
                                            </tr>

                                            <!--row table for x50-->
                                            <tr>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                    X50
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <?php echo $totalProspectsAllTimeX50; ?>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <p><?php echo number_format($percentageX50, 0); ?>%</p>
                                                </td>
                                            </tr>

                                            <!--row table for x70-->
                                            <tr class="bg-gray-50">
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                    X70
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <?php echo $totalProspectsAllTimeX70; ?>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <p><?php echo number_format($percentageX70, 0); ?>%</p>
                                                </td>
                                            </tr>

                                            <!--row table for X90-->
                                            <tr>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900 rounded-lg rounded-left">
                                                    X90
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <?php echo $totalProspectsAllTimeX90; ?>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900 text-center">
                                                    <p><?php echo number_format($percentageX90, 0); ?>%</p>
                                                </td>
                                            </tr>

                                       
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>                                    
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<?php
    include 'controller/apexchart.php';
    include 'layout/footer.php';
?>

</body>

</html>