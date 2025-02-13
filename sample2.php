<style type="text/css">
	body{
		background-color: #202020;
	}

	div#container {
		height:500px;
		width:500px;
		border: #101010 1px solid;
		background-color: #2a2a2a;
		box-shadow: 1px 1px 10px #000;
	}

	div.a {
	width: 50px;
	height:50px;
	 background-color:red;
	position:fixed;
	    
	}
	div.b {
	width: 50px;
	height:50px;
	 background-color:blue;
	position:fixed;
	    
	}
	div.c {
	width: 50px;
	height:50px;
	 background-color:green;
	position:fixed;
	    
	}
</style>

<script src="jquery1.11.3.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	    animateDiv($('.a'));
	        animateDiv($('.b'));
	        animateDiv($('.c'));

	});

	function makeNewPosition($container) {

	    // Get viewport dimensions (remove the dimension of the div)
	    var h = $container.height() - 50;
	    var w = $container.width() - 50;

	    var nh = Math.floor(Math.random() * h);
	    var nw = Math.floor(Math.random() * w);

	    return [nh, nw];

	}

	function animateDiv($target) {
	    var newq = makeNewPosition($target.parent());
	    var oldq = $target.offset();
	    var speed = calcSpeed([oldq.top, oldq.left], newq);

	    $target.animate({
	        top: newq[0],
	        left: newq[1]
	    }, speed, function() {
	        animateDiv($target);
	    });

	};

	function calcSpeed(prev, next) {

	    var x = Math.abs(prev[1] - next[1]);
	    var y = Math.abs(prev[0] - next[0]);

	    var greatest = x > y ? x : y;

	    var speedModifier = 0.1;

	    var speed = Math.ceil(greatest / speedModifier);

	    return speed;

	}
</script>

<div id="container">
<div class='a'></div>
    <div class='b'></div>
    <div class='c'></div>
</div>