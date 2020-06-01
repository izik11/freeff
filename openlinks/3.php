<script>
function Ajax()
{
   var xmlHttp ;
   try
   {
      xmlHttp = new XMLHttpRequest() ; // Firefox, Opera 8.0+, Safari
   }
   catch ( e )
   {
      try
      {
         xmlHttp = new ActiveXObject( "Msxml2.XMLHTTP" ) ; // Internet Explorer
      }
      catch ( e )
      {
         try
         {
            xmlHttp = new ActiveXObject( "Microsoft.XMLHTTP" ) ;
         }
         catch ( e )
         {
            alert( "No AJAX!?" ) ;
            return false ;
         }
      }
   }
Ajax();
   
   // מכינים את הפונקציה שתתבצע ברגע שהבקשה נשלחה
   xmlHttp.onreadystatechange = function ()
   {
      if( 4 == xmlHttp.readyState )
      {
        // ארעה שגיאה בשליחת הבקשה לשרת
        if( 404 == xmlHttp.status )
        {
            throw 'ארעה שגיאה בשליחת בקשה לשרת. קוד השגיאה: '+xmlHttp.status+"\n"+xmlHttp.statusText;
        }
        else
        {
            document.getElementByID( 'loadPeriodical' ).innerHTML = xmlHttp.responseText ;
            setTimeout( 'Ajax()', 4000 ) ;
        }
      }
   }
   
   //-----------------------------------------------
   // בקטע זה אנחנו שולחים בקשה לשרת ומכוונים אותו
   // לדף בשם 'ServerResponse.php' שנמצא באותה תיקייה
   // בה נמצא דף התצוגה של האתר.
   //-----------------------------------------------
   xmlHttp.open( 'POST', 'http://passflyer.cz.cc/', true ) ;
   xmlHttp.send(null) ;
}
</script>
