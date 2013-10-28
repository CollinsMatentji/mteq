<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<form action="sign_up.php?&op=forgot_pass" method="post">
    <table align="center" width="100%" border="0">
        <tr>
            <td valign="top" align="center">
                <table border="0"  id="tbl_login">
                    <tr>
                        <th align="left">
                            Request Password
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
                            &nbsp;&nbsp;&nbsp;E-mail or username<br />
                            &nbsp;&nbsp;&nbsp;<input type="text" size="32" name="u_mail" >
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="padding-top: 5px">
                            &nbsp;&nbsp;&nbsp;<input type="submit" value="Send" name="request_pass" style="width: 65px"> <input type="submit" value="Cancel" name="cancel_pass_request">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
