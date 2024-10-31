<?php

function sanitize($conn, $string) {
    $string = stripslashes($string);               // Remove backslashes from the string
    $string = $conn->real_escape_string($string);  // Sanitize the string for the database
    return htmlentities($string);                  // Convert special characters to HTML entities
}

/* Notes
This function first removes any backslashes in the string using stripslashes, then sanitizes the string for use in a SQL statement using real_escape_string, and finally converts special characters to their corresponding HTML entities using htmlentities. This ensures that the string is safe for both database and HTML contexts.
*/

?>