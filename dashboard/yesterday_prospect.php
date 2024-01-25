<?php
    include 'layout/header.php';
?>

<!-- Content -->
<div class="flex-1 p-8 sm:ml-64 mt-10">
    <!-- Myvi Page -->
    <section id="myvi" class="mb-8">
        <h2 class="text-xl font-semibold mb-4 mt-10"> 
            <?php
                $filename = basename($_SERVER['PHP_SELF']);
                $pageTitle = ucfirst(str_replace('.php', '', $filename));
                $pageTitle = str_replace('_', ' ', $pageTitle); // Replace underscores with spaces
                $pageTitle = ucwords($pageTitle); // Capitalize first letter of each word
                echo "$pageTitle";
            ?>
        </h2>
        <h1>This site in maintenance mode</h1>
    </section>
</div>