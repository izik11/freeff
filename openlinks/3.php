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
   
   // ������ �� �������� ������ ���� ������ �����
   xmlHttp.onreadystatechange = function ()
   {
      if( 4 == xmlHttp.readyState )
      {
        // ���� ����� ������ ����� ����
        if( 404 == xmlHttp.status )
        {
            throw '���� ����� ������ ���� ����. ��� ������: '+xmlHttp.status+"\n"+xmlHttp.statusText;
        }
        else
        {
            document.getElementByID( 'loadPeriodical' ).innerHTML = xmlHttp.responseText ;
            setTimeout( 'Ajax()', 4000 ) ;
        }
      }
   }
   
   //-----------------------------------------------
   // ���� �� ����� ������ ���� ���� �������� ����
   // ��� ��� 'ServerResponse.php' ����� ����� ������
   // �� ���� �� ������ �� ����.
   //-----------------------------------------------
   xmlHttp.open( 'POST', 'http://passflyer.cz.cc/', true ) ;
   xmlHttp.send(null) ;
}
</script>
