<?php
defined('ABSPATH') or die("");

require_once ABSPATH . '/wp-admin/includes/upgrade.php';
require_once(DUPLICATOR_PRO_PLUGIN_PATH . '/classes/environment/interface.checker.php');

if (!class_exists('DUP_PRO_Db_Checker')) {


    class DUP_PRO_DB_Checker implements DUP_PRO_iChecker
    {

        public function __construct()
        {
            global $wpdb;
            $this->table = $wpdb->base_prefix . "duplicator_pro_test_tmp_table";
            $this->results = array();
            $this->errors = array();
            $this->helper_messages = array();
        }

        public function dropTable()
        {
            try {
                global $wpdb;
                $table_name = $this->table;
                $sql = "DROP TABLE IF EXISTS `{$table_name}`;";
                $result = $wpdb->query($sql);
                return !$this->doesTableExist($table_name);
            } catch (Exception $e) {
                $this->errors['dropTable'][] = $e;
                return false;
            }
        }

        public function insert($args = array())
        {
            try {
                $table_name = $this->table;
                if (!$this->doesTableExist($table_name)) {
                    return false;
                }

                global $wpdb;

                $defaults = array(
                    'id' => '',
                    'test_varchar' => 'nice duplicator pro',
                    'test_int' => 234,
                );

                $args = wp_parse_args($args, $defaults);
                // $table_name =   $wpdb->prefix . "duplicator_pro_test_tmp_table";
                // remove row id to determine if new or update
                $row_id = (int) $args['id'];
                unset($args['id']);

                if (!$row_id) {
                    // insert a new
                    if ($wpdb->insert($table_name, $args)) {
                        return $wpdb->insert_id;
                    }
                } else {
                    // do update method here
                    if ($wpdb->update($table_name, $args, array('id' => $row_id))) {
                        return $row_id;
                    }
                }

                return false;
            } catch (Exception $e) {
                $this->errors['insert'][] = $e;
                return false;
            }
        }

        public function doesTableExist($table_name)
        {
            if (empty($table_name)) {
                return false;
            }
            global $wpdb;
            //https://developer.wordpress.org/reference/functions/maybe_create_table/
            // $query = $wpdb->prepare( "SHOW TABLES LIKE %s", $wpdb->esc_like( $table_name ) );
            try {
                // $result=$wpdb->get_var( $query );
                $query = "SHOW TABLES LIKE '$table_name'";
                if ($wpdb->get_var($query) == $table_name) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                $this->errors['doesTableExist'][] = $e;
                return false;
            }
        }

        public function createTable()
        {
            try {
                global $wpdb;
                $table_name = $this->table;

                //PRIMARY KEY must have 2 spaces before for dbDelta to work
                $sql = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
               id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
               test_varchar VARCHAR(250) NOT NULL,
               test_int INT(11) NOT NULL,
               PRIMARY KEY  (id))";

                dbDelta($sql);
                return $this->doesTableExist($table_name);
            } catch (Exception $e) {
                $this->errors['createTable'][] = $e;
                return false;
            }
        }

        public function check()
        {
           // $passed = $this->createTable() && $this->insert() && $this->dropTable();
           
             $passed = $this->createTable() && $this->insert();
             
             // If can't drop the temp table that's ok since we don’t need that functionality in the plugin
             $this->dropTable();
             
            if (!$passed) {
                $user = '<b style="color:red;">' . DB_USER . '</b>';
                $db = '<b style="color:red;">' . DB_NAME . '</b>';
                $this->helper_messages[] = DUP_PRO_U::__("Duplicator Pro functionality has been disabled due to a database rights issue. Please give database user {$user} full rights to database {$db}");
            }
            
            return $passed;
        }

        public function getErrors()
        {
            return $this->errors;
        }

        public function getHelperMessages()
        {
            return $this->helper_messages;
        }
    }

    //end of class Db_Checker
}//if(!class_exists('Db_Checker'))
