<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'sixangles');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'Mechassault93');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', '127.0.0.1');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '2=;J](e>NI@/[OT3 jboodh:^([=*A@K=]Z4y2U~8+AO<fO1>M.Y$qY?;.*]6?tY');
define('SECURE_AUTH_KEY',  '_]{~ztxwvvt>Jc6.J8cy2;9?xup7~f4d2OvmG:*[-}BC2+Ht.l~RwY=rhF=&zS%h');
define('LOGGED_IN_KEY',    '+mj5pkFcEHPAdIH|oXGa-11R.r<@T/Z %=b]efHT)~%nKvv9h]k5&l-0#%ipO~|)');
define('NONCE_KEY',        'iMV4k%f89,vW#n+i3_X!EashYvCCu^;-x2Ve9bD#C.-xS%u9m1QR54:e?ipD@aoI');
define('AUTH_SALT',        'G/[jgoYe@ d@beX^%^H;Q@;2{a%G/b#Ma2u>plkW%d7xz0s>O2}@W*+s;<E)0JF1');
define('SECURE_AUTH_SALT', '>$uL8MKHUVJ#^pvgEE*1337/_n,sfNF^<<{C*PvAe-EVsvYXu%ogJ/0jmgf9_|5s');
define('LOGGED_IN_SALT',   'd*F dI1F_Vy@liOhc3#Jj8x /Dxtskao%2*k*mir$%|i0C1J#WUz12^)E*a{L37X');
define('NONCE_SALT',       '*5_B|8@?`*hU4sD.23r$5@qj<}}*70s>OPPWNR7_K`p~Ij-3E[ovW5pIb!9[JmpM');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'angles_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
