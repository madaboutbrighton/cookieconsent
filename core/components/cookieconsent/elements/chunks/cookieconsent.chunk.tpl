<div data-name="[[+cookieName]]" data-value="[[+cookieValue]]" data-days="[[+cookieDays]]"  class="alert alert-warning alert-dismissible fade in text-center [[+class]]" role="alert">
  
  <p>
    We have placed cookies on your device to help make this website better. You can view our <a title="View our cookie policy" href="[[+idCookiePolicy:gt=`0`:then=`[[~[[+idCookiePolicy]]]]`:else=`/`]]">cookie policy here</a>.     
  </p>
  
  <p>
    <button type="button" class="btn btn-info" data-dismiss="alert">Continue using site</button>
  </p>
  
</div>

<script>
  $(function() 
  {
    $(".[[+class]] button").click(function ()
    {
      $(".[[+class]]").mabCookieSet({onDone: function(){$(".[[+class]]").hide();}});
    });
  });
</script>