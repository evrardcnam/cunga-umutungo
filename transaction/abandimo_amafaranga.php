<?php

/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
 
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)788802332 / (250)728802332
E-mail : info@code.rw
Website : www.code.rw

*/
session_start();
$page_access = 1;

include_once("../users/session_check.php");

include_once("../inc/dbconfig.php");

include_once("../global/make_safe.php");

$get_company = mysql_query("SELECT * FROM company");
$show_company = mysql_fetch_array($get_company);


if(isset($_GET['start'])) { $start = $_GET['start']; } else { $start = 0; };
$previous_page = ($start - $_SESSION['records_per_page']);
$next_page = ($start + $_SESSION['records_per_page']);


$get_total_items = mysql_query("SELECT * FROM abonagurije WHERE employee_id=".$_SESSION['employee_id']."");
$total_records = mysql_num_rows($get_total_items);
$get_items = mysql_query("SELECT * FROM abonagurije WHERE employee_id=".$_SESSION['employee_id']." ORDER BY id DESC LIMIT $start, " . $_SESSION['records_per_page'] . "");


if(isset($_GET['query'])) {
$query =mysql_real_escape_string($_GET['query']);
$get_items = mysql_query("SELECT * FROM  abonagurije WHERE (uwonagurije LIKE '%$query%') OR (ntakurenza LIKE '%$query%') AND employee_id=".$_SESSION['employee_id']."");
$total_records = mysql_num_rows($get_items);
$next_page = $total_records;
};

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Refresh" content="<?php echo $show_company['session_timeout'] ?>;URL=../timeout.php" />

<link rel="icon" type="image/vnd.microsoft.icon" href="../favicon.ico" />

<title><?php include("../title.php");?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../scripts/form_assist.js"></script>
</head>
<body>
<div id="wrap">
<div id="header"><table><tr><td><img src="../images/company_logo.jpg" alt="<?php echo $show_company['company_name'] ?>" /></td><td><br /></td>
  </tr></table></div>
  <div id="logininfo">
    <?php include_once("../users/login_info.php") ?>
  </div>
  <div id="navbar">
    <?php include_once("navbar.php") ?>
  </div>
  <div id="content">
    <form id="items" name="items" method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
      <table class="fulltable">
        <tr>
          <td class="halftopcell"><h1>URUTONDE RWABANDIMO AMAFARANGA </h1>
            <table class="fulltable">
              <tr>
                <td><input name="query" type="text" class="entrytext" id="query" onclick="this.value=''" value="shakira hano" /></td>
              </tr>
              <tr>
                <td><input name="create" type="button" class="button" id="create" onclick="openWindow('andika_ukurimo_amafaranga.php')" value="ANDIKA UKURIMO AMAFARANGA" /></td>
              </tr>
          </table></td>
          <td class="halftopcell"><img src="../images/icons/amadeni.png" width="158" height="90" class="iconspacer" /></td>
        </tr>
      </table>
      <table class="fulltable">
        <tr>
          <td width="4%" class="tabletop">SIBA</td>
		  <td width="10%" class="tabletop">KWISHYURWA </td>
		  <td width="6%" class="tabletop">RAPORO </td>
          <td width="26%" class="tabletop">UNDIMO AMAFARANGA </td>
          <td width="12%" class="tabletop" align="right">NAMUGURIJE </td>
		  <td width="9%" class="tabletop" align="LEFT">TARIKI </td>
          <td width="11%" class="tabletop" align="RIGHT">AYISHYUWE</td>
		   <td width="12%" class="tabletop" align="RIGHT">ASIGAYE</td>
          <td width="10%" class="tabletop" align="right">NTAKURENZA</td>
	    </tr>
        <?php while($show_item = mysql_fetch_array($get_items)) { ?>
        
        <tr class="tablelist">
          <td class="tablerowborder"><a href="siba_ideni.php?id=<?php echo $show_item['id'] ?>" onClick="return confirm('Urifuza koko gusiba: <?php echo $show_item['uwonagurije'] ?> ?')"><img src="../images/icons/delete.png" alt="Gusiba" width="16" height="16" class="iconspacer" /></a></td>
		   <td class="tablerowborder" ><a href="javascript:openWindow('kwishyurwa.php?id=<?php echo $show_item['id'] ?>')"><img src="../images/icons/add.png" alt="KWISHYURA" width="16" height="16" class="iconspacer" /></a></td>
		   <td class="tablerowborder"><a href="javascript:openWindow('../global/print_ideni.php?id=<?php echo $show_item['id'] ?>')"><img src="../images/icons/print.png" alt="RAPORO" width="16" height="16" class="iconspacer" /></a></td>
          <td class="tablerowborder" ><?php echo $show_item['uwonagurije'] ?></td>
             <td class="tablerowborder" align="RIGHT"> <?php echo $show_company['currency_symbol'] ?> <?php echo number_format($show_item['namugurije'], 0)  ?></td>
          <td class="tablerowborder" align="LEFT"><span class="smalltext"><?php echo $show_item['namugurije_tariki'] ?></span></td>
          <td class="tablerowborder" align="RIGHT"> <?php echo $show_company['currency_symbol'] ?> <?php echo number_format($show_item['hishyuwe'], 0)  ?></td>
		  <td class="tablerowborder" align="RIGHT">
         <?php echo $show_company['currency_symbol'] ?> <?php echo number_format($show_item['asigaye'], 0)  ?></td>
          <td class="tablerowborder" align="right"><span class="smalltext"><?php echo $show_item['ntakurenza'] ?></span></td>
	    </tr>
        <?php } ?>
      </table>
      <table class="fulltable">
        <tr>
          <td class="pagination"><?php if ($start > 0) { ?>
              <a href="?start=<?php echo $previous_page ?>"><img src="../images/icons/previous.png" alt="Prevous Page" width="16" height="16" class="iconspacer" /></a>
              <?php } ?>
              <?php if ($next_page < $total_records) { ?>
              <a href="?start=<?php echo $next_page ?>"><img src="../images/icons/next.png" alt="Next Page" width="16" height="16" class="iconspacer" /></a>
              <?php } ?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>
