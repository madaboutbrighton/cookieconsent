(function( $ )
{
  $.fn.mabCookieSet = function( options )
  {
    // Sets a cookie
    // Usage - $("#cookieconsent").mabCookieSet();
    
    //use extra extend attribute of true to go deep. This allows the css arrays to be properly merged
    var opts = $.extend( true, {}, $.fn.mabCookieSet.defaults, options );
    
    return this.each(function()
    {
      var t = $(this);
      
      var today = new Date();
      var expire = new Date();
      var name = "";
      var value = "";
      var days = 0;
      
      if (opts.useData)
      {
          name = t.data("name");
          value = t.data("value");
          days = t.data("days");
        } else {
          name = opts.name;
          value = opts.value;
          days = opts.days;
      }
        
      if (opts.debug)
      {
        console.log("---mabCookieSet---");
        console.log("name : " + name);
        console.log("value : " + value);
        console.log("days : " + days);
        console.log("---");
      }
      
      if (days==null || days==0) days=1;
      
      if (name.length > 0)
      {
        expire.setTime(today.getTime() + 3600000*24*days);
        
        document.cookie = name + "=" + escape(value) + ";expires=" + expire.toGMTString();
      }
      
      opts.onDone(t, opts);
      
    });
  };
      
  var log = function( debug, txt )
  {
      if (debug) console.log(txt);
  };
       
    
  // Plugin defaults – added as a property on our plugin function.
  $.fn.mabCookieSet.defaults = {
      useData : true,
      debug : false,
      onDone: function(t, options)
              {
              }
  };

}( jQuery ));