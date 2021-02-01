<?php

/**
 * CookieConsent
 *
 * Copyright 2018 by Mad About Brighton <mail@madaboutbrighton.net>
 * 
 * CookieConsent is free software; you can copy, distribute, transmit and adapt it
 * under the terms of the Creative Commons attribution-ShareAlike 3.0 Unported License.
 * 
 * You must attribute CookieConsent to Mad About Brighton. If you alter, transform, or build upon
 * CookieConsent, you must distribute the resulting work only under the same or similar license to this one.
 *
 * CookieConsent is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the Creative Commons attribution-ShareAlike 3.0 Unported License for more details.
 *
 * You should have recieved a copy of the license. If not, it can be viewed by visiting 
 * https://madaboutbrighton.net/projects/cookieconsent
 *
 */

/**
 * This file is the main class file for CookieConsent
 *
 * @copyright Copyright 2018 by Mad About Brighton <mail@madaboutbrighton.net>
 * @author west <west@madaboutbrighton.net>
 * @licence https://creativecommons.org/licenses/by-sa/3.0/
 * @package cookieconsent
 */
 
class CookieConsent
{
  /** @var modX|null A reference to the modX object */
  public $modx = null;
  
  /** @var array A collection of properties to adjust CookieConsent behaviour */
  public $config = array();
  
  /**
  * The CookieConsent Constructor.
  *
  * Creates a new CookieConsent object.
  *
  * @param modX &$modx A reference to the modX object.
  * @param array $config A collection of properties that modify CookieConsent behaviour.
  * @return CookieConsent A unique CookieConsent instance.
  */
  function __construct(modX &$modx,array $config = array())
  {
      $this->modx =& $modx;

      // allows you to set paths in different environments
      if ($modx->getOption('site_dev') == 1)
      {
          $basePath = $this->modx->getOption('cookieconsent.core_path');
          $assetsUrl = $this->modx->getOption('cookieconsent.assets_url');
        } else {
          $basePath = $this->modx->getOption('core_path').'components/cookieconsent/';
          $assetsUrl = $this->modx->getOption('assets_url').'components/cookieconsent/';
      }
            
      $this->config = array_merge(array(
          'basePath' => $basePath,
          'corePath' => $basePath,
          'modelPath' => $basePath.'model/',
          'processorsPath' => $basePath.'processors/',
          'templatesPath' => $basePath.'templates/',
          'chunksPath' => $basePath.'elements/chunks/',
          'jsUrl' => $assetsUrl.'js/',
          'cssUrl' => $assetsUrl.'css/',
          'assetsUrl' => $assetsUrl,
          'connectorUrl' => $assetsUrl.'connector.php',
      ),$config);

  }
  
  /**
  * Appends the processed cookie consent chunk to the generated resource output BODY tag
  */
  public function appendDisclaimer( $a = array() )
  {
    // setup default properties
    $a['includeCSS'] = $this->modx->getOption('includeCSS', $a, true);
    $a['includeJS'] = $this->modx->getOption('includeJS', $a, true);
    $a['pathCSS'] = $this->fillPlaceholders($this->modx->getOption('pathCSS', $a, MODX_ASSETS_PATH .'components/cookieconsent/css/cookieconsent-min.css'), '.css');
    $a['pathJS'] = $this->fillPlaceholders($this->modx->getOption('pathJS', $a, MODX_ASSETS_PATH .'components/cookieconsent/js/mabCookieSet-min.js'), '.js');
    $a['class'] = $this->modx->getOption('class', $a, 'cookieconsent');
    $a['cookieName'] = $this->modx->getOption('cookieName', $a, 'mabCookieDisclaimer');
    $a['cookieDays'] = $this->modx->getOption('cookieDays', $a, 365);
    $a['idCookiePolicy'] = $this->modx->getOption('idCookiePolicy', $a, '');
    $a['demo'] = $this->modx->getOption('demo', $a, '');
    $tpl = $this->modx->getOption('tpl', $a, 'cookieConsent');
    
    $a['cookieValue'] = $this->cookieEncode();

    if ($a['demo'] == 1) return $this->getChunk( $tpl, $a );
    
    //regClientStartupHTMLBlock would not work. Probably something to do with OnWebPagePrerender firing too late
    if ($a['includeCSS'])
    {
      $item = '</head>';
      $find[] = $item;
      $replace[] = $this->getChunk( 'cookieconsentcss', array('content' =>  $this->getFileIfExists($a['pathCSS']))) . "\n" . $item;
    }
    
    //regClientHTMLBlock would not work. Probably something to do with OnWebPagePrerender firing too late
    if ($a['includeJS'])
    {
      $item = '</body>';
      $find[] = $item;
      $replace[] = $this->getChunk( 'cookieconsentjs', array('content' =>  $this->getFileIfExists($a['pathJS']))) . "\n" . $item;
    }
        
    $item = '</body>';
    $find[] = $item;
    $replace[] = $this->getChunk( $tpl, $a ) . "\n" . $item;

    $output = &$this->modx->resource->_output;
   
    $output = str_replace($find, $replace, $output);
  }
  
  /**
  * Performs find and replace to populate placeholders if input contains a required string
  *
  * @param string $s The string to be searched
  * @param string $require The string that must be in $s.
  * @return string The processed string
  */
	private function fillPlaceholders($s, $require)
	{
    if (substr_count($s, $require) > 0)
    {
      $search[] = '{assets_path}';
      $replace[] = MODX_ASSETS_PATH;

      return str_replace( $search, $replace, $s );
    }
	}
  
  /**
  * Returns the contents of a file if it exists
  *
  * @param string $fullname Full name of the file to be fetched
  * @return string The contents of the file
  */
  private function getFileIfExists($fullname)
  {
    if (file_exists($fullname))
    {
      return file_get_contents($fullname);
    }
  }
  
  /**
  * Encodes the cookie settings and returns them as a string
  * Future update - will be able to handle specific types
  *
  * @param array $types A collection of cookie types, showing if they are allowed
  * @return string The types array converted to JSON and encoded with 
  */
  public function cookieEncode($types = array('necessary' => true, 'experience' => true, 'performance' => true, 'tracking' => true, 'advertising' => true))
  {
    $s = json_encode($types);
    return base64_encode($s);
  }
  
  /**
  * Decodes the cookie value and returns it as an array
  *
  * @param string $string The encoded cookie value
  * @return array A collection of cookie types, showing if they are allowed
  */
  public function cookieDecode($string)
  {
    $s = base64_decode($string);
    return json_decode($s);
  }
  
  /**
  * Processes a chunk. Attempts object first, then file based if not found
  *
  * @param string $name The name of the chunk
  * @param array $properties The settings for the chunk
  * @return string The content of the processed chunk
  */
  public function getChunk($name, $properties = array())
  {
      $chunk = null;
      
      if (!isset($this->chunks[$name]))
      {
          $chunk = $this->modx->getObject('modChunk', array('name' => $name));
          
          if (empty($chunk) || !is_object($chunk))
          {
            $chunk = $this->_getTplChunk($name);
            if ($chunk == false) return false;
          }
          
          $this->chunks[$name] = $chunk->getContent();
            
        } else {
          
          $o = $this->chunks[$name];
          $chunk = $this->modx->newObject('modChunk');
          $chunk->setContent($o);
      }
      
      $chunk->setCacheable(false);
      
      return $chunk->process($properties);
  }
  
  /**
  * Get the contents of a file based chunk
  *
  * @param string $name The name of the chunk
  * @param string $postfix The extension of the file based chunk
  * @return string The content of the file based chunk
  */
  private function _getTplChunk($name, $postfix = '.chunk.tpl')
  {
      $chunk = false;
      
      $f = $this->config['chunksPath'].strtolower($name).$postfix;
      
      if (file_exists($f))
      {
        $o = file_get_contents($f);
        $chunk = $this->modx->newObject('modChunk');
        $chunk->set('name',$name);
        $chunk->setContent($o);
      }
      
      return $chunk;
  }    
    
}