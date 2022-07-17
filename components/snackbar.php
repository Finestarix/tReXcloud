<?php
if (isset($_SESSION["MESSAGE"])) {
    ?>
    <div id="snackbar"
         class="border border-1 border-white w-full text-white p-3 lg:pl-8 <?= ($_SESSION["MESSAGE_TYPE"] === "error") ? "bg-red-600" : "bg-green-600" ?>">
        <div class="flex flex-row items-center">
            <div class="text-xl mr-2">
                <?php
                if ($_SESSION["MESSAGE_TYPE"] === "error") {
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/>
                    </svg>
                    <?php
                } else {
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                    </svg>
                    <?php
                }
                ?>
            </div>
            <div class="">
                <?= $_SESSION["MESSAGE"] ?>
            </div>
        </div>
    </div>

    <script>
        $("#snackbar").delay(7000).slideUp();
    </script>

    <?php
    unset($_SESSION["MESSAGE"]);
    unset($_SESSION["MESSAGE_TYPE"]);
}
?>
