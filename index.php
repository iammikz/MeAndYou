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


<style type="text/css">
    .slideimage{
        position: absolute;
        max-width:400px;
        max-height:400px;
        width: auto;
        height: auto;
    }

    body{
        overflow: hidden;
        white-space:nowrap;
        background-color: #303030;
    }

    body #rndThumbs{
        /*overflow: hidden;*/
        width:100%;
        height: 200px;
    }

    img:not(#largeimg){
        box-shadow: 1px 2px 20px #000;
        border-radius: 20px;
    }

    body #showimage{
        /* top:50%;
        left:50%;
        margin-right:-50%;
        transform: translate(-50%, -50%); */
        position: absolute;
        /* padding: 10px; */
        padding: 5vh 5vw 5vh 5vw;
        display: none;
        /* width: 80%;
        height: 80%; */
        width: 100%;
        height: 100%;
        z-index: 100;
        /* box-shadow: 1px 2px 20px #000; */
        /* border-radius: 20px; */
        overflow: hidden;
        /* background-color: rgba(136,136,136,.5); */
        background-color: transparent;
    }

    #largeimg{
        top:50%;
        left:50%;
        margin-right:-50%;
        transform: translate(-50%, -50%);
        position: relative;
        display: block;
        max-width:100%;
        width: auto;
        height: 80%;
        border-radius: 20px;
    }

    .DivBlurred{
        -webkit-filter: blur(5px);
        -moz-filter: blur(5px);
        -ms-filter: blur(5px);
        -o-filter: blur(5px);
        filter: blur(5px);
    }
</style>

<script src="jquery1.11.3.js"></script>

<script type="text/javascript">
    let isFrameOpen = false;

    $(document).ready(function() {

        timer=setInterval(function () {
            if($('#visas_style_div').length>0){
                $('#visas_style_div').remove();
            }else{
                clearInterval(timer);
            }
        }, 1000);

        var grpindex=$('img[grp="1"]').length;
        for($x=0;$x<=grpindex;$x++){
            moveit_rand($('#img_'+$x+'[grp="1"]'),0);
        }
	});

    function calcSpeed(prev, next) {
        var x = Math.abs(prev[0] - next[0]);
        var y = Math.abs(prev[1] - next[1]);
        var greatest = x > y ? x : y;
        var speedModifier = 0.07;
        var speed = Math.ceil(greatest / speedModifier);
        return speed;
    }



	function moveit_rand(tempval,toggleval) {
        var wh=window.innerHeight-400;
        var ww=window.innerWidth-400;
	    var newTop = Math.floor(Math.random()*wh) +1;
	    var newLeft = Math.floor(Math.random()*ww) +1;
        var newDuration=calcSpeed([tempval.offset()?.left,tempval.offset()?.top],[newLeft,newTop]);
	    var zindex=Math.floor(Math.random()*50);
        var gindex=parseInt($(tempval).attr('grp'));
        var grpshow=(gindex>=<?php echo $_SESSION['GrpTtl'] ?> ? 1 : (gindex+1));
        var tempid=$(tempval).attr('id');
	    tempval.css('zIndex',zindex);
	    tempval.animate({
	      top: newTop,
	      left: newLeft,
          opacity:'toggle',
	      }, newDuration, function() {
            if(toggleval){
            var grpindex=$('img[grp="'+grpshow+'"]').length;
            if($('#'+tempid+'[grp="'+grpshow+'"]').length){
               moveit_rand($('#'+tempid+'[grp="'+grpshow+'"]'),0);
            }//else if elem(img_x+1) exist
            }else{
	           moveit_rand(tempval,1);
            }
	      });
	}

	function _moveup(tempval){
		$img=$(tempval).attr('src');
        $('#largeimg').attr('src',$img);
        $('#showimage').css('display','block');
        $('#rndThumbs').addClass('DivBlurred');
        isFrameOpen = true;
        console.log('open');
	}

    function _closewnd(sender){
        if (isFrameOpen==true){
            $('#showimage').css('display','none');
            $('#rndThumbs').removeClass('DivBlurred');
            isFrameOpen = false;
            console.log('closing from '+sender);
        }
    }

    function getImages(){
        const testFolder = './tests/';
        const fs = require('fs');

        fs.readdir(testFolder, (err, files) => {
        files.forEach(file => {
            console.log(file);
        });
        });
    }
</script>

<!DOCTYPE html>
<html>
<head>
	<title>Happy Valentines Honey</title>
</head>
<body>
<div id="showimage" class="imageviewer" style="display:none;" onclick="_closewnd('viewer');">
    <div id="wnd">
        
    </div>
    <img id="largeimg" src="">
</div>
<div id="rndThumbs">
    <!-- // images -->
</div>
</body>
</html>

