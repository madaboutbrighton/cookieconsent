CookieConsent

A PHP MODX Revolution extra to automatically comply with EU cookie law.

Official Documentation:

https://madaboutbrighton.net/projects/cookieconsent

Usage:

- Once installed, simply clear your cache.
- Any html pages will now have a cookie disclaimer appended to their BODY tag.
- The disclaimer will stop appearing once the disclaimer has been acknowledged by the user.
- Configuration can be done by editing the plugin properties.

Requires:

- jQuery 2.1.4+
    Default chunk uses jQuery.
  
Optional:

- Bootstrap 3.3.4+
    Default chunk is styled using Bootstrap CSS, but will still display without Bootstrap.

Troubleshooting:
  
- Disclaimer will not clear after acknowledging it.
    Make sure jQuery is included, using one version. Multiple versions of jQuery on a page will cause problems.