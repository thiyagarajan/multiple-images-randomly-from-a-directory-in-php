<?php

function RandomFile($folder='', $extensions='.*') {
    // fix path:
    $folder = trim($folder);
    $folder = ($folder == '') ? './' : $folder;

    // check folder:
    if (!is_dir($folder)) {
        die('invalid folder given!');
    }

    // create files array
    $files = array();

    // open directory
    if ($dir = @opendir($folder)) {

        // go trough all files:
        while ($file = readdir($dir)) {

            if (!preg_match('/^\.+$/', $file) and
                    preg_match('/\.(' . $extensions . ')$/', $file)) {

                // feed the array:
                $files[] = $file;
            }
        }
        // close directory
        closedir($dir);
    } else {
        die('Could not open the folder "' . $folder . '"');
    }

    if (count($files) == 0) {
        die('No files where found :-(');
    }

    // seed random function:
    mt_srand((double) microtime() * 1000000);

    // get an random index:
    $rand = mt_rand(0, count($files) - 1);

    // check again:
    if (!isset($files[$rand])) {
        die('Array index was not found! very strange!');
    }

    // return the random file:
    return $folder . "/" . $files[$rand];
}

$random1 = RandomFile("imagespath");
while (!$random2 || $random2 == $random1) {
    $random2 = RandomFile("imagespath");
}
while (!$random3 || $random3 == $random1 || $random3 == $random2) {
    $random3 = RandomFile("imagespath");
}
while (!$random4 || $random4 == $random1 || $random4 == $random2 || $random4 == $random3) {
    $random4 = RandomFile("imagespath");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head></head>
    <body>
        <div id="random_images">
            <img src="/<?php echo $random1; ?>" alt="image alt" />
            <img src="/<?php echo $random2; ?>" alt="image alt" />
            <img src="/<?php echo $random3; ?>" alt="image alt" />
            <img src="/<?php echo $random4; ?>" alt="image alt" />
        </div>
    </body>
</html>
