<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$DO_NOT_REDIRECT = "true";
require_once("../intranetDevelop/inc/config.php");

//Query
  $person = $dal->get_active_person_data_from_Rfid_by_rfid_status($id,'active');
                        $person = $person[0];
                        if (!$person) {
                            if ($action =="odhod") {
                                 //echo "Nov Vnos!!!!";

                                 header("location: insert_new.php?id=$id");
                                exit;
                            } else {
                            echo "Kartica je neveljavna!";
                            exit;
                           }
                        }

     //inserta
                        if ($person and $rfid) {
    $data = array(
        'status' => 'active',
        'person_id' => $person,
        'rfid' => $rfid,
    );
    $db->insert('Rfid', $data);
                        }

?>
