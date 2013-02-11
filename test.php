<?php
/*
 * Main page od FriendlyArm
 * 
 */
require_once('designClass.php');
require_once 'head.php';
$designClass = new designClass();
?>
<div  id="apDiv1">
    <div class="Ikonce">
        <?php $nekaj = $designClass->buttons_with_condition(true,array('button_entry')); ?>
    </div>
</div>

