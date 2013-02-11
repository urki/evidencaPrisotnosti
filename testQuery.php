
<?php
$titleVDC = "QUERY TEST";


//require_once("head.php");
//require_once('designClass.php');
//require_once ('localClass.php');


  $DO_NOT_REDIRECT = "true";
    require_once("../intranet2/inc/config.php");



$dal = new DAL();


   $najdistevilko=$dal->get_data_from_log_by_job_and_person_and_modified(1	,3,"='prihod zapisal fa99'");//,'rfid(start)');

                           
//$working_hours_query=$dal->get_data_from_working_hour_by_not_expired_by_person(3);
         //   $working_hours_query=$working_hours_query[0];
        //echo "do semd dela:";
        //   print_r($working_hours_query)
         //  $working_hours=$working_hours_query[workingHours];
          //  $working_start=$working_hours_query[start];
          //  $working_end=$working_hours_query[end]; 
          //  $working_day=$working_hours_query[DayOfWeek]; 
                         



                      //  echo "</br>woking hours=$working_hour";
                      //  echo "</br>  =    "; 
//echo "</br> working_start = $working_start";     
//echo "</br> working_end=$working_end";     
//echo "</br>  working_end=   $working_end ";     
//echo "</br>  working_day= $working_day    ";     


//$db->query("update log set end=$zdaj where log_id=$zapisst");

                            //$db->query("update log set end=$zdaj where person_id=$person[person_id] and jobtype_id=$logJobTypeId and modified_by='rfid' order by log_id DESC limit 1");
                        

            ?>
         