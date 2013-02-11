<?
$titleVDC = "VDC SAŠA";
require_once("head.php");
require_once('designClass.php');

$designClass = new designClass();
?>


</head>

<body onload=" document.forma.ajdi.focus(); setInterval('updateClock()', 200);get_date();">

    <div id="apDiv1">
        <div class="Datum" id="datum">...</div>
        <div class="Ura" id="clock"></div>
        <div><form action="action.php" method="get" enctype="application/x-www-form-urlencoded" name="forma"> <input name="ajdi" type="text" size="1" onKeyPress="return submitenter(this,event)" />


                <div class="Ikonce">
                <ul id="navlist">
<?php $nekaj = $designClass->buttons_with_condition(true, array('button_private_exit', 'button_lunch_exit', 'button_work_exit', 'button_final_exit')); ?>
</ul>
                </div>

                <input class="input" type="hidden" name="action"/>
            </form>
        </div>

        <div class="span-8">
            <div class="span-1">

            </div>
            <div class="push-5 last">

            </div>

        </div>
    </div>


</body>
</html>
