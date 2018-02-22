<?php 
#########################################
## Functions
#########################################
function piWriteFile($my_post) {
    $www_path = dirname(dirname(__FILE__));
    if ( isset( $my_post['mode'] ) ) {
        if ( $my_post['mode'] == 'append' ) {
            file_put_contents($www_path.$my_post['file'], $my_post['string'], FILE_APPEND);
        } else {
            file_put_contents($www_path.$my_post['file'], $my_post['string']);
        }
    } else {
        file_put_contents($www_path.$my_post['file'], $my_post['string']);
    }
}

function piRunPythonScript($my_post) {
    $www_path = dirname(dirname(__FILE__));
    $cmd = 'python '.$www_path.'/'.$my_post['script'].' '.$my_post['args'].' >> '.$www_path.'/logs/website.log 2>>&1';
//    file_put_contents('out.log', $cmd.PHP_EOL, FILE_APPEND);
    file_put_contents($www_path.'/logs/website.log', $cmd.PHP_EOL, FILE_APPEND);
    //shell_exec('python '.$www_path.$my_post['script'].' '.$my_post['args'].' >>'.$www_path.'/logs/website.log 2>>&1');
}

function piGetHeaderMeasurements($my_post) {
    echo("<tr><td>".date('M j h:i:s A')."</td><td>Vdd: ".rand(800,1000)."mV</td><td>Vio: ".rand(1000,1500)."mV</td><td>Current: ".rand(0,500)."mA</td></tr>");
}

function piGetXmlFiles($my_post) {
    $www_path = dirname(dirname(__FILE__));
    // get all directories and files in an array
    $dir_contents = scandir($www_path.'/xml/');
    file_put_contents('out.log','www_path: '.$www_path.PHP_EOL,FILE_APPEND);
    file_put_contents('out.log','dir_contents: '.print_r($dir_contents, TRUE).PHP_EOL,FILE_APPEND);
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
}

#########################################
## Main
#########################################

$php_input = file_get_contents('php://input');
$pairs = explode( '&', $php_input );
foreach( $pairs as $pair ) {
    $key0_value1 = explode( '=', $pair, 2 );
    $my_post[$key0_value1[0]] = $key0_value1[1];
}
//file_put_contents('out.log','post: '.$php_input.PHP_EOL,FILE_APPEND);
//file_put_contents('out.log','pairs: '.print_r($pairs, TRUE).PHP_EOL,FILE_APPEND);
//file_put_contents('out.log','my_post: '.print_r($my_post, TRUE).PHP_EOL,FILE_APPEND);

call_user_func($my_post['function'], $my_post);
?>