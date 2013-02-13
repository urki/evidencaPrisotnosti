<?php
$titleVDC = "VDC SAŠA";
require_once("head.php");
require_once('designClass.php');
require_once ('localClass.php');


$localClass = new localClass();
$designClass = new designClass();
$action = $_REQUEST["action"];
$id = $_REQUEST["ajdi"];
?>
<meta http-equiv="refresh" content="8;URL=index.php"charset=UTF-8/>

</head>
<body onload=" document.forma.ajdi.focus();">

    <div  id="apDiv1">
        <div class="Ikonce">
            <ul id="navlist">
                <?php $nekaj = $designClass->buttons_with_condition(true, array('button_private_exit', 'button_lunch_exit', 'button_work_exit', 'button_final_exit')); ?>
            </ul>
        </div>
        <div>
            <form autocomplete="off" border="0" action="action.php" method="get" enctype="application/x-www-form-urlencoded" name="forma">
                <input name="ajdi" type="text" size="1" onKeyPress="return submitenter(this,event)" />

                <?php
                if ($action) {
                    echo '<input type="hidden" name="action" value="' . $action . '">';
                } else {
                    if (!$id) {
                        $data = array(
                            'person_id' => 'neznan',
                            'rfid' => 'no rfid',
                            'jobtype_id' => 'prihod',
                            'note' => 'ni zaznal kartice'
                        );
                        $db->insert('RfidRawLogError', $data);

                        header("location: error/message.php?msg=Kartica ne dela.");
                    }

                    $action = "prihod";
                }
                ?>
            </form>
        </div>
        <div>
            <div class="span-3">
                <?php $nekaj = $designClass->buttons_with_condition(true, array('button_cancel_main')); ?>
            </div>
        </div>
        <div class="message">
            <div align="center">

                <?php
                if ($id and $action) {

                    $person = $dal->get_active_person_data_from_Rfid_by_rfid_status($id, 'active');
                    $person = $person[0];
                    if (!$person) {
                        if ($action == "odhod") {
                            //echo "Nov Vnos!!!!";
                            header("location: insert_new.php?id=$id");
                            //exit;
                        } else {
                            $data = array(
                                'person_id' => 'neznan',
                                'rfid' => $id,
                                'jobtype_id' => $action,
                                'note' => 'Kartice ne pozna'
                            );
                            $db->insert('RfidRawLogError', $data);

                            header('location: error/message.php?msg=Še enkrat poskusiva saj kartice NE PREPOZNAM.');
                            // echo "Kartica je neveljavna!";
                            //exit;
                        }
                    }

                    //then we need to submit the prihod
                    $SameAction = $dal->get_data_from_rfidrawlog_by_person($person[person_id]);

                    $SameAction = $SameAction[0];
                    $prej = strtotime($SameAction[timestamp]);
                    $zdaj = strtotime(date("Y-m-d H:i:s"));
                    $rezultat = $zdaj - $prej;

                    if ($rezultat < 8) {
                        $data = array(
                            'person_id' => $person[person_id],
                            'rfid' => $id,
                            'jobtype_id' => $action,
                            'note' => '8 sekund'
                        );
                        $db->insert('RfidRawLogError', $data);

                        header('location: error/message.php?msg= Opozorilo: preteči mora vsaj 8 sec za vaš ponovni vnos');
                        //  header('location: index.php');
                        exit;
                    }



                    switch ($SameAction[action]) {
                        case ('odhod'):
                            //last was go home so now is job start and we can use as start JOB
                            if ($action == 'prihod') {
                                $logJobTypeId = 1;
                                $logJobTypeStart = TRUE;
                                $insertAlow = TRUE;
                            } else {
                                $insertAlow = FALSE;
                                $napake = $localClass->error1($SameAction[action]);
                            }
                            break;
                        case ('privat izhod'):
                            if ($action == 'prihod') {
                                $logJobTypeId = 3;
                                $logJobTypeStart = false;
                                $insertAlow = TRUE;
                            } else {
                                $insertAlow = FALSE;
                                $napake = $localClass->error1($SameAction[action]);
                            }
                            break;

                        case ('kosilo'):
                            if ($action == 'prihod') {
                                $logJobTypeId = 27;
                                $logJobTypeStart = FALSE;
                                $insertAlow = TRUE;
                            } else {
                                $insertAlow = FALSE;
                                $napake = $localClass->error1($SameAction[action]);
                            }
                            break;

                        case ('izhod služba'):
                            if ($action == 'prihod') {
                                $logJobTypeId = 19;
                                $logJobTypeStart = FALSE;
                                $insertAlow = TRUE;
                            } else {
                                $insertAlow = FALSE;
                                $napake = $localClass->error1($SameAction[action]);
                            }
                            break;

                        case ('prihod'):
                            if ($action <> 'prihod') {

                                $logJobTypeStart = TRUE;
                                $insertAlow = TRUE;
                                switch ($action) {

                                    case 'izhod služba':
                                        $logJobTypeId = 19;
                                        break;
                                    case 'kosilo':
                                        $logJobTypeId = 27;
                                        break;
                                    case 'privat izhod':
                                        $logJobTypeId = 3;
                                        break;
                                    case 'odhod':
                                        $logJobTypeId = 1;
                                        $logJobTypeStart = false;
                                        break;
                                    default:
                                        header('location: error/message.php?msg=Napaka: Javite administratorju!');
                                        break;
                                }
                            } else {
                                $insertAlow = FALSE;
                                $data = array(
                                    'person_id' => $person[person_id],
                                    'rfid' => $id,
                                    'jobtype_id' => $action,
                                    'note' => 'Za odhodom ne more biti spet odhod'
                                );
                                $db->insert('RfidRawLogError', $data);

                                header('location: error/message.php?msg=Opozorilo:   Za PRIHODOM ne more biti zopet ' . $action . '!');
                                // exit;
                            }
                            break;
                        default:
                            if ($action == 'prihod') {
                                $insertAlow = TRUE;
                                $logJobTypeId = 1;
                                $logJobTypeStart = TRUE;
                            } else {
                                $insertAlow = FALSE;
                                $data = array(
                                    'person_id' => $person[person_id],
                                    'rfid' => $id,
                                    'jobtype_id' => $action,
                                    'note' => 'Za odhodom ne more biti spet odhod'
                                );
                                $db->insert('RfidRawLogError', $data);

                                header('location: error/message.php?msg=Opozorilo:   Za odhodom - ' . $SameAction[action] . ' mora biti naprej prihod!');
                                // exit;
                            }

                            break;
                    }

                    if ($insertAlow == TRUE) {

                        $data = array(
                            'person_id' => $person[person_id], //name_drop sem zamenjal z user_id saj se avtomatsko...
                            'action' => $action
                        );

                        $db->insert('RfidRawLog', $data);
//Get person first and last name
                        if ($logJobTypeStart == TRUE) {
                            //$end = 0;
                            $start = $zdaj;
                            $end = $zdaj + (3600 * 10);
                            $data = array(
                                'person_id' => $person[person_id],
                                'jobtype_id' => $logJobTypeId,
                                'start' => $start,
                                'end' => $end,
                                'note' => 'prihod zapisal fa99'
                            );
                            $db->insert('log', $data);
                            header("location: error/message.php?msg=$person[first] $person[last] -> $action");
                        } else {
                            $end = $zdaj;
                            //  $najdistevilko=$dal->get_data_from_log_by_job_and_person_and_modified($logJobTypeId	,$person[person_id],"='rfid(start)'");
                            $najdistevilko = $dal->get_data_from_log_by_job_and_person_and_modified($logJobTypeId, $person[person_id], "='prihod zapisal fa99'"); //,'rfid(start)');
                            // $najdistevilko=$dal->get_data_from_log_by_job_and_person_and_modified($logJobTypeId,$person[person_id]);//,"='|prihod zapisal fa99|'");//,'rfid(start)');


                            $zapis = $najdistevilko[0];
                            $modified_by = $zapis[note];
                            $zapisst = $zapis[log_id];
                            //   header("location: error/message.php?msg=
                            //    ELSEd:$zapisst  in modified_by:$modified_by;");
                            //exit;
                            $db->query("update log set end=$zdaj, note=(concat('$zapis[note]','; odhod_zapisal_fa99')) where log_id=$zapisst");

                            //$db->query("update log set end=$zdaj where log_id=$zapisst");
                            //$db->query("update log set end=$zdaj where person_id=$person[person_id] and jobtype_id=$logJobTypeId and modified_by='rfid' order by log_id DESC limit 1");
                        }

                        header("location: error/message.php?msg=$person[first] $person[last] -> $action");
                    }
                }

                if ($action and !$id) {

                    echo "Pristavi kartico ($action)";

                    //  header("location: error/message.php?msg=dogodek -$action za </br>$person[first] $person[last] vpisan");
                }
                if (!$action and !$id) {
                    echo "pristavi kartico";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
