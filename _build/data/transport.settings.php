<?php

$modx->log(modX::LOG_LEVEL_INFO, 'Begin packaging settings...');

$menus = array();

$tmp = include $sources['data'].'elements/settings.php';

foreach ($tmp as $k => $v)
{
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
  
	$setting->fromArray(array_merge(
		array(
			'key' => PKG_NAME_LOWER . '.' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	),'',true,true);
  
	$settings[] = $setting;
}

unset($tmp, $setting);

return $settings;