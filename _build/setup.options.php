<?php

$output = '';

switch ($options[xPDOTransport::PACKAGE_ACTION])
{
  case xPDOTransport::ACTION_INSTALL:
  
    //$output = '<h2>CookieConsent Installer</h2>
    
    break;
    
    case xPDOTransport::ACTION_UPGRADE:
    case xPDOTransport::ACTION_UNINSTALL:
    break;
}

return $output;