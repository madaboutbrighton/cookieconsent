<?php

return array(
              'CookieConsent' => array(
                                    'file' => 'cookieconsent',
                                    'description' => 'Append cookie consent disclaimer to body tag if consent has not been set.',
                                    'static' => BUILD_PLUGIN_STATIC,
                                    'events' => array(
                                                      'OnWebPagePrerender' => array()
                                                      ),
                                    'properties' => array(  array(
                                                              'name' => 'cookieDays',
                                                              'desc' => 'prop_cookieconsent.cookieDays_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => '365',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                            array(
                                                              'name' => 'cookieName',
                                                              'desc' => 'prop_cookieconsent.cookieName_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => 'CookieConsent',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                            array(
                                                              'name' => 'idCookiePolicy',
                                                              'desc' => 'prop_cookieconsent.idCookiePolicy_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => '',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                            array(
                                                              'name' => 'tpl',
                                                              'desc' => 'prop_cookieconsent.tpl_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => 'cookieConsent',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                            array(
                                                              'name' => 'class',
                                                              'desc' => 'prop_cookieconsent.class_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => 'cookieconsent',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                            array(
                                                              'name' => 'includeCSS',
                                                              'desc' => 'prop_cookieconsent.includeCSS_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => '1',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                            array(
                                                              'name' => 'includeJS',
                                                              'desc' => 'prop_cookieconsent.includeJS_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => '1',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                            array(
                                                              'name' => 'pathCSS',
                                                              'desc' => 'prop_cookieconsent.pathCSS_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => '{assets_path}/components/cookieconsent/css/cookieconsent-min.css',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                            array(
                                                              'name' => 'pathJS',
                                                              'desc' => 'prop_cookieconsent.pathJS_desc',
                                                              'type' => 'textfield',
                                                              'options' => '',
                                                              'value' => '{assets_path}/components/cookieconsent/js/mabCookieSet-min.js',
                                                              'lexicon' => 'cookieconsent:properties',
                                                              ),
                                                          )
                                                      
                                    )
              );