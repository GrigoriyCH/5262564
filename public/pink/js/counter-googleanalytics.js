  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-106408471-1', 'auto');
  ga('require', 'displayfeatures'); 
  ga('send', 'pageview');
  
 /* Accurate bounce rate by time */
 if (!document.referrer || document.referrer.split('/')[2].indexOf(location.hostname) != 0)
 setTimeout(function(){ga('send', 'event', 'Новый посетитель', location.pathname);}, 15000);