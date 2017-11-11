<?phpdefined("ABSPATH") or die("");
/**
 * Utility class working with strings
 *
 * Standard: PSR-2
 * @link http://www.php-fig.org/psr/psr-2
 *
 * @package DUP_PRO
 * @subpackage classes/utilities
 * @copyright (c) 2017, Snapcreek LLC
 * @license	https://opensource.org/licenses/GPL-3.0 GNU Public License
 * @since 3.0.0
 *
 */
require_once(DUPLICATOR_PRO_PLUGIN_PATH . '/classes/entities/class.global.entity.php');
require_once(DUPLICATOR_PRO_PLUGIN_PATH . '/classes/entities/class.secure.global.entity.php');

class DUP_PRO_Upgrade_U
{
    static function PerformUpgrade($currentVersion, $newVersion)
    {
        self::MoveDataToSecureGlobal();
    }

    static function MoveDataToSecureGlobal()
    {
        /* @var $global DUP_PRO_Global_Entity */
        /* @var $sglobal DUP_PRO_Secure_Global_Entity */
        $global = DUP_PRO_Global_Entity::get_instance();

        if($global->lkp !== '' || $global->basic_auth_user !== '')
        {
            error_log('setting sglobal');
            $sglobal = DUP_PRO_Secure_Global_Entity::getInstance();

            $sglobal->lkp = $global->lkp;
            $sglobal->basic_auth_password = $global->basic_auth_password;

            $global->lkp = '';
            $global->basic_auth_password = '';

            $sglobal->save();
            $global->save();
        }
        else
        {
            error_log('not setting sglobal');
        }
    }
}

