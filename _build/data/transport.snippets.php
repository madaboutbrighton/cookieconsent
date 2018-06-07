<?php

$modx->log(modX::LOG_LEVEL_INFO, 'Begin packaging snippets...');

$snippets = array();

$tmp = include $sources['data'].'elements/snippets.php';

foreach ($tmp as $k => $v)
{
  /* @var modSnippet $snippet */
  $snippet = $modx->newObject('modSnippet');
  
  $file = strtolower($k);
  
  $a = array( 'id' => 0,
              'name' => $k,
              'description' => @$v['description'],
              'snippet' => trim(getSnippetContent($sources['source_core'].'/elements/snippets/snippet.'.$file.'.php')));
              
  if ($v['static'])
  {
    $a['static'] = $v['static'];
    $a['source'] = 1;
    $a['static_file'] = STATIC_CORE_PATH . 'components/'.PKG_NAME_LOWER.'/elements/snippets/snippet.'.$file.'.php';
  }
  
  $snippet->fromArray($a, '', true, true);

  $properties = $v['properties'];
  $snippet->setProperties($properties);
  
  $snippets[] = $snippet;
  
  $error = (empty($a['snippet'])) ? ' - WARNING snippet is empty!!!' : '';
  
  $modx->log(modX::LOG_LEVEL_INFO, '-- ' . $k . ' - ' . count($properties) . ' properties' . $error);
}

unset($tmp, $properties, $a);

return $snippets;