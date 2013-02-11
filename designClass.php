<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of designClass
 *
 * @author uros
 */
class designClass {

    public $sizeX = '141';
    public $sizeY = '146';

    public function draw_link_button_with_action($action, $image) {
        require_once('config.php');
        //$image = "$imagePath$image";
        $sizeX = $this->sizeX;
        $sizeY = $this->sizeY;
        echo "<li><a href='action.php?ts=123332&amp;action=$action'><img src='$image' width='$sizeX' height='$sizeY' border='0'  /></a></li>";
    }

    public function button_entry() {
        echo $this->draw_link_button_with_action('prihod', 'entry.png');
    }

    public function button_private_exit() {
        echo $this->draw_link_button_with_action('privat izhod', 'coffee.png');
    }

    public function button_work_exit() {
        echo $this->draw_link_button_with_action('izhod služba', 'exit_bui.png');
    }
      public function button_lunch_exit() {
        echo $this->draw_link_button_with_action('kosilo', 'kosilo.png');
    }
     public function button_final_exit() {
        echo $this->draw_link_button_with_action('odhod', 'exit.png');
    }
      public function button_cancel_main() {
        echo "<a href='".$basepath."index.php'><img src='cancel.png' width='64' height='64' border='0' /></a>";
    }


    public function buttons_with_condition($status, $button) {
        /*
         * Nariše vse zahtevane gumbe
         */
        

        switch ($status) {
            case true:
                //echo"true";
                foreach ($button as $buttons) {
                 //   echo $this->$buttons($sizeX, $sizeY);
                 echo $this->$buttons();
                }
                break;
            default:
                echo "";
                break;
        }
    }

}
?>
