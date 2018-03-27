<?
include("security.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=ADMIN_TITLE?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<? include("inc/common_js.inc.php"); ?>
<link rel="stylesheet" href="images/styles.css" type="text/css">
</head>
<body>
<table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td><? include("inc/header.inc.php") ?></td> 
	</tr>
	<tr valign="top">
		<td><table width="1000" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td valign="top" width="120"><? include("inc/menu.inc.php") ?></td>
					<td width="866" valign="top">
						<table width="100%" border="0" class="tbl_main" cellpadding="2" cellspacing="1">
							<tr>
								<td class="tbl_mi" align="center">Bienvenido</td>
							</tr>
							<tr class="light">
								<td align="center">Bienvenido al panel administrativo de <?=SITE_NAME?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><? include("inc/footer.inc.php") ?>
		</td>
	</tr>
</table>
</body>
</html>