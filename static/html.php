<?php
// pas encore utile
session_start();
echo "<html lang='fr' ";
if (isset($_SESSION['is_connected'])) {
    if ($_SESSION['id'] == 1) {
        echo "class='User1'";
    }
    elseif ($_SESSION['id'] == 2) {
        echo "class='User2'";
    }
    elseif ($_SESSION['id'] == 3){
        echo "class='User3'";
    }
    elseif ($_SESSION['id'] == 4) {
        echo "class='User4'";
    }
}
echo " >";
?>