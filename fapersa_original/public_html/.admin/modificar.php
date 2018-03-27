<?
include("security.inc.php");

if ($_POST[e] == 1){
	if (invalidUserPass($_POST[new_user])) {
		$errors[] = "Formato de nombre de usuario no válido";
	}
	
	if (invalidUserPass($_POST[new_pass])) {
		$errors[] = "Formato de contraseña no válido";
	}
	
	if (!is_array($errors)) {
		if ($_POST[new_pass] AND $_POST[new_pass_r]) {
			if ($_POST[new_pass] <> $_POST[new_pass_r]) {
				$errors[] = "Las contraseñas no concuerdan";
			}
		}else{
			$errors[] = "Las contraseñas no concuerdan";
		}
	}

	if (!is_array($errors)){
		// UPDATE
		$sql = "UPDATE 
					admin_users 
				SET 
					username = '" . $_POST[new_user] . "', 
					password = '" . encryptPassword($_POST[new_pass]) . "' 
				WHERE 
					id = '" . $_SESSION[SESSION_ADMIN][id] . "'";

		$result = mysql_query($sql);

		header("location: ../logout.php");
		exit;
	}	
}
?>
<? include("header.inc.php") ?>
<table width="100%" border="0" class="tbl_main" cellpadding="2" cellspacing="1">
                        	<tr align="center">
                        		<td class="tbl_mi">Modifique sus datos de acceso</td>
                       		</tr>
                        	<tr class="light">
                        		<td>
									<table border="0" align="center" cellpadding="2" cellspacing="2" class="tbl_main">
										<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="frm">
											<?
											if (is_array($errors)) {
												foreach ($errors AS $key => $error) {
											?>
											<tr>
												<td align="right"></td>
												<td class="txt_error"><b>Error:</b> <?=$error?></td>
											</tr>
											<?
												}
											}else{
											?>
											<tr>
												<td>&nbsp;</td>
												<td><span class="txt_error">* Campos requeridos</span></td>
											</tr>
											<?
											}
											?>
											<tr>
												<td>Nuevo nombre de usuario  <span class="txt_error">*</span></td>
												<td><input name="new_user" type="text" class="fields" id="new_user" value="<?=$_POST[new_user]?>" size="20" maxlength="15"></td>
											</tr>
											<tr>
												<td>Nueva contrase&ntilde;a  <span class="txt_error">*</span></td>
												<td><input name="new_pass" type="password" class="fields" id="new_pass" size="43" maxlength="50"></td>
											</tr>
											<tr>
												<td>Seguridad de contrase&ntilde;a</td>
												<td><div id="meter"></div></td>
											</tr>
											<tr>
												<td>Nueva contrase&ntilde;a  (repita) <span class="txt_error">*</span> </td>
												<td><input name="new_pass_r" type="password" class="fields" id="new_pass_r" size="43" maxlength="50"></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td><b class="txt_error">Nota:</b> la contrase&ntilde;a ser&aacute; encriptada</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td><b class="txt_error">Formato de los campos:</b> [A-Z], [0-9], -, _</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
										    	<td><input type="submit" name="Submit" value="Actualizar informaci&oacute;n" class="fields">
													<input name="e" type="hidden" id="e" value="1"></td>
											</tr>
										</form>
									</table>
								</td>
                        	</tr>
                        	</table>
<? include("footer.inc.php") ?>						