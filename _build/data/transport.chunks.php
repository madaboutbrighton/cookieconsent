<?php

$modx->log(modX::LOG_LEVEL_INFO, 'Begin packaging chunks...');

$chunks = array();

$tmp = include $sources['data'].'elements/chunks.php';

foreach ($tmp as $k => $v)
{
  /* @var modChunk $chunk */
  $chunk = $modx->newObject('modChunk');
  
  $file = strtolower($k);
  
  $a = array( 'id' => 0,
              'name' => $k,
              'description' => @$v['description'],
              'snippet' => trim(file_get_contents($sources['source_core'].'/elements/chunks/chunk.' . $file . '.tpl')));
              
  if ($v['static'])
  {
    $a['static'] = $v['static'];
    $a['source'] = 1;
    $a['static_file'] = STATIC_CORE_PATH . 'components/'.PKG_NAME_LOWER.'/elements/chunks/chunk.' . $file . '.tpl';
  }
  
  $chunk->fromArray($a, '', true, true);

  $properties = $v['properties'];
  $chunk->setProperties($properties);
  
  $chunks[] = $chunk;
  
  $error = (empty($a['snippet'])) ? ' - WARNING chunk is empty!!!' : '';
  
  $modx->log(modX::LOG_LEVEL_INFO, '-- ' . $k . ' - ' . count($properties) . ' properties' . $error);
}

unset($tmp, $properties, $a);

return $chunks;