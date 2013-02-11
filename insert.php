<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$DO_NOT_REDIRECT = "true";
require_once("../intranetDevelop/inc/config.php");

$action = $_REQUEST["insert"];
$person = $_REQUEST["groupSelect"];
$rfid = $_REQUEST["rfid"];

//echo "person=$person";

if ($person and $rfid) {
    $data = array(
        'status' => 'active',
        'person_id' => $person,
        'rfid' => $rfid,
    );
    $db->insert('Rfid', $data);


//query za vpis številke zaposlenega
     $person_insert = $dal->get_active_person_data_from_Rfid_by_rfid_status($rfid,'active');
     foreach ($person_insert as $persons_insert) {
                        $db->query("update persons set rfid_id=$persons_insert[id] where id_person=$person");
                            }
                     header('location: error/message.php?msg=Kartica je registriana');
   // $db->query("update persons set rfid_id=$rfid where id_person=$person");

            } else {
                   header('location: error/message.php?msg=Izberi si osebo!');
            }
?>
