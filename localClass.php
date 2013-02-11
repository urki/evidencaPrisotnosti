<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of localClass
 *
 * @author uros
 */
class localClass {

                        public function error1($var12) {

                            return(header('location: error/message.php?msg=Napaka:   Za odhodom - ' . $var12 . ' mora biti naprej prihod!'));
                        }

}
?>
