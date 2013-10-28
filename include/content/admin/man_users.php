<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$admin = new Admin();
$users = $admin->getAllUsers();
?>
<form id="man_purchase_form" name="man_purchase_form" action="admin.php?&op=users" method="post">
    <table width="100%">
        <tr>
            <td colspan="1" width="10%">
                <b id="cat_head">
                   Users
                </b>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                echo "<table width='100%' border='0' ><tr align='left'>
                      <th>Name</th><th>Role</th><th>Tel</th><th>Address</th><th>E-mail</th><th>Settings</th></tr>";
                foreach ($users as $user){
                    if($user['U_ROLE'] == 'admin' && $_COOKIE['u_mail'] != $user['U_MAIL']){
                        $setting = "Unsubscribe";
                    }
                    else{
                        if($user['U_SUBSC']== 'Yes'){
                            $setting = "<a href='admin.php?&op=users&ref=unsubscribe&mail=".$user['U_MAIL']."' title='Unsubscribe user'>Unsubscribe</a>";
                        }
                        else{
                            $setting = "<a href='admin.php?&op=users&ref=subscribe&mail=".$user['U_MAIL']."' title='Subscribe user'>Subscribe</a>";
                        }
                    }
                    echo "<tr><td>".$user['U_LNAME']." ".$user['U_FNAME']."</td><td>".$user['U_ROLE']."</td><td>".$user['U_TEL']."</td><td>
                         ".$user['U_ADDRESS']."<td>".$user['U_MAIL']."</td><td>$setting</td></tr>";
                }
                echo "<table>"
                ?>
            </td>
        </tr>
    </table>
</form>