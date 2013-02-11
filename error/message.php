<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$msg=$_REQUEST["msg"];
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <link rel="stylesheet" href="../vendor/css/arm_7_5.css" type="text/css" media="screen, projection"/>
        <head>
            <meta http-equiv="refresh" content="1;URL=../index.php"></meta>
            <title>Obvestilo</title>
        </head>
        <div id="apDiv1">
            <div class="message">
                <div align="center">
                <?php echo "$msg </br>" ?>
            </div>
        </div>
    </div>
</html>

