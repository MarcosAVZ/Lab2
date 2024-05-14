<?php
function display_pagination($current_page, $total_pages) {
    $range = 1; // Esto define cuántas páginas mostrar alrededor de la página actual

    // Mostrando el enlace a la primera página y puntos suspensivos si es necesario
    if ($current_page > 2) {
        echo "<a href='?page=1'>1</a> ";
        if ($current_page > 3) {
            echo "... ";
        }
    }

    // Mostrando los enlaces alrededor de la página actual
    for ($i = max(1, $current_page - $range); $i <= min($total_pages, $current_page + $range); $i++) {
        if ($i == $current_page) {
            echo "<strong>$i</strong> "; // página actual sin enlace
        } else {
            echo "<a href='?page=$i'>$i</a> ";
        }
    }

    // Mostrando puntos suspensivos y la última página si es necesario
    if ($current_page < $total_pages - 1) {
        if ($current_page < $total_pages - 2) {
            echo "... ";
        }
        echo "<a href='?page=$total_pages'>$total_pages</a>";
    }
}
?>
