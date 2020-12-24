<?php
include 'lib/Session.php';
Session::checkuserSession();
include('includes/header1.php');
include('includes/menu.php');
?>
<?php
   $userid = Session::get('uid');
   if(!isset($_GET['exgid'],$_GET['sid'])){
     echo "<script>window.location='userdashboard.php'</script>";
  }else{
     $exgid = $_GET['exgid'];
     $sid = $_GET['sid'];
     $ec = $us->finexamconditionmaintain($exgid,$userid);
  }
    $ans=$questionid=array();
    if(isset($_SESSION['answers'],$_SESSION['quid'])){
      $ans = $_SESSION['answers'];
      $questionid =  $_SESSION['quid'];
   }

   $saveans = $as->saveanswerbygidandsid($exgid,$sid,$questionid,$ans);
   if(isset($_SESSION['answers'],$_SESSION['quid'])){
      unset($_SESSION['answers']);
      unset($_SESSION['quid']);
      unset($ans);
      unset($questionid);
   }
   
?>
<div class="container bg-light-gray">
 <div class="main-content">
  <div class="featured-content">
    <div class="row-fluid">
      <div class="span11 offset1">
        <div class="alert alert-success" style="font-size: 16px;">
		  <h2><strong>Success!!</strong> <span>Your Exam Is Completed Successfully. Please Back To The Dashboard.</span></h2>
         <h3>If Your Teacher Had Asked For the Video So Close The Current Window And Then Click On The End Test To Stop The Recording</h3>
		</div>
		<div class="alert alert-warning">
		<h3 style="text-align: justify;">If you have completed your test Please Close this Current Url or Window.</h3>
        <h3>Once You Close The Current Window please do not refresh the current Window You Will find a End Test Button After Clicking On END TEST please download your live vedio for further upload on the Upload button.</h3>
		</div>
          
		<a href="examhall.php"><button class="btn btn-primary offset4 esb1">Back To My DashBoard..</button></a>
     </div>
   </div>
  </div>
 </div>
</div>
<?php 
include('includes/footer.php');
?>