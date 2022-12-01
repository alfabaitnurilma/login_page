<?php include("inc_header.php")?>
<h3>Fprgot Password</h3>
<?php
if (isset($_SESSION['members_email']) !=''){
    header("location");
    exit();
}
$err ="";
$suskse ="";
$email ="";

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    if($email == ''){
        $err = "Silakan masukkan email";
    }else{
        $sql1= "select *from members where email = '$email";
        $q1 = mysqli_query($konesksi,$sql1);
        $n1 = mysqli_num_rows($q1);
        if($n1 < 1){
            $err = "Email: <b>$email</b> tidak ditemukan";
            
        }
    }
    if(empty($err)){
        $token_ganti_password = md5(rand(0,1000));
        $judul_email = "Ganti Password";
        $sisi_email = "Seseorang meminta untuk melakukan perubahan password. Silahkan klik link di bawah ini:<br/>";
        $sisi_email = url_dasar()."/ganti password.php?email=$email&token=$token_ganti_password";
        kirim_email($email,$email,$judul_email,$sisi_email);

        $sql1 ="update members set token_ganti_password='$token_ganti_password' where email='$email'";
        mysql1_query($konesksi,$sql1);
        $suskses= "Link ganti password sudah dikirimkan ke email anda.";

    }
}
?>
<?php if($err){echo"<div class='error'>$err</div>";}?>
<?php if(sukses){echo"<div class='sukses'>$sukses</div>";}?>

<form acttion=""  method="POST">
    <table>
        <tr>
            <td class="label">Email</td>
            <td><input type="text" name="email" class="input" value="<?php echo $email?>"td>
        </tr>  
        <tr>
            <td></td>  
            <td>
                <input type="submit" name="submit" value="Forgot Password" class="tbl-biru"/>
</td>
</tr>
</table>
</form>
<?php include("inc_footer.php");?>