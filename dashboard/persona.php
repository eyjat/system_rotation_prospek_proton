<?php
$tableName = "personaSA"; //set table name here
include 'controller/db.php';

//retrieve data from table
$sqlSaList = "SELECT * FROM $tableName";
$resultSaList = $conn->query($sqlSaList);

// Update data
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['formAction']) && $_POST['formAction'] === 'edit') {
    $id = $_POST['editFormId'];
    $name = $_POST['nameSA'];
    $phone = $_POST['phoneNum'];
    $location = $_POST['locationSA'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $sqlUpdate = "UPDATE $tableName SET
                  nameSA = '$name',
                  phoneNum = '$phone',
                  locationSA = '$location',
                  startDate = '$startDate',
                  endDate = '$endDate'
                  WHERE id = '$id'";

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
            <!-- Myvi Page -->
            <section id="myvi" class="mb-8 mt-10">
                <h2 class="text-xl font-semibold mb-4"> 
                    <?php
                        $filename = basename($_SERVER['PHP_SELF']);
                        $pageTitle = ucfirst(str_replace('.php', '', $filename));
                        $pageTitle = str_replace('_', ' ', $pageTitle); // Replace underscores with spaces
                        $pageTitle = ucwords($pageTitle); // Capitalize first letter of each word
                        echo "Sales Advisor - $pageTitle";
                    ?>
            </h2>
                <!-- Add SA Button (Top Right) -->
                <div class="flex items-center space-x-4 float-right">
         <!-- Search Field -->
        <div>
          	<form action="" method="GET">
            	<input type="text" name = "search_query" class="px-3 py-2 border border-gray-300 rounded-md" placeholder="Search...">
             	<!--<button type="submit">Search</button>-->
          </form>
        </div>
         <!-- Dropdown Filter   
        <div class="relative">
            <select class="px-3 py-2.5 border border-gray-300 rounded-md pr-8" onchange="filterTable(this.value)">
                <option value="all">All</option>
                <option value="active">Active</option>
                <option value="expired">Expired</option>
            </select>
        </div>-->
      
       
<?php
// Check if either filter_option or search_query is present in the URL
if (isset($_GET['filter_option']) || isset($_GET['search_query'])) {
?>
    <form method="GET">
        <button type="submit" name="clear_filter" class="float-right remove-filter bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-red-300">
            <svg class="w-5 h-5 inline-block mr-2 align-middle mt-0.5" fill="currentColor" viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.755 10.059a7.5 7.5 0 0112.548-3.364l1.903 1.903h-3.183a.75.75 0 100 1.5h4.992a.75.75 0 00.75-.75V4.356a.75.75 0 00-1.5 0v3.18l-1.9-1.9A9 9 0 003.306 9.67a.75.75 0 101.45.388zm15.408 3.352a.75.75 0 00-.919.53 7.5 7.5 0 01-12.548 3.364l-1.902-1.903h3.183a.75.75 0 000-1.5H2.984a.75.75 0 00-.75.75v4.992a.75.75 0 001.5 0v-3.18l1.9 1.9a9 9 0 0015.059-4.035.75.75 0 00-.53-.918z" clip-rule="evenodd" />
            </svg>
            Remove Filter
        </button>
    </form>
<?php
}
?>
        <a href="add_sa.php?car=<?php echo basename(__FILE__, '.php'); ?>" ><button class="add-sa-button bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded float-right focus:outline-none focus:ring focus:ring-blue-300">
            <svg class="w-5 h-5 inline-block mr-2 align-middle mt-0.5" fill="currentColor" viewBox="0 0 28 28"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
            </svg>
                    Add SA
                </button></a>
                </div>
                <!-- First Table (SA List) -->
                <div class="mb-6 mt-10">
                    <h3 class="text-lg font-semibold mb-2">SA List</h3>
                    <div class="bg-white p-6 shadow-md rounded-xl">
                        <table class="table-fixed w-full">
                            <thead class="text-gray-800 bg-gray-100">
                                <tr>
                                    <th class="px-4 py-4 text-left">SA Name</th>
                                    <th class="px-4 py-4 text-left">WhatsApp Link</th>
                                    <th class="px-4 py-4 text-left">Location</th>
                                    <th class="px-4 py-4 text-left">Start Date</th>
                                    <th class="px-4 py-4 text-left">Expired Date</th>
                                    <th class="px-2 py-4 w-50px text-center">Status</th>
                                    <th class="px-2 py-4 w-10 text-center rounded-tr-lg rounded-br-lg"></th>
                                </tr>
                            </thead>
                            <tbody>                            
                                <tr class="hover:bg-gray-200">
                                    <!-- php for filter active or expired SA -->
                                    <?php
                                        include 'controller/db-bin.php';

                                        // Check if the filter_option parameter is set
                                        if (isset($_GET['filter_option'])) {
                                            $filterOption = $_GET['filter_option'];

                                            if ($filterOption === 'active') {
                                                // Modify your SQL query to filter for active records
                                                $sql = "SELECT * FROM $tableName WHERE endDate >= CURDATE()";
                                            } elseif ($filterOption === 'expired') {
                                                // Modify your SQL query to filter for expired records
                                                $sql = "SELECT * FROM $tableName WHERE endDate < CURDATE()";
                                            }
                                        } else {
                                            // Default query to fetch all data from the database
                                            $sql = "SELECT * FROM $tableName ORDER BY endDate ASC";
                                        }

                                        // Check if the search_query parameter is set
                                        if (isset($_GET['search_query'])) {
                                            $searchQuery = $_GET['search_query'];

                                            // Modify the existing SQL query to include the search condition
                                            if (isset($sql)) {
                                                $sql = "SELECT * FROM $tableName WHERE nameSA LIKE '%$searchQuery%' ORDER BY endDate ASC";
                                            } else {
                                                $sql = "SELECT * FROM $tableName";
                                            }
                                        }

                                        // If no filter or search conditions are set, use the default query
                                        if (!isset($sql)) {
                                            $sql = "SELECT * FROM $tableNameSA";
                                        }

                                        // Calculate the total number of pages
                                        //$totalPages = ceil($resultSaList->num_rows / $recordsPerPage);

                                        // Calculate the starting and ending page numbers
                                        /*$visiblePages = 1; // Number of visible pagination links
                                        $halfVisible = floor($visiblePages / 2);
                                        $startPage = max(1, $currentPage - $halfVisible);
                                        $endPage = min($totalPages, $startPage + $visiblePages - 1);

                                        // Pagination settings
                                        $recordsPerPage = 50; // Number of records to display per page
                                        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

                                        // Calculate the OFFSET for the SQL query
                                        $offset = ($currentPage - 1) * $recordsPerPage;

                                        // Modify your SQL query to include LIMIT and OFFSET for pagination
                                        $sql = "$sql LIMIT $recordsPerPage OFFSET $offset";*/

                                        $resultSaList = $connection->query($sql);

                                        if ($resultSaList->num_rows > 0) {
                                            while ($row = $resultSaList->fetch_assoc()) {
                                                echo "<tr class='hover:bg-gray-200'>";
                                            
                                                echo "<td class='bpy-4 px-4 border-b border-gray-100'>" . $row["nameSA"] . "</td>";
                                                echo "<td class='py-4 px-4 border-b border-gray-100'>" . $row["phoneNum"] . "</td>";
                                                echo "<td class='py-4 px-4 border-b border-gray-100'>" . $row["locationSA"] . "</td>";
                                                echo "<td class='py-4 px-4 border-b border-gray-100'>" . $row["startDate"] . "</td>";
                                                echo "<td class='py-4 px-4 border-b border-gray-100'>" . $row["endDate"] . "</td>";
                                                
                                                echo '<td class="py-4 px-2 text-center border-b border-gray-100">';
                                                if (strtotime($row['endDate']) >= strtotime(date("Y-m-d"))) {
                                                    // Row is active
                                                    echo '<span class="inline-block px-2 py-1 text-sm font-semibold leading-none bg-green-500 text-white rounded">Active</span>';
                                                } else {
                                                    // Row is inactive
                                                    echo '<span class="inline-block px-2 py-1 text-sm font-semibold leading-none bg-red-500 text-white rounded">Inactive</span>';
                                                }
                                                echo '</td>';
                                                
                                                echo '<td class="py-4 px-2 mb-2 text-center border-b border-gray-100">';
                                                echo '<a class="edit-sa-button" onclick="openEditPopupForm(' . $row['id'] . ', \'' . $row['nameSA'] . '\', \'' . $row['phoneNum'] . '\', \'' . $row['locationSA'] . '\', \'' . $row['startDate'] . '\', \'' . $row['endDate'] . '\')">'; // Assuming you have the data available in $row
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="edit-sa-button w-4 h-4 text-gray-600 hover:text-blue-500 cursor-pointer">';
                                                echo '<path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />';
                                                echo '<path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />';
                                                    echo '</svg>';
                                                echo '</a>';
                                                
                                                echo '<a href="controller/delete_script.php?id=' . $row['id'] . '&table=' . $tableName . '" class="text-red-600 hover:text-red-800 mr-2" onclick="return confirmDelete();">';
                                                echo '<svg class="w-5 h-5 inline-block mr-2 align-middle mt-0.5" fill="currentColor" viewBox="0 0 28 28" xmlns="http://www.w3.org/2000/svg">';
                                                echo '<path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />';
                                                echo '</svg>';
                                                echo '</a>';
                                                echo '</td>';
                                                
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6' class='py-4 px-4 border-b border-gray-100'>No users found.</td></tr>";
                                        }

                                        $connection->close();
                                    ?>

                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination Nav -->
                        <?php                  
                            // Display pagination links
                            /*echo '<nav class="flex justify-end mt-4">';
                            echo '<ul class="flex items-center">';

                            // Previous page link
                            if ($currentPage > 1) {
                                echo '<li class="mr-2">';
                                echo '<a href="?search_query=' . $_GET['search_query'] . '&&page=' . ($currentPage - 1) . '" class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">Previous</a>';
                                echo '</li>';
                            }

                            // Loop through pages
                            for ($i = $startPage; $i <= $endPage; $i++) {
                                $isActive = ($i == $currentPage) ? ' border border-blue-500 bg-blue-500 text-white' : ' border border-gray-300';

                                echo '<li class="mr-2">';
                                echo '<a href="?search_query=' . $_GET['search_query'] . '&&page=' . $i . '" class="block rounded-md px-3 py-1 text-sm' . $isActive . '">' . $i . '</a>';
                                echo '</li>';
                            }

                            // Next page link
                            if ($currentPage < $totalPages) {
                                echo '<li class="mr-2">';
                                echo '<a href="?search_query=' . $_GET['search_query'] . '&&page=' . ($currentPage + 1) . '" class="block border border-gray-300 rounded-md px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">Next</a>';
                                echo '</li>';
                            }

                            echo '</ul>';
                            echo '</nav>';*/
                        ?>
                       
                        <!--script for filter active or expired SA-->
                        <script>
                            function filterTable(filterOption) {
                                // Redirect to the same page with the filter option as a query parameter
                                window.location.href = 'myvi.php?filter_option=' + filterOption;
                            }
                        </script>

                        

                    </div>
                </div>

                
            </section>
            <!-- Other car model sections here -->
        </div>
    </div>



<!-- Edit Popup Form -->
<div id="editpopupForm"
    class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <div class="flex justify-end">
            <button class="text-gray-600 hover:text-gray-800 focus:outline-none"
                onclick="closeEditPopupForm()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <h3 class="text-xl font-semibold mb-4">Update SA Details</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="hidden" name="formAction" value="edit">
            <input type="hidden" id="editFormId" name="editFormId" value="">
            <!-- SA Name -->
            <div class="mb-4">
                <label for="nameSA" class="block text-sm font-medium text-gray-700">SA Name</label>
                <input type="text" id="nameSA" name="nameSA" class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300" value="">
            </div>
            <!-- Whatsapp Link -->
            <div class="mb-4">
                <label for="phoneNum" class="block text-sm font-medium text-gray-700">Whatsapp Link</label>
                <input type="text" id="phoneNum" name="phoneNum" class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300">
            </div>
            <!-- Location Dropdown -->
            <div class="mb-4">
                <label for="locationSA" class="block text-sm font-medium text-gray-700">Location</label>
                <select id="locationSA" name="locationSA"
                    class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300">
                    <option value="">Select Location</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Pulau Pinang">Pulau Pinang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Putrajaya">Putrajaya</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                </select>
            </div>
            <!-- Start Date -->
            <div class="mb-4">
                <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" id="startDate" name="startDate" class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300" min="2023-01-01">
            </div>
            <!-- Expired Date -->
            <div class="mb-4">
                <label for="endDate" class="block text-sm font-medium text-gray-700">Expired Date</label>
                <input type="date" id="endDate" name="endDate" class="mt-1 focus:ring focus:ring-blue-300 block w-full rounded-md py-2 px-3 border border-gray-300" min="2023-01-01">
            </div>
            <div class="mt-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 w-full rounded focus:outline-none focus:ring focus:ring-blue-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function openEditPopupForm(id, name, phone, location, startDate, endDate) {
    console.log("Received data:", id, name, phone, location, startDate, endDate); // Debug: Check received data
    const editpopupForm = document.getElementById('editpopupForm');
    const editFormId = document.getElementById('editFormId');
    const nameSA = document.getElementById('nameSA');
    const phoneNum = document.getElementById('phoneNum');
    const locationSA = document.getElementById('locationSA');
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    
    console.log("Form elements:", editFormId, nameSA, phoneNum, locationSA, startDateInput, endDateInput); // Debug: Check form elements
    
    editFormId.value = id;
    nameSA.value = name;
    phoneNum.value = phone;
    locationSA.value = location;
    startDateInput.value = startDate;
    endDateInput.value = endDate;
    
    console.log("Form values:", editFormId.value, nameSA.value, phoneNum.value, locationSA.value, startDateInput.value, endDateInput.value); // Debug: Check assigned form values
    
    editpopupForm.classList.remove('hidden');
}


    function closeEditPopupForm() {
        const editpopupForm = document.getElementById('editpopupForm');
        editpopupForm.classList.add('hidden');
    }
</script>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this row?");
    }
</script>




<?php
    include 'layout/footer.php';
?>

</body>

</html>
