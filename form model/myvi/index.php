<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prospect Form Myvi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a6ebcd5253.js" crossorigin="anonymous"></script>

    <!--script for microsoft clarity-->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "ijzptkax99");
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HVGXD18ZTY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-HVGXD18ZTY');
    </script>
</head>
<body class="bg-gray-100 p-4 md:p-0 flex items-center justify-center h-screen">
    <div class="max-w-sm w-full bg-white rounded-lg shadow-md p-6">
        <img src="https://www.perodua.com.my/assets/images/header_menu/perodua-logo.jpg" alt="Perodua Logo"
            class="w-48 mx-auto mb-4">
        <form action="controller/process_form.php" method="post">
            <label for="locationSA" class="block mb-2">Location:</label>
            <select name="locationSA" id="location" class="w-full p-2 border rounded" required>
                    <option value="" disabled selected>Select a state</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
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

            <label for="prosName" class="block mt-4 mb-2">Name:</label>
            <input type="text" name="prosName" class="w-full p-2 border rounded" required>

            <label for="prosNum" class="block mt-4 mb-2">Phone Number:</label>
            <input type="tel" name="prosNum" class="w-full p-2 border rounded" required
                   pattern="[0-9]{10,}" title="Please enter a valid phone number with at least 10 digits">

            <input type="hidden" name="assignedSalesperson" value="<?= isset($_SESSION['assignedSalesperson']) ? htmlspecialchars(json_encode($_SESSION['assignedSalesperson'])) : '' ?>">

            <button type="submit"
                class="block w-full bg-green-500 text-white font-bold py-3 px-4 mt-8 rounded hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-300"><i
                    class="fa-brands fa-whatsapp" id="ws-btn"></i> Whatsapp Now</button>
        </form>
    </div>
</body>
</html>
