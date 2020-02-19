<?php
  $arr_fonts = ['ABeeZee', 'Bitter', 'Brawler', 'Buenard', 'Courgette', 'Delius', 'Fenix', 'Gudea', 'Halant', 'Heebo', 'Hind', 'K2D', 'Khula', 'Lora', 'Delius', 'Encode Sans', 'Esteban', 'Laila', 'Mukta', 'Patua One', 'Pavanam', 'Roboto', 'Sniglet', 'Strait'];
    $t = (strtotime(date("Y-m-d"))-strtotime("2010-01-01"))/86400 % count($arr_fonts);
    $font_family = $arr_fonts[$t];

  $color = ['background-color'=>'#F8F8F8','background-shade-color'=>'#EEEEEE','border-color'=>'#E7E7E7','default'=>'#777','hover'=>'#333','bhover'=>'#5E5E5E','active'=>'#555','active-background'=>'#D5D5D5', 'default-background'=>'white'];
  $color = ['background-color'=>'#31B0D5','background-shade-color'=>'#EEEEEE','border-color'=>'#7DC4F5','default'=>'white','hover'=>'#e1e1e1','bhover'=>'#5E5E5E','active'=>'#d3d3d3','active-background'=>'#006BFF', 'default-background'=>'white'];
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Backend Solutions for Single Page Websites and Mobile Applications Session | Database | Email | Assets Store | CDN | Chat | Cloud Messaging | Push Notifications | Licenses also Prebuild Applications">

<title>HoneyWeb.Org - Delightful Web Creations</title>
<meta name="keywords" content="Licenses,Database,Email,Files,CDN,Chat,Push Notifications" />
<meta name="robots" content="index,follow,archive" />

<meta name="geo.position" content="," />
<meta name="geo.placename" content="" />
<meta name="geo.region" content="" />

<base href="/">
<!-- ABeeZee, Bitter, Brawler, Buenard, Courgette, Delius, Fenix, Gudea, Halant, Heebo, Hind, K2D, Khula, Lora
Delius, Encode Sans, Esteban, Laila, Mukta, Patua One, Pavanam, Roboto, Sniglet, Strait -->
<link rel="icon" type="image/x-icon" href="assets/images/honeyweb_icon.png">
<link href='https://fonts.googleapis.com/css?family=<?php echo $font_family; ?>' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
:root{
  --font-family:<?php echo $font_family; ?>;
  --nav-bg-color: <?php echo $color['background-color']; ?>; 
  --nav-bg-shade-color: <?php echo $color['background-shade-color']; ?>; 
  --nav-border-color: <?php echo $color['border-color']; ?>; 
  --nav-link-color: <?php echo $color['default']; ?>; 
  --nav-hover-color: yellow; 
  --nav-brand-hover-color: <?php echo $color['bhover']; ?>; 
  --nav-active-link-color: <?php echo $color['active']; ?>; 
  --nav-active-link-bg-color: <?php echo $color['active-background']; ?>; 
  --nav-brand-hover-color: <?php echo $color['default-background']; ?>; 
  --nav-toggle-color: #3B5998; 
  --nav-toggle-lines-color: <?php echo $color['background-shade-color']; ?>; 
}
</style>
<link rel="stylesheet" href="assets/css/app.css">
<?php if($_SESSION[$app_key]["id"]): ?>
<link rel="stylesheet" href="assets/hw_chat_window/2.0/css/hw_chat_window_.css">
<?php endif; ?>
<!-- <script>
function loadFile(path, type){
  if (type=="js"){
    var fileref=document.createElement('script');
    fileref.setAttribute("type","text/javascript");
    fileref.setAttribute("src", path);
  }
  else if (type=="css"){
    var fileref=document.createElement("link");
    fileref.setAttribute("rel", "stylesheet");
    fileref.setAttribute("type", "text/css");
    fileref.setAttribute("href", path);
  }
  document.getElementsByTagName("head")[0].appendChild(fileref);
}
function addStyle(css){
  head = document.head || document.getElementsByTagName('head')[0],
  style = document.createElement('style');

  head.appendChild(style);

  style.type = 'text/css';
  if (style.styleSheet){
    // This is required for IE8 and below.
    style.styleSheet.cssText = css;
  } else {
    style.appendChild(document.createTextNode(css));
  }
}
const arr_fonts = ['ABeeZee', 'Bitter', 'Brawler', 'Buenard', 'Courgette', 'Delius', 'Fenix', 'Gudea', 'Halant', 'Heebo', 'Hind', 'K2D', 'Khula', 'Lora', 'Delius', 'Encode Sans', 'Esteban', 'Laila', 'Mukta', 'Patua One', 'Pavanam', 'Roboto', 'Sniglet', 'Strait'];

const today = new Date;
console.log(today.getDay());
console.log(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDay());
console.log(Date.parse(today.getFullYear()+'-'+today.getMonth()+'-'+today.getDay()));
const t = Date.parse(today.getFullYear()+'-'+today.getMonth()+'-'+(today.getDay()+1))/86400000 % arr_fonts.length;
const font_family = arr_fonts[parseInt(t)];
loadFile('https://fonts.googleapis.com/css?family='+font_family,'css');
addStyle('body { font-family: '+font_family+'; }');
console.log(parseInt(t));
console.log(font_family);
</script> -->
</script>