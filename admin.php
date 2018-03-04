<?php
session_start();
include_once "engine/verifyadmin.php";
include_once "include/lhead.php";
include_once "engine/config.php";
include_once "include/loginmic.php";
include_once "include/lmenu.php";
?>
</div>

</div>
        <div class="main-container col2-right-layout">
            <div class="main">
                                <div class="col-main">
                                        <div class="std">
      <font size='5'><h1 align='left'><b>Admin CP</b></h1></font><br><br><br><br>
<?php
if(isset($_GET['n']))
{
  switch($_GET['n'])
  {
    case 1:
      include_once "include/admin/1.php";
    break;
    case 2;
      include_once "include/admin/2.php";
    break;
    case 3:
      include_once "include/admin/3.php";
    break;
    case 4:
      include_once "include/admin/4.php";
    break;
    default:
     echo "ERROR!<a href='admin.php'>Inapoi</a>!";
    break;
  }
}
else
{
  ?>
  <font size='4'><h1 align='left'><a href='admin.php?n=1'>->Adauga meci</a><br>
  <a href='admin.php?n=2'>->Sterge meci</a><br>
  <a href='admin.php?n=3'>->Actualizeaza rezultatul unui meci</a><br>
  <a href='admin.php?n=4'>->Cereri pentru retragere fonduri</a><br></h1></font><br><br><br><br><br><br><br><br><br><br><br><br>
  <?php
}
?>



                                        

<?php
include_once "include/footer.php";
?>
