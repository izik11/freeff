<?
        function potong($content,$start,$end){
                if($content && $start && $end) {
                        $r = explode($start, $content);
                                if (isset($r[1])){
                                        $r = explode($end, $r[1]);
                                        return $r[0];
                                }
                        return '';
                }
        }
               
        function print_info($filename,$size,$link){
                global $password;
                if($link == "" && $password != "")  exit("Fatal Error: Maybe your Fileflyer password is not working or Fileflyer were blocked this script. Please contact the developer - Pr0x3rStYl3.");
                $me = base64_decode("PGJyIC8+PGJyIC8+IENvZGVkIEJ5IFByMHgzclN0WWwz");
                echo "Filename: " . $filename . "<br />";
                echo "Size: " . $size . "<br />";
                        if($link == ""){
                                echo "Link: Please enter a password to get link" . $me;
                        }else{
                                echo "Link: http" . $link . $me;
                        }
        }
               
                function GetDomain($url){
                                $nowww = str_replace('www.','',$url);
                                $domain = parse_url($nowww);
                                                if(!empty($domain["host"])){
                                                                return $domain["host"];
                                                }else{
                                                                return $domain["path"];
                                                }
                }
 
/**   Defines   **/
                if(!isset($_GET['id'])) exit("Fatal Error: Please enter an ID for a Fileflyer file. ( ex. fileflyer.php?id=(Fileflyer ID) )");
               
        $password = "346952192"; // Your Fileflyer Password
       
        $url = "http://www.fileflyer.com/view/" . $_GET['id']; // The Fileflyer Link
        $cookies = dirname(__FILE__) . "/cookies.txt"; // Where to save the cookies - This folder
                $cookiesnew = dirname(__FILE__) . "/cookies2.txt"; // Where to save the cookies - This folder
        $useragent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.782.107 Safari/535.1"; // The Useragent
 
/**   Start Of The Script   **/
 
        $ch = curl_init(); // Getting The Url
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookies);
                curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $res = curl_exec($ch);
 
        $link = potong($res,'class="handlink" href="http','"'); // Trying to get the link if dont need password
                $valid = potong($res,'">To report a ',' ,'); // Trying to know if the file valid
                $expired = potong($res,'class="handlink">','</a>'); // Trying to know if the file is expired
        $filename = potong($res,'title="','"');  // Getting the Filename
        $size = potong($res,'<span id="ItemsList_ctl00_size">','<');  // Getting the Size
                $posturl = potong($res,'action="','"');
                $host = potong($posturl,'http://','/');
                        if($expired == "Expired") exit("Fatal Error: Sorry but this file was expired.");
                        if($valid == "bug") exit("Fatal Error: Sorry but the file was not found.");
       
                                if($link == ""){ // Password Needed
               
                        echo "Password required  <br /><br />";
                       
                                                $fh = fopen($cookies, 'r');
                                                $theData = fread($fh,filesize($cookies));
                                                fclose($fh);
                                                $theData = str_replace("#HttpOnly_", "", $theData);        
                                           
                        $Handle = fopen($cookiesnew, 'w') or exit("Fatal Error: Cannot open the cookie file to edit.. Please CHMOD ".$cookiesnew ." to 777.");
                                                fwrite($Handle, $theData);
                                                $Data = GetDomain($url)."    TRUE    /       FALSE   0      ppc     ".$password." \n";
                                                fwrite($Handle, $Data);
                        fclose($Handle);
                        $viewstate = potong($res,'"__VIEWSTATE" value="','" />');
                        $eventvalidation = potong($res,'id="__EVENTVALIDATION" value="','" />');
                        $fields = array(
                                'Password'=>$password,
                                'SMSButton'=>'Go',
                                '__VIEWSTATE'=>$viewstate,
                                '__ EVENTVALIDATION '=>$eventvalidation,
                                '__EVENTTARGET'=>'',
                                '__EVENTARGUMENT'=>'',
                                'TextBox1'=>'',
                                'CheckBoxPass'=>'on',
                                );
                       
                        $fields_string = "";
                        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                        rtrim($fields_string,'&');
                        $fields_string = urlencode($fields_string);
                                               
                                                $arrHeaders = array (
                                                                'Origin' => 'http://www.fileflyer.com',
                                                                'Connection' => 'keep-alive',
                                                                'Accept-Encoding' => 'gzip,deflate,sdch',
                                                                'Host' => $host ,
                                                                'Cache-Control' => 'max-age=0',
                                                                'Content-Type' => 'application/x-www-form-urlencoded');
                                               
                                                curl_setopt($ch,CURLOPT_HTTPHEADER,$arrHeaders);
                                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'POST');
                        curl_setopt($ch,CURLOPT_URL,$posturl);
                        curl_setopt($ch, CURLOPT_REFERER, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
                        curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookiesnew);
                        curl_setopt($ch,CURLOPT_POST,count($fields));
                        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
                                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $result = curl_exec($ch);
                        curl_close($ch);
 
                        $link = potong($result,'class="handlink" href="http','"');
                                               
                        print_info($filename,$size,$link);
                       
                }else{ // No Need Password
                echo "Password Not required <br /><br />";
               
                        print_info($filename,$size,$link);
                        curl_close($ch);
                       
                }
 
/**   End Of The Script   **/
?>