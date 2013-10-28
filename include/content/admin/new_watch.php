<form action="admin.php?&op=new_watch" method="post" name="page_form" id="page_form" enctype="multipart/form-data">
    <table align="center" border="0">
        <tr>
            <th colspan="2" id="sub_head" align="left">
                Add new Gadget
            </th>
        </tr>
        <tr>
            <td align="right">
                <label>Category:</label>
            </td>
            <td>
                <select name="i_cat" id="i_cat" style="width: 202px;" >
                    <option >Laptops</option>
                    <option >Modems</option>
                    <option >Ipods</option>
                </select>
            </td>
        </tr>
        <tr valign="top">
            <td align="right">

                <label>Brand:</label>
            </td>
            <td>
                <select name="b_name" id="b_name" style="width: 202px;" onchange="newBrandField()">
                    <?php
                      $query = "select B_NAME from brand";
                       $db_man = new DBMan();
                       $result = $db_man->send_query($query);
                       while ($brand = mysql_fetch_array($result)){
                           echo "<option>".$brand['B_NAME']."</option>";
                       }
                     ?>
                    <option >New brand</option>
                </select><b id="n_bname"></b>
            </td>
        </tr>
        <tr valign="top">
            <td align="right">
                <label>Model:</label>
            </td>
            <td>
                <input type="text" size="28" name="i_model" id="i_model">
            </td>
        </tr>
        <tr valign="top">
            <td align="right">
                <label>Price:</label>
            </td>
            <td>
                <input type="text" size="28" name="i_price">
            </td>
        </tr>
        <tr valign="top">
            <td align="right">
                <label>Picture:</label>
            </td>
            <td>
                <input type="file" name="i_pic" value="" style="width: 202px;" title="Browse item picture" />
            </td>
        </tr>
        <tr valign="top">
            <td align="right">
                <label>Description:</label>
            </td>
            <td>
                <textarea name="i_desc" id="i_desc" rows="4" cols="20" style="width: 202px;">
                </textarea>
            </td>
        </tr>
        <tr valign="top">
            <td align="right">
                <label>Sex Specification:</label>
            </td>
            <td>
                <input type="radio" name="i_sex" checked="" value="men and ladies"/>Men and Ladies<br />
                <input type="radio" name="i_sex" value="men" />Men <br />
                <input type="radio" name="i_sex" value="ladies" />Ladies <br />
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td align="right">
                <input type="submit" value="Add Gadget" name="add_watch" title="Click to add new item">
            </td>
        </tr>
    </table>
</form>


