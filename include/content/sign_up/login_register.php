<?php
$field = array('u_fname'=>"", 'u_lname'=>"", 'u_mail'=>"", 'u_pass'=>"", 'cu_pass'=>"", 'u_tel'=>"", 'a_line1'=>"Line1", 'a_line2'=>"Line2", 'ap_code'=>"");
if(isset ($_POST['sign_up'])){
    $field = array('u_fname'=>$_POST['u_fname'], 'u_lname'=>$_POST['u_lname'], 'u_mail'=>$_POST['u_mail'], 'u_pass'=>$_POST['u_pass'],
                   'cu_pass'=>$_POST['cu_pass'], 'u_tel'=>$_POST['u_tel'], 'a_line1'=>$_POST['a_line1'], 'a_line2'=>$_POST['a_line2'],
                   'ap_code'=>$_POST['ap_code']);
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="page_form" id="page_form" enctype="multipart/form-data">
    <table align="center" width="100%" border="0">
        <tr>
            <td valign="top" align="right">
                <table border="0" width="65%" id="tbl_login">
                    <tr>
                        <th align="left">
                            Log In
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <b>
                                <?php
                                  echo $_SESSION['err'];
                                ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;&nbsp;&nbsp;E-mail<br />
                            &nbsp;&nbsp;&nbsp;<input type="text" size="32" name="lu_mail" >
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;&nbsp;&nbsp;Password<br />
                            &nbsp;&nbsp;&nbsp;<input type="password" size="33" name="lu_pass">
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <a href="sign_up.php?&op=forgot_pass">Forgot password?</a> <input type="submit" value="Sign In" name="sign_in">
                        </td>
                    </tr>
                </table>
            </td>
            <td width="60%">
                <table align="center" width="70%" border="0" id="tbl_register">
                    <tr>
                        <th colspan="2" align="left">
                            Register
                        </th>
                    </tr>
                    <tr valign="top">
                        <td align="left" colspan="2">
                            <b>*</b> Denotes a required field
                            <?php
                            if(isset ($_POST['sign_up'])){
                                $user = new User();
                                $u_mail = $_POST['u_mail'];
                                $u_pass = $_POST['u_pass'];
                                $cu_pass = $_POST['cu_pass'];
                                $u_role = 'buyer';
                                $u_fname = $_POST['u_fname'];
                                $u_lname = $_POST['u_lname'];
                                $u_tel = $_POST['u_tel'];
                                $u_address = $_POST['a_line1'].'-'.$_POST['a_line2'].'-'.$_POST['ap_code'];
                                $u_ex = new UserException();
                                $inputs = array('u_mail'=>$_POST['u_mail'],'u_pass'=>$_POST['u_pass'],'cu_pass'=>$_POST['cu_pass'],'u_fname'=>$_POST['u_fname'],
                                                'u_lname'=>$_POST['u_lname']);
                                try{
                                    $u_ex->required_inputs_exception($inputs);
                                    $u_ex->invalid_string_input($_POST['u_fname'], "Firts name");
                                    $u_ex->invalid_string_input($_POST['u_lname'], "Last name");
                                    $u_ex->validateEamail($u_mail);
                                    $u_ex->invalid_input_range_exception($_POST['u_pass'], "Password", 6, 10, "characters");
                                    $u_ex->compare($_POST['u_pass'], $_POST['cu_pass'], "Password", "");
                                    if($user->register($u_mail, $u_pass, $u_role, $u_fname, $u_lname, $u_tel, $u_address) > 0){
                                        $field = array('u_fname'=>"", 'u_lname'=>"", 'u_mail'=>"", 'u_pass'=>"", 'cu_pass'=>"", 'u_tel'=>"", 'a_line1'=>"Line1", 'a_line2'=>"Line2", 'ap_code'=>"");
                                    };
                                }
                                catch(Exception $e)
                                {
                                    echo $e->getMessage();
                                }
                            }
                            ?>
                        </td>
                    </tr>
                    <tr align="right" valign="top">
                        <td width="40%">
                            <label>First name:</label>
                        </td>
                        <td align="left" width="60%">
                           <input type="text" size="30" name="u_fname" id="u_fname" value="<?php echo $field['u_fname'] ?>">
                           <b id="u_rfname">*</b><br /><b id="u_fnamemsg"></b>
                        </td>
                    </tr>
                    <tr align="right" valign="top">
                        <td valign="top">
                            <label>Last name:</label>
                        </td>
                        <td align="left">
                            <input type="text" size="30" name="u_lname" id="u_lname" value="<?php echo $field['u_lname'] ?>">
                            <b id="u_rlname">*</b><br /><b id="u_lnamemsg"></b>
                        </td>
                    </tr>
                    <tr align="right" valign="top">
                        <td>
                            <label>Email:</label>
                        </td>
                        <td align="left">
                            <input type="text" size="30" name="u_mail" id="u_mail" value="<?php echo $field['u_mail'] ?>">
                            <b id="ur_mail">*</b><br /><b id="u_mailmsg"></b>
                        </td>
                    </tr>
                    <tr align="right" valign="top">
                        <td>
                            <label>Password:</label>
                        </td>
                        <td align="left">
                            <input type="password" size="31" name="u_pass" id="u_pass" value="<?php echo $field['u_pass'] ?>">
                            <b id="u_rpass">*</b><br /><b id="u_passmsg"></b>
                        </td>
                    </tr>
                    <tr align="right" valign="top">
                        <td>
                            <label>Confirm password:</label>
                        </td>
                        <td align="left">
                            <input type="password" size="31" name="cu_pass" id="cu_pass" value="<?php echo $field['cu_pass'] ?>">
                            <b id="cu_rpass">*</b><br /><b id="cu_passmsg"></b>
                        </td>
                    </tr>
                    <tr align="right" valign="top">
                        <td>
                            <label>Phone number:</label>
                        </td>
                        <td align="left">
                            <input type="text" size="30" name="u_tel" id="u_tel" value="<?php echo $field['u_tel'] ?>">
                            <br /><b id="u_telmsg"></b>
                        </td>
                    </tr>
                    <tr align="right" valign="top">
                        <td valign="top">
                            <label>Address:</label>
                        </td>
                        <td align="left">
                            <b id="l1" >
                                <input type="text" size="30" id="line1" name="a_line1" style="color: gray" value="<?php echo $field['a_line1'] ?>">
                                <b id="u_line1msg"></b>
                            </b><br />
                            <b id="l2" ><input type="text" size="30" id="line2" name="a_line2" style="color: gray" value="<?php echo $field['a_line2'] ?>"></b>
                        </td>
                    </tr>
                    <tr align="right" valign="top">
                        <td>
                            <label>Postal code:</label>
                        </td>
                        <td align="left">
                            <input type="text" size="30" name="ap_code" value="<?php echo $field['ap_code'] ?>">
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                        </td>
                        <td align="right" style="padding-right:  20px">
                            <input type="submit" value="Sign Up" name="sign_up">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<br />

