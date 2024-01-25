<?php
include 'controller/db.php';
$tableName = "x90Data"; //set table name here

//retrieve data from table
$sqlLead = "SELECT * FROM $tableName";
$resultLead = $conn->query($sqlLead);

// Update data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['formAction']) && $_POST['formAction'] === 'edit') {
    $id = $_POST['editFormId'];
    $name = $_POST['nameSA'];
    $phone = $_POST['phoneNum'];
    $location = $_POST['locationSA'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    if ($conn->query($sqlUpdate) === true) {
        // Update successful
        header("Location: " . $_SERVER["PHP_SELF"]); // Redirect to the same page
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<?php
    include 'layout/header.php';
?>
        <!-- Content -->
        <div class="flex-1 p-8 sm:ml-64 mt-10">
            <!-- x90 Page -->
            <section id="x90" class="mb-8">
            <h2 class="text-xl font-semibold mb-4 mt-10"> 
                    <?php
                        $filename = basename($_SERVER['PHP_SELF']);
                        $pageTitle = ucfirst(str_replace('.php', '', $filename));
                        $pageTitle = str_replace('_', ' ', $pageTitle); // Replace underscores with spaces
                        $pageTitle = ucwords($pageTitle); // Capitalize first letter of each word
                        echo "$pageTitle";
                    ?>
            </h2>
                <!-- Add SA Button (Top Right) -->
                <div class="flex items-center space-x-4 float-right">
         

                
                <!-- Second Table (Lead) -->
                <div class="mb-8 mt-10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">Prospect List</h3>
                        <div class="flex space-x-4">
                            <!-- HTML form for date filtering -->
                            <div class="flex items-stretch">
                            <div class="mb-4">
                            <label for="sa_filter" class="mr-2">Sales Agent:</label>
    <select id="sa_filter" name="sa_filter" class="px-3 py-2 border border-gray-300 rounded-md">
        <option value="">All</option> <!-- Default option to show all -->
        <!-- PHP code to populate the dropdown with Sales Agent names -->
        <?php
            $querySA = "SELECT DISTINCT saName FROM $tableName";
            $resultSA = $conn->query($querySA);

            while ($rowSA = $resultSA->fetch_assoc()) {
                echo "<option value='" . $rowSA["saName"] . "'>" . $rowSA["saName"] . "</option>";
            }
        ?>
    </select>

    <!-- dropdown selection for location-->
    <!--<label for="location_filter" class="mr-2">Location:</label>
    <select id="location_filter" name="location_filter" class="px-3 py-2 border border-gray-300 rounded-md">-->
        <!--<option value="">All</option>>--> <!-- Default option to show all -->
        <!-- PHP code to populate the dropdown with Sales Agent names -->
        <?php
            /*$queryLocation = "SELECT DISTINCT prosLocation FROM $tableName";
            $resultLocation = $conn->query($queryLocation);

            while ($rowLocation = $resultLocation->fetch_assoc()) {
                echo "<option value='" . $rowLocation["prosLocation"] . "'>" . $rowLocation["prosLocation"] . "</option>";
            }*/
        ?>
    </select>

    <label for="start_date" class="mr-2">Start Date:</label>
    <input type="date" id="start_date" name="start_date" class="px-3 py-2 border border-gray-300 rounded-md">
    <label for="end_date" class="ml-4 mr-2">End Date:</label>
    <input type="date" id="end_date" name="end_date" class="px-3 py-2 border border-gray-300 rounded-md">

    <button id="filter_btn" class="ml-4 float-right remove-filter bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-300">Apply Filter</button>
    <button id="print_btn" onclick="printTable()" class="ml-4 float-right remove-filter bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-teal-300"><i class="fa-solid fa-print" style="color: #ffffff;"></i><span class="pl-2">Print</span></button>
    <button id="clear_filter_btn" class="ml-4 float-right remove-filter bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-red-300" style="display: none;">Clear Filter</button>

</div>
 <!-- Add search input, date inputs, and sales agent dropdown here -->
   
                            </div>

                            
                        </div>
                    </div>
                    <!--- Filter Script -->
                    <script>
                        var filterButton = document.getElementById('filter_btn');
                        var clearFilterButton = document.getElementById('clear_filter_btn');
                        var mainPagination = document.getElementById('main_pagination'); // Replace with your actual ID

                        //script for filter button
                        filterButton.addEventListener('click', function() {
                            var startDate = document.getElementById('start_date').value;
                            var endDate = document.getElementById('end_date').value;
                            var saName = document.getElementById('sa_filter').value;
                            //var locationFilter = document.getElementById('location_filter').value;
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        document.getElementById('tablebody').innerHTML = xhr.responseText;
                                        document.getElementById('clear_filter_btn').style.display = "inline-block";
                                        mainPagination.style.display = 'none'; // Hide the main pagination when the filter is active
                                    } else {
                                        console.error('Error:', xhr.statusText);
                                    }
                                }
                            };

                            xhr.open('GET', 'filter_leads.php?table=' + <?php echo json_encode($tableName); ?> + '&start_date=' + startDate + '&end_date=' + endDate + '&sa_name=' + saName, true);
                            xhr.send();
                        });

                        //script for clear button filter
                        clearFilterButton.addEventListener('click', function() {

                            document.getElementById('start_date').value = '';
                            document.getElementById('end_date').value = '';
                            document.getElementById('sa_filter').value = '';
                            //document.getElementById('location_filter').value = '';
                            var saName = '';
                            var startDate = '';
                            var endDate = '';
                            var loacationFilter = '';

                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        document.getElementById('tablebody').innerHTML = xhr.responseText;
                                        document.getElementById('clear_filter_btn').style.display = "none";
                                        mainPagination.style.display = 'block'; // Show the main pagination when the filter is cleared
                                    } else {
                                        console.error('Error:', xhr.statusText);
                                    }
                                }
                            };

                            xhr.open('GET', 'filter_leads.php?table=' + <?php echo json_encode($tableName); ?> + '&start_date=' + startDate + '&end_date=' + endDate + '&sa_name=' + saName, true);
                            xhr.send();
                        });
                    </script>
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
                                    // Pagination settings
                                    $itemsPerPage = 15; // Number of leads to display per page

                                    // Calculate total number of pages
                                    $queryCount = "SELECT COUNT(*) as count FROM $tableName";
                                    $resultCount = $conn->query($queryCount);
                                    $rowCount = $resultCount->fetch_assoc()['count'];
                                    $totalPages = ceil($rowCount / $itemsPerPage);

                                    // Get current page from query parameter
                                    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                        $currentPage = intval($_GET['page']);
                                    } else {
                                        $currentPage = 1;
                                    }

                                    // Calculate the offset for the database query
                                    $offset = ($currentPage - 1) * $itemsPerPage;

                                    // Query the database to get the leads for the current page
                                    $query = "SELECT * FROM $tableName ORDER BY curDate DESC LIMIT $offset, $itemsPerPage";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr class='hover:bg-gray-200'>";
                                            echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosName"] . "</td>";
                                            echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosNum"] . "</td>";
                                            echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["prosLocation"] . "</td>";
                                            echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["saName"] . "</td>";
                                            echo "<td class='px-4 py-4 border-b border-gray-100'>" . $row["curDate"] . "</td>";        echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5' class='border px-4 py-2'>No results found.</td></tr>";
                                    }
                                ?>
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            <div id="pagination_container" class="flex justify-center flex-wrap mt-4">
                                <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                                    <a href="?page=<?php echo $page; ?>"
                                    class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700
                                        <?php echo ($page === $currentPage) ? 'bg-blue-500 text-white' : 'hover:bg-gray-200'; ?>
                                        transition mr-2 mb-2">
                                        <?php echo $page; ?>
                                    </a>
                                <?php endfor; ?>
                            </div>

                        </div>
                    </div>  
                    <!-- CSS for Print Media -->
                    <style media="print">
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }

                        th, td {
                            border: 1px solid black; /* Add border to each cell */
                            padding: 5px; /* Add padding for better readability */
                        }
                    </style>

                    <script>
                        function printTable() {
                            // Get the table container
                            var tableContainer = document.getElementById("table_container");

                            // Create a new window for printing
                            var printWindow = window.open('', '', 'width=600,height=600');

                            // Write the table content to the new window
                            printWindow.document.open();
                            printWindow.document.write('<html><head><title>x90 Prospect</title></head><body>');
                            printWindow.document.write('<h3>x90 Prospect</h3>');

                            printWindow.document.write('<style>');
                            printWindow.document.write('table { border-collapse: collapse; width: 100%; }');
                            printWindow.document.write('th, td { border: 1px solid black; padding: 5px; }');
                            printWindow.document.write('</style>');

                            printWindow.document.write('<div>');
                            printWindow.document.write(tableContainer.innerHTML);
                            printWindow.document.write('</div>');

                            printWindow.document.write('</body></html>');
                            printWindow.document.close();

                            // Print the new window
                            printWindow.print();
                            printWindow.close();
                        }
                    </script>
                </div>
            </section>
            <!-- Other car model sections here -->
        </div>
    </div>

<?php
    include 'layout/footer.php';
?>

</body>

</html>
