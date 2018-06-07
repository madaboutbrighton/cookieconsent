<?php

$modx->log(modX::LOG_LEVEL_INFO, 'Begin packaging plugins...');

$plugins = array();

$tmp = include $sources['data'].'elements/plugins.php';

foreach ($tmp as $k => $v)
{ 
  /* @var modPlugin $plugin */
  $plugin = $modx->newObject('modPlugin');
  
  $file = strtolower($k);
  
  $a = array( 'name' => $k,
              'description' => @$v['description'],
              'plugincode' => trim(getSnippetContent($sources['source_core'].'/elements/plugins/plugin.' . $file . '.php')));
              
  if ($v['static'])
  {
    $a['static'] = $v['static'];
    $a['source'] = 1;
    $a['static_file'] = STATIC_CORE_PATH . 'components/'.PKG_NAME_LOWER.'/elements/plugins/plugin.' . $file . '.php';
  }

  $plugin->fromArray($a, '', true, true);
  
  $properties = $v['properties'];
  $plugin->setProperties($properties);
  
  $events = array();
  
  if (!empty($v['events']))
  {
    foreach ($v['events'] as $k2 => $v2)
    {
      /* @var modPluginEvent $event */
      $event = $modx->newObject('modPluginEvent');
      
      $event->fromArray(array_merge(
                                    array(
                                          'event' => $k2,
                                          'priority' => 0,
                                          'propertyset' => 0,
                                          ), $v2
                                    ), '', true, true);
      
      $events[] = $event;
    }
    
    unset($v['events']);
  }
  
  if (!empty($events))
  {
    $plugin->addMany($events);
  }
  
  $plugins[] = $plugin;
  
  $error = (empty($a['plugincode'])) ? ' - WARNING plugin is empty!!!' : '';
  
  $modx->log(modX::LOG_LEVEL_INFO, '-- ' . $k . ' - ' . count($properties) . ' properties, ' . count($events) . ' events');
}

unset($tmp, $properties, $events, $a);

return $plugins;