/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}
function validateName(name){
    var filter = /^[A-Za-z]+$/;
    if(filter.test(name)){
        return true;
    }
    else  {
        return false;
    }
}
function validateNum(num){
    var filter = /^[0-9]+$/;
    if(filter.test(num)){
        return true;
    }
    else  {
        return false;
    }
}
$(document).ready(function() {
   /*
    *Registration form validation*/
   document.getElementById('search').value = "Search for item";
    $('#search').click(function() {
        document.getElementById('search').value = "";
    });
    $('#search').mouseout(function() {
         var search = $('#search').val();
        if(search == ""){
           document.getElementById('search').value = "Search for item";
        }
        else{
            if(search != "Search for item"){
                document.getElementById('search_div').innerHTML = '<input type="text" size="55" id="search" value="'+search+'"name="search_term" style="color: black">';
            }
        }
    });
   $('#u_mail').bind('change mouseout',function() {
        var sEmail = $('#u_mail').val();
        if ($.trim(sEmail).length == 0) {
            document.getElementById('ur_mail').innerHTML = "*";
            e.preventDefault();
        }
        if(sEmail != ""){
            document.getElementById('ur_mail').innerHTML = "";
        }
        if (!validateEmail(sEmail)) {
            document.getElementById('u_mailmsg').innerHTML = "Invalid email address";
            e.preventDefault();
        }
        else{
            document.getElementById('u_mailmsg').innerHTML = "";
        }
    });
    $('#u_lname').bind('change mouseout',function() {
        var name = $('#u_lname').val();
        if ($.trim(name).length == 0) {
            document.getElementById('u_rlname').innerHTML = "*";
            e.preventDefault();
        }
        if(name != ""){
            document.getElementById('u_rlname').innerHTML = "";
        }
        if ($.trim(name).length < 3) {
            document.getElementById('u_lnamemsg').innerHTML = "Last name must contain more than 3 letters";
            e.preventDefault();
        }
        if(!validateName(name)){
            document.getElementById('u_lnamemsg').innerHTML = "Last name must contain letters only";
            e.preventDefault();
        }
        else{
            document.getElementById('u_lnamemsg').innerHTML = "";
            e.preventDefault();
        }
    });
    $('#u_fname').bind('change mouseout',function() {
        var name = $('#u_fname').val();
        if ($.trim(name).length == 0) {
            document.getElementById('u_rfname').innerHTML = "*";
            e.preventDefault();
        }
        if(name != ""){
            document.getElementById('u_rfname').innerHTML = "";
        }
        if ($.trim(name).length < 3) {
            document.getElementById('u_fnamemsg').innerHTML = "Last name must contain more than 3 letters";
            e.preventDefault();
        }
         if(!validateName(name)){
            document.getElementById('u_fnamemsg').innerHTML = "First name must contain letters only";
            e.preventDefault();
        }
        else{
            document.getElementById('u_fnamemsg').innerHTML = "";
            e.preventDefault();
        }
    });
    $('#u_pass').bind('change mouseout',function() {
        var u_pass = $('#u_pass').val();
        if ($.trim(u_pass).length == 0) {
            document.getElementById('u_rpass').innerHTML = "*";
            e.preventDefault();
        }
        if(u_pass != ""){
            document.getElementById('u_rpass').innerHTML = "";
        }
        if ($.trim(u_pass).length < 6) {
            document.getElementById('u_passmsg').innerHTML = "Password must contain more than five characters";
            e.preventDefault();
        }
        else{
            document.getElementById('u_passmsg').innerHTML = "";
            e.preventDefault();
        }
    });
    $('#cu_pass').bind('change mouseout',function() {
        var cu_pass = $('#cu_pass').val();
        var u_pass = $('#u_pass').val();
        if ($.trim(cu_pass).length == 0) {
            document.getElementById('cu_rpass').innerHTML = "*";
            e.preventDefault();
        }
        if(cu_pass != ""){
            document.getElementById('cu_rpass').innerHTML = "";
        }
        if(u_pass != cu_pass){
            document.getElementById('cu_passmsg').innerHTML = "Password must match";
            e.preventDefault();
        }
        else{
            document.getElementById('cu_passmsg').innerHTML = "";
            e.preventDefault();
        }
    });
    $('#u_tel').bind('change mouseout',function() {
        var num = $('#u_tel').val();
        if(num != ""){
            if ($.trim(num).length < 10 || $.trim(num).length > 10) {
                document.getElementById('u_telmsg').innerHTML = "Telephone number must contain 10 digits";
                e.preventDefault();
            }
            if (!validateNum(num)) {
                document.getElementById('u_telmsg').innerHTML = "Invalid telephone number";
                e.preventDefault();
            }
            else{
                document.getElementById('u_telmsg').innerHTML = "";
            }
        }
    });
    /*
     *Registration form manipulation*/
    $('#line1').click(function() {
        document.getElementById('line1').value = "";
    });
    $('#line1').mouseout(function() {
         var line1 = $('#line1').val();
        if(line1 == ""){
           document.getElementById('line1').value = "Line1";
        }
        else{
            if(line1 != "Line1"){
                document.getElementById('l1').innerHTML = '<input type="text" size="30" id="line1" value="'+line1+'"name="a_line1" style="color: black">';
            }
        }
    });
     document.getElementById('line2').value = "Line2";
    $('#line2').click(function() {
        document.getElementById('line2').value = "";
    });
    $('#line2').mouseout(function() {
         var line2 = $('#line2').val();
        if(line2 == ""){
           document.getElementById('line2').value = "Line2";
        }
        else{
            if(line2 != "Line2"){
                document.getElementById('l2').innerHTML = '<input type="text" size="30" id="line2" value="'+line2+'"name="a_line2" style="color: black">';
            }
        }
    });
});