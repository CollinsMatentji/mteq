<?php
$address = explode('-',$_COOKIE['u_address']);
if(isset ($_COOKIE['u_tel'])){
    $u_tel = $_COOKIE['u_tel'];
}
else{
    $u_tel = "";
}
$user = array ('u_lname'=>$_COOKIE['u_lname'],'u_fname'=>$_COOKIE['u_fname'],'u_mail'=>$_COOKIE['u_mail'],'u_tel'=>$u_tel,
               'a_line1'=>$address[0],'a_line2'=>$address[1],'ap_code'=>$address[2]);
$label = array('Last name','First name','Username','Phone number','Address','','');
$u = new User();
echo '<form action="account.php?&update" method="post" name="page_form" id="page_form" enctype="multipart/form-data">
       <table align="left" width="100%" border="0">
        <tr>
            <th colspan="3" align="left" id="cat_head" align="center">
                Your account details<br /><br />
                <hr style="border:150px"/>
            </th>
        </tr>';
$i = 0;
foreach ($user as $index=>$value){
    if(!isset ($_GET['edit_account'])){
       echo "<tr align='left'><td width='40%'><b>$label[$i]</b>&nbsp;&nbsp;&nbsp;</td><td valign='top' align='left'>".$value."</td><td align='right'>";
       if($index != 'u_mail'){
                echo "<a href='account.php?edit_account=$index'>Edit</a></td></tr>";
           }
           else{
               echo "Edit</td></tr>";
           }
       echo '<tr>
                <th colspan="3" >
                    <hr style="border:150px"/>
                </th>
            </tr>';
    }
    else{
       if($_GET['edit_account']==$index){
            echo "<tr align='left' valign='top'><td width='20%'><b>$label[$i]</b>&nbsp;&nbsp;&nbsp;</td><td valign='top' align='left'>
                  <input type='text' value='$value' name='$index' size='30'><p>
                  <b>Enter your password to save changes.</b></p>
                  <input type='password' name='u_pass' size='31'><br /><br />
                  <input type='submit' value='Save' style='width:70px' name='save_account'><input type='submit' value='Cancel'></td>
                  <td align='right' width='20%'>
                  </td></tr>";
       }
       else{
           echo "<tr align='left'><td width='40%'><b>$label[$i]</b>&nbsp;&nbsp;&nbsp;</td><td valign='top' align='left'>".$value."</td><td align='right'>";
           if($index != 'u_mail'){
                echo "<a href='account.php?edit_account=$index'>Edit</a></td></tr>";
           }
           else{
               echo "Edit</td></tr>";
           }
       }
       echo '<tr>
                <th colspan="3" >
                    <hr style="border:150px"/>
                </th>
            </tr>';
    }
    $i++;
}
echo '<tr><td colspan="3" align="left">';
if(!isset ($_GET['change_pass'])){
    echo '<a href="account.php?&change_pass">Change your password</a>';
}
else{
    echo "<tr align='left' valign='top'><td width='20%'><b>New password</b>&nbsp;&nbsp;&nbsp;</td><td valign='top' align='left'>
                  <p><b>Enter your new password:</b><br />
                  <input type='password' value='' name='u_pass' size='30'><br /><br />
                  <b>Enter your old password to save changes.</b>
                  <input type='password' name='ou_pass' size='31'><br /><br /></p>
                  <input type='submit' value='Save' style='width:70px' name='save_account'><input type='submit' value='Cancel'></td>
                  <td align='right' width='20%'>
                  </td></tr>";
}
echo '</td></tr></table></form>';
?>