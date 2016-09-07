<?php
// get all directories and files in an array
$dir_contents = scandir('../xml/');
$csv_files = '';

foreach ($dir_contents as $element) {
    // if it's an xml file...
    if ( preg_match( '/\.xml$/', $element ) ) {
        // if it's the first xml file...
        if ( empty($csv_files) ) {
            // skip the comma
            $csv_files = $element;
        } else {
            // add the new xml file with a comma
            $csv_files .= ','.$element;
        }
    }
}

echo $csv_files;
?>