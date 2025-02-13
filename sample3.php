<style type="text/css">
    #parent {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0%;
        left: 0%
    }

    img {
        height: 100%;
        width: 100%;
        white-space: nowrap;
    }

    #past, #future {
        position: absolute;
        height: 50%;
        width:25%;
        left:0%;
        top:0%;
        overflow: hidden;
        white-space: nowrap;
    }

    #past {
        left:25%;
        text-align: left;
        direction: ltr;
    }

    #future {
        text-align: right;
        direction: rtl;
    }
</style>

<div id="parent">
    <div id="past">
        <img id="topic1" src="./sampleimg/Dissidia.full.1333962.jpg"></img>
        <img id="topic2" src="./sampleimg/Dissidia.full.1333962.jpg"></img>
        <img id="topic3" src="./sampleimg/Dissidia.full.1333962.jpg"></img>
    </div>
    <div id="future">
        <img id="topic1a" src="./sampleimg/Dissidia.full.1333962.jpg"></img>
        <img id="topic2b" src="./sampleimg/Dissidia.full.1333962.jpg"></img>
    </div>
</div>