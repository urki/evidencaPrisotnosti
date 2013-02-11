<?
$titleVDC = "Nova kartica";
$DO_NOT_REDIRECT = "true";

require_once("head.php");
require_once("../intranetDevelop/inc/config.php");
$action = $_REQUEST["action"];
//$id = $_REQUEST["ajdi"];
$id = $_REQUEST["id"];
if (!$id) {
    // echo "sem prišel in id=$id";
    header("location:index.php");
}
?>
      <meta http-equiv="refresh" content="10;URL=index.php"charset=UTF-8/>
</head>

<body onload=" document.forma.ajdi.focus();">
    <div id="apDiv1">





        <form action="insert.php" method="get" enctype="application/x-www-form-urlencoded" name="forma">
            <div class="message">
                <div align="top">

                    <?php
                    $person = $dal->get_active_person_data_from_Rfid_by_rfid_disabled();
                    foreach ($person as $persons) {
                        if (!$persons[rfid] = 0) {

                            echo " <div align='left'><input type='radio'  name=groupSelect value='$persons[id_person]' onKeyPress='return submitenter(this,event)'>$persons[last] $persons[first]";
                            echo "</br>";
                            echo "</div>";
                        }
                    }

                    $action = $_REQUEST["action"];
                    if (!$action)
                        $action = "cancel";

                    if ($action) {
                        $action = "insert";
                        echo '<input type="hidden" name="rfid" value="' . $id . '">';
                    }
                    ?>
                </div>
            </div>
            <div class="span-8 messageTOP">
                <div class="span-1 ">
                    <button name="cancel" onClick="location.href='index.php'" type="button"><IMG src="close_512.png" width="75" height="84" border="0" alt="oops"></button>
                </div>
                <div class="push-5 last">
                    <button name="insert" value="insert" type="submit"><IMG src="entry.png" width="75" height="84" border="0"></button>
                </div>
            </div>

        </form>

    </div>
</body>
</html>

