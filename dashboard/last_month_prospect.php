<?php
    include 'controller/db.php'; //connection database
    $tableName = "bezzaData"; //set table name here
    
    //retrieve data from table
    $sqlLead = "SELECT * FROM $tableName";
    $resultLead = $conn->query($sqlLead);

    include 'layout/header.php';
?>

<html>
    <body>
        <!-- Content -->
        <div class="flex-1 p-8 sm:ml-64 mt-10">
            <!-- Last Month Prospect Listing -->
            <section id="last-month_prospect" class="mb-8">
                <h3 class="text-xl font-semibold mb-4 mt-10">Last Month Prospect List</h3>
                <h1>This site in maintenance mode</h1>

                <div class="mb-8 mt-10">
                        <div class="flex justify-between items-center mb-4">
                                <div class="flex space-x-4">

                                    <!-- HTML form for date filtering -->
                                    <div class="flex items-stretch">
                                    <div class="mb-4">
                                        
                                    <label for="sa_filter" class="mr-2">Month :</label>
                                    <select id="sa_filter" name="sa_filter" class="px-3 py-2 border border-gray-300 rounded-md">
                                        <option value="">All</option> <!-- Default option to show all -->
                                        <option value="">Januari</option>
                                        <!-- PHP code to populate the dropdown with Sales Agent names -->
                                        <?php
                                            // $querySA = "SELECT DISTINCT saName FROM $tableName";
                                            // $resultSA = $conn->query($querySA);

                                            // while ($rowSA = $resultSA->fetch_assoc()) {
                                            //     echo "<option value='" . $rowSA["saName"] . "'>" . $rowSA["saName"] . "</option>";
                                            // }
                                        ?>
                                    </select>

                                    <!-- dropdown selection for location-->
                                    <label for="location_filter" class="mr-2">Year :</label>
                                    <select id="location_filter" name="location_filter" class="px-3 py-2 border border-gray-300 rounded-md">
                                        <option value="">All</option> <!-- Default option to show all -->
                                        <!-- PHP code to populate the dropdown with Sales Agent names -->
                                        <?php
                                            // $queryLocation = "SELECT DISTINCT prosLocation FROM $tableName";
                                            // $resultLocation = $conn->query($queryLocation);

                                            // while ($rowLocation = $resultLocation->fetch_assoc()) {
                                            //     echo "<option value='" . $rowLocation["prosLocation"] . "'>" . $rowLocation["prosLocation"] . "</option>";
                                            // }
                                        ?>
                                    </select>

                                    <!--<label for="start_date" class="mr-2">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="px-3 py-2 border border-gray-300 rounded-md">

                                    <label for="end_date" class="ml-4 mr-2">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="px-3 py-2 border border-gray-300 rounded-md">-->

                                    <button id="filter_btn" class="ml-4 float-right remove-filter bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-300">Apply Filter</button>

                                    <button id="print_btn" onclick="printTable()" class="ml-4 float-right remove-filter bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-teal-300"><i class="fa-solid fa-print" style="color: #ffffff;"></i><span class="pl-2">Print</span></button>

                                    <button id="clear_filter_btn" class="ml-4 float-right remove-filter bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-red-300" style="display: none;">Clear Filter</button>
                        
                                </div>
                        </div>
                </div>
        </div>

        <div class="bg-white p-6 shadow-md rounded-2xl overflow-hidden">
            <div id="table_container">
                <table class="table-fixed w-full">
                    <thead class="text-gray-800 bg-gray-100">
                        <tr>
                            <th class="px-3 py-4 text-left rounded-tl-xl rounded-bl-xl">Name</th>
                            <th class="px-4 py-3 text-left">Phone No.</th>
                            <th class="px-4 py-3 text-left">Location</th>
                            <th class="px-4 py-3 text-left">SA Name</th>
                            <th class="px-2 py-4 text-left rounded-tr-xl rounded-br-xl">Date</th>
                        </tr>
                    </thead>
                    <tbody id = "tablebody">     
                    <!--php for  display all lead-->
                    
                    <?php
                    //     // Pagination settings
                    //     $itemsPerPage = 15; // Number of leads to display per page

                    //     // Calculate total number of pages
                    //     $queryCount = "SELECT COUNT(*) as count FROM $tableName";
                    //     $resultCount = $conn->query($queryCount);
                    //     $rowCount = $resultCount->fetch_assoc()['count'];
                    //     $totalPages = ceil($rowCount / $itemsPerPage);

                    //     // Get current page from query parameter
                    //     if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                    //         $currentPage = intval($_GET['page']);
                    //     } else {
                    //         $currentPage = 1;
                    //     }

                    //     // Calculate the offset for the database query
                    //     $offset = ($currentPage - 1) * $itemsPerPage;

                    //     // Query the database to get the leads for the current page
                    //     $query = "SELECT * FROM $tableName ORDER BY curDate DESC LIMIT $offset, $itemsPerPage";
                    //     $result = $conn->query($query);

                    //     if ($result->num_rows > 0) {
                    //         while ($row = $result->fetch_assoc()) {
                    //             echo "<tr class='hover:bg-gray-200'>";
                    //             echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosName"] . "</td>";
                    //             echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosNum"] . "</td>";
                    //             echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosLocation"] . "</td>";
                    //             echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["saName"] . "</td>";
                    //             echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["curDate"] . "</td>";        echo "</tr>";
                    //         }
                    //     } else {
                    //         echo "<tr><td colspan='5' class='border px-4 py-2'>No results found.</td></tr>";
                    //     }
                    // ?>
                    </tbody>
                </table>
            </div>
        </div>  
    </body>
</html>