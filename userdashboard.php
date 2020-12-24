<?php
include 'lib/Session.php';
Session::checkuserSession();
include('includes/header.php');
include('includes/menu.php');
?>
<?php
   $userid = Session::get('uid');
   $msg = $us->checkuserhasgroup($userid);
?>
<div class="container bg-light-gray">
 <div class="main-content">
 <section>
  <div class="featured-content">
    <div class="row-fluid">
     <div class="addashmain">
	      <h2>Welcome To User Dashboard</h2>
	      <h3>Hi, <?php echo Session::get('userusername')?></h3>
	      <?php
            if(!$msg)
              echo "<p style='color:black;font-size:20px;'><i>You Are Not Connected Any Group.Please Connect Now</i></p>";
            else{
            	$i=0;
            	while ($value = $msg->fetch_assoc()) {
            		$i++;
            	}
            	echo "<p style='color:black'><i>You Are Connected to the ".$i." Groups</i></p>";
                echo "<p style='color:yellow;font-size:20px;'>Exam Rules:</p>";
                echo"<p style='color:white;font-size:17px;margin-top:-15px;'>1. Before you enter into your Exam Hall, Please ensure that your Camera is Working if not Please allow the window to record if your teacher asked you to record otherwise ignored. when you enter in the hall u can see yourself in a small window</p>";
                echo"<p style='color:white;font-size:17px;margin-top:-15px;'>2. If you reload after entering into the your ExamHall or you try to go back form your Examhall,You will be suspended & You are no logner available to attain  this exam.</p>";
                echo"<p style='color:white;font-size:17px;margin-top:-15px;'>3. When you enter into the your ExamHall click on Start Test your live recording will be started on the backend and a new window will be open for your questions.</p>";
                echo"<p style='color:white;font-size:17px;margin-top:-5px;'>4. Once You have close the test window please do not refresh the current Window You Will find a End Test Button After Clicking On END TEST please download your live vedio recording  for further upload on the Upload button</p>";
                
            }
	      ?> 
	      <span style="margin-left: 200px;">
	      <a href="userconnectgroup.php"><input type="submit"  name="cg" value="Connect To Group" ></a>
    <?php
     if(isset($_GET['usaction']) && $_GET['usaction']=='uslogout')              
               Session::destroy(); 
    ?>
	      <a href="?usaction=uslogout"><input type="submit" name="lg" value="Log Out" name=""></span></a>
	      <br>
     </div>
    </div>
   </div>
   </section>
   <div class="ruler"></div>
                    <!-- Section Two --> 
   <section>
   <div class="featured-content">
    
    <?php
    $dt = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
    $st =  $dt->format('Y-m-d H:i:s'); 
    $result = $us->checkuserhasgroup($userid);
    if($result){
    	while ($value = $result->fetch_assoc()) {
         
         $group_id = $value['group_id'];
         $group_token = $value['group_token'];
         // echo $group_id." ".$group_token."<br>";
         $query = $us->detailsuserexamgroup($group_id,$group_token);
         if($query){
            while ($res = $query->fetch_assoc()) {

         $tgtq = $res['totalExamShowQues'];
         $ck='f';
         $ck1='f';
         $totalext = $res['examRunningTime'];
         $datatime1 = $res['startingTime'];
         $datatime = new DateTime($datatime1, new DateTimeZone('Asia/Kolkata'));
         $dt = new DateTime($datatime1, new DateTimeZone('Asia/Kolkata'));
         $dt1 =  $dt->format('Y-m-d H:i:s');
         $datatime->add(new DateInterval('P0M0DT0H'.$totalext.'M0S'));
         $newtime =  $datatime->format('Y-m-d H:i:s');
         if($dt1>$st){
         	$examcon = "Exam Not Start";
          $ck = '';
         }elseif($dt1<$st && $newtime>$st){
         	$examcon = "Exam is Running";
          $ck = '';
         }elseif($st>$newtime){
         	$examcon = "Exam has Finished";
          $ck1 = '';
         }else{
         	$examcon = "";
         }
    ?>
	    <div class="row-fluid eachgr">
	      <div class="span7">
	         <h2><?php echo $res['groupName'];?></h2>
	         <p style="font-size: 25px;margin-left: 30px;"><?php echo $res['examName'];?></p>
	         
	      </div>
	      <div class="span5">
	      <p><strong>Exam Time: </strong><span style="color:mintcream"><?php echo $fm->DateFormat($dt1);?></span></p>
	      <p style="margin-top: -12px;"><strong>Current Time: </strong><span style="color:mintcream"><?php echo $fm->DateFormat($st);?></span></p>
	         <p style="margin-top: -12px;">
	         <i><strong>Exam Condition: </strong><span style="color:#ffbba9;font-weight: bold;font-size: 17px;"><?php echo $examcon; ?></span></i></p>
	         <p style="margin-top: -12px;">
	         <i><strong> Total Question: </strong><span style="color:mintcream"><?php echo $res['totalExamShowQues']; ?></span></i>
           <i><strong> Per Question Time: </strong><span style="color:mintcream"><?php echo $res['eachQuestionTime'];?> seconds</span></i>
	         </p>
           <p style="margin-top: -12px;">
             <i><strong> Total Exam Time: </strong><span style="color:mintcream"><?php echo ($res['totalExamShowQues']*$res['eachQuestionTime']); ?> Seconds</span></i>
           </p>
            <?php
                 if($ck1=='f') {?>
           <a href="examhall.php?egid=<?php echo $group_id ;?>&gtok=<?php echo $group_token;?>"><input type="submit" name="viewgrp" value="Enter in The Exam Hall"></a>
            <?php } ?>
	          <?php 
                 if($ck=='f') {?>
                 <?php
                 $cnfm = $as->userresultseeconfirm($group_id);
                 if(!$cnfm)  { ?>
                   <input onclick = "confirm('Result Not Published Yet')" type="submit" name="addquestion" value="Result">
                <?php } else{
                 ?>
                  <a href="userresult.php?resid=<?php echo $userid;?>&regpid=<?php echo $group_id;?>&tgtq=<?php echo $tgtq;?>"><input type="submit" name="addquestion" value="Result"></a>
               <?php  } } ?> 
	      </div>
	   </div>
	   <br>
   <?php } } } }?>

   </div>
   </section>
                   <!-- Section Two End --> 
 </div>
</div>

<?php 
include('includes/footer.php');
?>