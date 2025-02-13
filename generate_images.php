<?php session_start(); $_SESSION['GrpTtl']=1; ?>
<?php

$method = $_GET ?? [];

if (isset($method['generateFiles'])){
    $response = json_encode(returnimages());
    exit($response);
}
//This function gets the file names of all images in the current directory
//and ouputs them as a JavaScript array
function returnimages($dirname="./sampleimg") {
    $pattern="/^.*\.(jpg|png|jpeg|gif)$/i"; //valid image extensions
    $files = array();
    $curimage=0;
    if($handle = opendir($dirname)) {
        while(false !== ($ffile = readdir($handle))){
            if(preg_match($pattern, $ffile)){ //if this file is a valid image
                for($x=1;$x<$_SESSION['GrpTtl'];$x++){
                if(preg_match($pattern, $file = readdir($handle))){ //if this file is a valid image
                    //Output it as a JavaScript array element $curimage
                    $initialx=rand(-100, 1000);
                    $initialy=rand(-100, 500);
                    // echo '<img src="'.$dirname.'/'.$file.'" style="display:none;top:'.$initialy.'px;left:'.$initialx.'px;" class="slideimage" onclick="_moveup(this);" id="img_'.$curimage.'" grp="'.$x.'"/>';
                }}
                //Output it as a JavaScript array element $curimage
                $initialx=rand(-100, 1000);
                $initialy=rand(-100, 500);
                // echo '<img src="'.$dirname.'/'.$ffile.'" style="display:none;top:'.$initialy.'px;left:'.$initialx.'px;" class="slideimage" onclick="_moveup(this);" id="img_'.$curimage.'" grp="'.$_SESSION['GrpTtl'].'"/>';
                $curimage++;
                $files[] = $ffile;
            }
        }
        closedir($handle);
    }
    return($files);
}
// returnimages() //Output the array elements containing the image file names
?>