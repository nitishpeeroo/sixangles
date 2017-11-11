<?php
defined('ABSPATH') or die("");

if (!interface_exists('DUP_PRO_iChecker')) {

    interface DUP_PRO_iChecker
    {

        public function check();

        public function getErrors();

        public function getHelperMessages();
    }

}//if(!class_exists('Environment_Checker'))
