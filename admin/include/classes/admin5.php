<?php
echo "PHP_ADMIN_5: Hit kommer vi <br>";

require_once '/app/public/projektarbete/project_ticket/includeAll/klasser/db.php';


if (isset($_COOKIE['arena_data'])) {
    echo "<h4> Arena Data </h4>";
    var_dump($_COOKIE['arena_data']);
}
if (isset($_COOKIE['section_data'])) {
    echo "<h4> Section data </h4>";
    var_dump($_COOKIE['section_data']);
}
if (isset($_COOKIE['row_data'])) {
    echo "<h4> Row Data </h4>";
    var_dump($_COOKIE['row_data']);
}
