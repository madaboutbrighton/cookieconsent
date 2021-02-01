<?php

/* define package names */
define('PKG_NAME', 'CookieConsent');
define('PKG_NAME_LOWER', strtolower(PKG_NAME));

//define('PKG_BUILD_DEV', 'DEV');

define('PKG_VERSION','0.0.6');
define('PKG_RELEASE_TYPE', 'pl');

/* define build options */
//define('BUILD_MENU_UPDATE', false);
//define('BUILD_ACTION_UPDATE', false);
//define('BUILD_SETTING_UPDATE', false);
//define('BUILD_CHUNK_UPDATE', true);
//define('BUILD_SNIPPET_UPDATE', true);
define('BUILD_PLUGIN_UPDATE', true);
//define('BUILD_EVENT_UPDATE', true);
//define('BUILD_POLICY_UPDATE', true);
//define('BUILD_POLICY_TEMPLATE_UPDATE', true);
//define('BUILD_PERMISSION_UPDATE', true);

if (defined('PKG_BUILD_DEV'))
{
    define('PKG_RELEASE', PKG_RELEASE_TYPE . PKG_BUILD_DEV);
    
    define('BUILD_CHUNK_STATIC', true);
    define('BUILD_SNIPPET_STATIC', true);
    define('BUILD_PLUGIN_STATIC', true);
    
    define('STATIC_CORE_PATH', MODX_DEV_RELATIVE_PATH . PKG_NAME_LOWER . '/core/');

  } else {
    
    define('PKG_RELEASE', PKG_RELEASE_TYPE);
    
    define('BUILD_CHUNK_STATIC', false);
    define('BUILD_SNIPPET_STATIC', false);
    define('BUILD_PLUGIN_STATIC', false);
    
    define('STATIC_CORE_PATH', MODX_CORE . '/');
}
  
define('PKG_AUTO_INSTALL', false);
define('PKG_NAMESPACE_PATH', '{core_path}components/'.PKG_NAME_LOWER.'/');

$BUILD_RESOLVERS = array(
	//'tables',
	//'payment',
	//'lexicon',
	//'setup',
);