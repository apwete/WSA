<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'form1')
{
   $mailto = 'yourname@yourdomain.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Website form';
   $message = 'Values submitted from web site form:';
   $success_url = '';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field");
   $message .= $eol;
   $message .= "IP Address : ";
   $message .= $_SERVER['REMOTE_ADDR'];
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Contact WareSoftAlien !</title>
<meta name="generator" content="WYSIWYG Web Builder 9 - http://www.wysiwygwebbuilder.com">
<style type="text/css">
div#container
{
   width: 961px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #0D0D0D;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
   margin: 0;
   text-align: center;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
a.white
{
   color: #FFFFFF;
   text-decoration: none;
}
a.white:visited
{
   color: #FFFFFF;
   text-decoration: none;
}
a.white:active
{
   color: #FFFFFF;
   text-decoration: none;
}
a.white:hover
{
   color: #31B2FE;
   text-decoration: none;
}
</style>
<style type="text/css">
#Image2
{
   border: 0px #000000 solid;
}
#Image1
{
   border: 0px #000000 solid;
}
#Image3
{
   border: 0px #000000 solid;
}
#wb_TextMenu1
{
   background-color: transparent;
   color :#000000;
   font-family: 'Lucida Sans Unicode';
   font-size: 20px;
}
#wb_TextMenu1 span
{
   margin: 0 35px 0 0px;
}
#wb_Form1
{
   background-color: #000000;
   border: 0px #000000 solid;
}
#wb_Text10 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text10 div
{
   text-align: center;
}
#wb_Text9 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text9 div
{
   text-align: center;
}
#wb_Text11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text11 div
{
   text-align: center;
}
#wb_Text12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text12 div
{
   text-align: center;
}
#wb_Text14 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text14 div
{
   text-align: center;
}
#wb_Text13 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text13 div
{
   text-align: center;
}
#wb_Text15 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text15 div
{
   text-align: center;
}
#wb_Text16 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text16 div
{
   text-align: center;
}
#wb_Text17 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text17 div
{
   text-align: center;
}
#wb_Text18 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text18 div
{
   text-align: center;
}
#wb_Text19 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text19 div
{
   text-align: center;
}
#wb_Text20 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text20 div
{
   text-align: center;
}
#wb_Text21 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text21 div
{
   text-align: center;
}
#wb_Text22 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text22 div
{
   text-align: center;
}
#Editbox1
{
   border: 0px #A9A9A9 solid;
   background-color: #286A9B;
   color :#000000;
   font-family: Arial;
   font-size: 16px;
   text-align: left;
   vertical-align: middle;
}
#Editbox2
{
   border: 0px #A9A9A9 solid;
   background-color: #286A9B;
   color :#000000;
   font-family: Arial;
   font-size: 16px;
   text-align: left;
   vertical-align: middle;
}
#Editbox3
{
   border: 0px #A9A9A9 solid;
   background-color: #286A9B;
   color :#000000;
   font-family: Arial;
   font-size: 16px;
   text-align: left;
   vertical-align: middle;
}
#Editbox4
{
   border: 0px #A9A9A9 solid;
   background-color: #286A9B;
   color :#000000;
   font-family: Arial;
   font-size: 16px;
   text-align: left;
   vertical-align: middle;
}
#Editbox5
{
   border: 0px #A9A9A9 solid;
   background-color: #286A9B;
   color :#000000;
   font-family: Arial;
   font-size: 16px;
   text-align: left;
   vertical-align: middle;
}
#Editbox6
{
   border: 0px #A9A9A9 solid;
   background-color: #286A9B;
   color :#000000;
   font-family: Arial;
   font-size: 16px;
   text-align: left;
   vertical-align: middle;
}
#TextArea1
{
   border: 0px #A9A9A9 solid;
   background-color: #286A9B;
   color :#FFFFFF;
   font-family: Arial;
   font-size: 16px;
   text-align: left;
   resize: none;
}
#Button1
{
   border: 0px #FFFFFF solid;
   background-color: #286A9B;
   color: #FFFFFF;
   font-family: Arial;
   font-size: 16px;
}
#twitter
{
   border: 0px #000000 solid;
}
#facebook
{
   border: 0px #000000 solid;
}
#wordpress
{
   border: 0px #000000 solid;
}
#wb_Text7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text7 div
{
   text-align: center;
}
#wb_TextMenu2
{
   background-color: transparent;
   color :#000000;
   font-family: 'Lucida Sans Unicode';
   font-size: 15px;
}
#wb_TextMenu2 span
{
   margin: 0 35px 0 0px;
}
</style>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="wb.rotate.min.js"></script>
<script type="text/javascript" src="wwb9.min.js"></script>
</head>
<body>
   <div id="container">
      <div id="wb_Image2" style="position:absolute;left:0px;top:0px;width:960px;height:306px;z-index:22;">
         <img src="images/5_02.png" id="Image2" alt="" style="width:960px;height:306px;">
      </div>
      <div id="wb_Shape1" style="position:absolute;left:0px;top:303px;width:961px;height:95px;z-index:23;">
         <img src="images/img0001.png" id="Shape1" alt="" style="border-width:0;width:961px;height:95px;">
      </div>
      <div id="wb_Image1" style="position:absolute;left:0px;top:397px;width:960px;height:383px;z-index:24;">
         <img src="images/31.jpg" id="Image1" alt="" style="width:960px;height:383px;">
      </div>
      <div id="wb_Image3" style="position:absolute;left:0px;top:777px;width:960px;height:383px;z-index:25;">
         <img src="images/34.jpg" id="Image3" alt="" style="width:960px;height:383px;">
      </div>
      <div id="wb_Shape2" style="position:absolute;left:0px;top:1159px;width:961px;height:217px;z-index:26;">
         <img src="images/img0002.png" id="Shape2" alt="" style="border-width:0;width:961px;height:217px;">
      </div>
      <div id="wb_TextMenu1" style="position:absolute;left:47px;top:334px;width:866px;height:54px;text-align:center;z-index:27;">
         <span><a href="./index.html" class="white">HOME</a></span><span><a href="./webservices.html" class="white">OUR PROJECTS</a></span><span><a href="./softwareservices.html" class="white">SOFTWARE SERVICES</a></span><span><a href="./about.html" class="white">ABOUT US</a></span><span><a href="./contacts.php" class="white">CONTACT US</a></span>
      </div>
      <div id="wb_Form1" style="position:absolute;left:198px;top:405px;width:574px;height:588px;z-index:28;">
         <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1">
            <input type="hidden" name="formid" value="form1">
            <div id="wb_Text10" style="position:absolute;left:24px;top:18px;width:132px;height:22px;text-align:center;z-index:0;">
               <span style="color:#ffffff;font-family:'lucida sans unicode';font-size:15px;">Department:</span></div>
            <div id="wb_Text9" style="position:absolute;left:22px;top:18px;width:9px;height:18px;text-align:center;z-index:1;">
               <span style="color:#f50000;font-family:'lucida sans unicode';font-size:15px;">*</span></div>
            <div id="wb_Text11" style="position:absolute;left:21px;top:92px;width:9px;height:18px;text-align:center;z-index:2;">
               <span style="color:#f50000;font-family:'lucida sans unicode';font-size:15px;">*</span></div>
            <div id="wb_Text12" style="position:absolute;left:13px;top:92px;width:85px;height:44px;text-align:center;z-index:3;">
               <span style="color:#ffffff;font-family:'lucida sans unicode';font-size:15px;">First Name:</span></div>
            <div id="wb_Text14" style="position:absolute;left:13px;top:151px;width:83px;height:44px;text-align:center;z-index:4;">
               <span style="color:#ffffff;font-family:'lucida sans unicode';font-size:15px;">Last Name:</span></div>
            <div id="wb_Text13" style="position:absolute;left:23px;top:151px;width:9px;height:18px;text-align:center;z-index:5;">
               <span style="color:#f50000;font-family:'lucida sans unicode';font-size:15px;">*</span></div>
            <div id="wb_Text15" style="position:absolute;left:20px;top:206px;width:9px;height:18px;text-align:center;z-index:6;">
               <span style="color:#f50000;font-family:'lucida sans unicode';font-size:15px;">*</span></div>
            <div id="wb_Text16" style="position:absolute;left:12px;top:206px;width:113px;height:44px;text-align:center;z-index:7;">
               <span style="color:#ffffff;font-family:'lucida sans unicode';font-size:15px;">Primary Phone:</span></div>
            <div id="wb_Text17" style="position:absolute;left:20px;top:262px;width:9px;height:18px;text-align:center;z-index:8;">
               <span style="color:#f50000;font-family:'lucida sans unicode';font-size:15px;">*</span></div>
            <div id="wb_Text18" style="position:absolute;left:12px;top:260px;width:112px;height:44px;text-align:center;z-index:9;">
               <span style="color:#ffffff;font-family:'lucida sans unicode';font-size:15px;">Second Phone:</span></div>
            <div id="wb_Text19" style="position:absolute;left:23px;top:315px;width:9px;height:18px;text-align:center;z-index:10;">
               <span style="color:#f50000;font-family:'lucida sans unicode';font-size:15px;">*</span></div>
            <div id="wb_Text20" style="position:absolute;left:17px;top:314px;width:100px;height:22px;text-align:center;z-index:11;">
               <span style="color:#ffffff;font-family:'lucida sans unicode';font-size:15px;">E-Mail:</span></div>
            <div id="wb_Text21" style="position:absolute;left:21px;top:370px;width:9px;height:18px;text-align:center;z-index:12;">
               <span style="color:#f50000;font-family:'lucida sans unicode';font-size:15px;">*</span></div>
            <div id="wb_Text22" style="position:absolute;left:28px;top:370px;width:174px;height:22px;text-align:center;z-index:13;">
               <span style="color:#ffffff;font-family:'lucida sans unicode';font-size:15px;">How can we help:</span></div>
            <input type="text" id="Editbox1" style="position:absolute;left:27px;top:41px;width:241px;height:30px;line-height:30px;z-index:14;" name="Department" value="">
            <input type="text" id="Editbox2" style="position:absolute;left:27px;top:116px;width:517px;height:30px;line-height:30px;z-index:15;" name="First" value="">
            <input type="text" id="Editbox3" style="position:absolute;left:27px;top:173px;width:517px;height:30px;line-height:30px;z-index:16;" name="Last" value="">
            <input type="text" id="Editbox5" style="position:absolute;left:27px;top:228px;width:517px;height:30px;line-height:30px;z-index:17;" name="Primary" value="">
            <input type="text" id="Editbox4" style="position:absolute;left:28px;top:281px;width:517px;height:30px;line-height:30px;z-index:18;" name="Second" value="">
            <input type="text" id="Editbox6" style="position:absolute;left:27px;top:335px;width:517px;height:30px;line-height:30px;z-index:19;" name="Email" value="">
            <textarea name="How can we help" id="TextArea1" style="position:absolute;left:27px;top:391px;width:517px;height:118px;z-index:20;" rows="5" cols="69"></textarea>
            <input type="submit" id="Button1" onmouseover="Animate('Button1', '', '', '', '', '50', 500, '');return false;" onmouseout="Animate('Button1', '', '', '', '', '100', 500, '');return false;" name="" value="Submit" style="position:absolute;left:209px;top:537px;width:150px;height:28px;z-index:21;">
         </form>
      </div>
      <div id="wb_twitter" style="position:absolute;left:166px;top:1242px;width:66px;height:35px;z-index:29;">
         <a href="https://twitter.com/ware_soft_alien" target="_blank" onmouseover="Animate('wb_twitter', '', '', '', '', '50', 500, '');return false;" onmouseout="Animate('wb_twitter', '', '', '', '', '100', 500, '');return false;"><img src="images/10_22.png" id="twitter" alt="" style="width:66px;height:35px;"></a>
      </div>
      <div id="wb_facebook" style="position:absolute;left:445px;top:1223px;width:70px;height:69px;z-index:30;">
         <a href="https://www.facebook.com/WareSoftAlien?ref=hl" target="_blank" onmouseover="Animate('wb_facebook', '', '', '', '', '50', 500, '');return false;" onmouseout="Animate('wb_facebook', '', '', '', '', '100', 500, '');return false;"><img src="images/11_20.png" id="facebook" alt="" style="width:70px;height:69px;"></a>
      </div>
      <div id="wb_wordpress" style="position:absolute;left:712px;top:1235px;width:48px;height:49px;z-index:31;">
         <a href="http://waresoftalien.wordpress.com/" target="_blank" onmouseover="Animate('wb_wordpress', '', '', '', '', '50', 500, '');return false;" onmouseout="Animate('wb_wordpress', '', '', '', '', '100', 500, '');return false;"><img src="images/12_20.png" id="wordpress" alt="" style="width:48px;height:49px;"></a>
      </div>
      <div id="wb_Text7" style="position:absolute;left:435px;top:1181px;width:90px;height:21px;text-align:center;z-index:32;">
         <span style="color:#ffffff;font-family:'lucida sans unicode';font-size:17px;">Join us:</span>
      </div>
      <div id="wb_TextMenu2" style="position:absolute;left:47px;top:1307px;width:866px;height:54px;text-align:center;z-index:33;">
         <span><a href="./index.html" class="white">HOME</a></span><span><a href="./webservices.html" class="white">OUR PROJECTS</a></span><span><a href="./softwareservices.html" class="white">SOFTWARE SERVICES</a></span><span><a href="./about.html" class="white">ABOUT US</a></span><span><a href="./contacts.php" class="white">CONTACT US</a></span>
      </div>
   </div>
</body>
</html>