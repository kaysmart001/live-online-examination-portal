<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
    padding:5px;
    min-height: 15px;

    
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
    position: inherit;
}
          .button:hover{
              background-color: darkblue;
              
          }
    .button2 {
        background-color: #f44336; /* Green */
        position:fixed;
        top: 170px;
        left:950px;
        padding: 10px;
        }
          .button2:hover{
              background-color: #f44336;
          }
    .button3:hover{
        background-color: #F41E1E;
    }
    
 .split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 0px;
}


.left {
  right: 0;
    width: 50%;
    
    margin-top:3.5%;}
.right {
  right: 0;
    width: 50%;
    
    margin-top:3.5%;}
    </style>
<?php
include 'lib/Session.php';
Session::checkuserSession();
include('includes/header1.php');
include('includes/menu.php');
//include('includes/header2.php');
include("QuickQuizzes_file_upload/db_connect.php");
?>
<?php
   $userid = Session::get('uid');
	   if(!isset($_GET['egid'],$_GET['gtok'])){
	     echo "<script>window.location='userdashboard.php'</script>";
	  }else{
	     $egid = $_GET['egid'];
	     $gtok = $_GET['gtok'];
	  }
  $_SESSION['answers'] = array();
  $_SESSION['quid'] = array();

?>      

<div class="container bg-light-gray">
 <div class="main-content">
  <div class="featured-content">
    <div class="row-fluid">
     <div class="span8 offset3">
     <?php
         $dt = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
         $st =  $dt->format('Y-m-d H:i:s'); 
        $result = $us->detailsuserexamgroup($egid,$gtok);
        if($result){
    	    $value = $result->fetch_assoc();
            $totalext = $value['examRunningTime'];
            $datatime1 = $value['startingTime'];
            $datatime = new DateTime($datatime1, new DateTimeZone('Asia/Kolkata'));
            $dt = new DateTime($datatime1, new DateTimeZone('Asia/Kolkata'));
            $dt1 =  $dt->format('Y-m-d H:i:s');
            $datatime->add(new DateInterval('P0M0DT0H'.$totalext.'M0S'));
            $newtime =  $datatime->format('Y-m-d H:i:s');
        }
          ?>
        <div class="alert alert-warning" style="content:center"> 
        <video></video>
         <video id="vid2"  controls height="120" width="120"></video>
         </div>
            <h2 style="text-align: justify;">Test Information : </h2>
   <div class="alert alert-success" style="font-size: 16px;">
         <p class="hgad">1. Exam Starting Time: <strong><?php echo $fm->DateFormat($dt1);?></strong></p>
         <p>2. Current Time: <strong><?php echo $fm->DateFormat($st);?></strong></p>
         <p>3. Exam Will Be Conitnue: <strong><?php echo $fm->DateFormat($newtime);?></strong></p>
         <p>4. Total Question: <strong><?php echo $value['totalExamShowQues']; ?></strong></p>
         <?php
         $ttime = $value['totalExamShowQues'] * $value['eachQuestionTime'];
         $tq = $value['totalExamShowQues'];
         ?>
         <?php
          $mi = (int) ($ttime / 60);
          $se =  $ttime % 60;
         ?>
         <p>5. Time For Exam: <strong><?php echo $mi." Minutes ".$se." Seconds"; ?></strong></p>
         
    
<!--
        <div class="split left">
         
-->
          
		</div>
        <h2>Result Details : </h2>
        <div class="alert alert-warning">
		<h3 style="text-align: justify;">Once You have close the test window please do not refresh the current Window You Will find a End Test Button After Clicking On END TEST please download your live vedio recording  for further upload on the Upload button.</h3>
		</div>  </div>
    </div>
     <?php 
     $ecv='';
     $q=0;
     $fiquestion = $qs->checkminimumcondition($egid);
     if($fiquestion){
        while ($fqvalue = $fiquestion->fetch_assoc()) {
            $q++;
        }
     }
    $che = $us->checkexamcondition($egid,$userid);
    if($che){
        $cvalue = $che->fetch_assoc();
        $ecv = $cvalue['econdition'];
    }
    $getque = $qs->getquestionbygroup($egid,$gtok,$tq);
     if($getque){
        while ($value=$getque->fetch_assoc()) {
           $questions[] = $value;
        }
     }
     if(isset($questions)){
     $_SESSION['questionid'] = $questions;
     } 

     ?>
      
<!--for vedio recording    -->
            
       
      <?php
        if($ecv==1 || $ecv==2){
//           echo"<button class= 'btn btn-primary esb' id='btnStop' onclick='myFunction()' >End Test</button>";
            echo "<button class='button' >You Already Finished Your Exam</button>";
            
        }
        elseif($tq>$q){
          echo "<button class='btn btn-primary esb'>Minimum Questions Is Not Set</button>";
        } 
        elseif($st==$dt1 || $st>$dt1){ ?>
<!--        <button class="btn btn-primary esb" onclick="fun1()">Recorder</button>-->
        <button class="button" onclick="fun1()">Start Exam</button>
         <button class="button " id='btnStop' onclick='myFunction()' >End Test</button>";
      <?php  } else{?>

      <button class="btn btn-primary esb">Exam Not Start</button>
       <?php } ?>
<!--
      <?php
//      include('QuickQuizzes_file_upload/index.php');
      ?>
-->
    <script>

        function myFunction() {
            alert("Hello! please download your video through the link given!");
        }
        let constraintObj = {
            audio: {
                audio: false,
                echoCancellation: true,
                noiseSuppression: true,
                sampleRate: 10100
            },

            video: {
                facingMode: "user",
                width: { min: 120, ideal: 12, max: 1920 },
                height: { min: 120, ideal: 72, max: 1080 }
            }
        };
        // width: 1280, height: 720  -- preference only
        // facingMode: {exact: "user"}
        // facingMode: "environment"

        //handle older browsers that might implement getUserMedia in some way
        if (navigator.mediaDevices === undefined) {
            navigator.mediaDevices = {};
            navigator.mediaDevices.getUserMedia = function (constraintObj) {
                let getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
                if (!getUserMedia) {
                    return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
                }
                return new Promise(function (resolve, reject) {
                    getUserMedia.call(navigator, constraintObj, resolve, reject);

                });
            }
        } else {
            navigator.mediaDevices.enumerateDevices()
                .then(devices => {
                    devices.forEach(device => {
                        console.log(device.kind.toUpperCase(), device.label);
                        device.deviceId
                    })
                })
                .catch(err => {
                    console.log(err.name, err.message);
                })
        }

        navigator.mediaDevices.getUserMedia(constraintObj)
            .then(function (mediaStreamObj) {
                //connect the media stream to the first video element
                let video = document.querySelector('video');

                if ("srcObject" in video) {
                    video.srcObject = mediaStreamObj;

                } else {
                    //old version
                    video.src = window.URL.createObjectURL(mediaStreamObj);

                }

                video.onloadedmetadata = function (ev) {
                    //show in the video element what is being captured by the webcam

                    video.play();
                    video.muted = "muted";
                    video.muted = true;
                };

                //add listeners for saving video/audio

                let mediaRecorder = new MediaRecorder(mediaStreamObj);

                mediaRecorder.start();
                console.log("STARTING"+mediaRecorder.state);

                let start = document.getElementById('btnStart');
                let stop = document.getElementById('btnStop');
                let vidSave = document.getElementById('vid2');
                let downl = document.getElementById('btndown');
                let chunks = [];
                stop.addEventListener('click', (ev) => {
                    mediaRecorder.stop();
                    console.log(mediaRecorder.state);
                });
                mediaRecorder.ondataavailable = function (ev) {
                    chunks.push(ev.data);

                }
                mediaRecorder.onstop = (ev) => {
                    let blob = new Blob(chunks, { 'type': 'video/mp4;' });
                    chunks = [];
                    let videoURL = window.URL.createObjectURL(blob);
                    vidSave.src = videoURL;


                    console.log(videoURL);
                    let a = document.createElement('a');
                    a.href = videoURL;
                    a.textContent = 'Download video';
                    a.setAttribute('download', 'download');
                    a.setAttribute('type', 'video/mp4');
                    a.style.cssText = "color:red; border: 5px solid black; padding:10px";

                    document.body.appendChild(a);
                }
            }
            )
            .catch(function (err) {
                console.log(err.name, err.message);
            });

        /*********************************
        getUserMedia returns a Promise
        resolve - returns a MediaStream Object
        reject returns one of the following errors
        AbortError - generic unknown cause
        NotAllowedError (SecurityError) - user rejected permissions
        NotFoundError - missing media track
        NotReadableError - user permissions given but hardware/OS error
        OverconstrainedError - constraint video settings preventing
        TypeError - audio: false, video: false
        *********************************/
        function fun() {
            console.log(videoURL);
            let a = document.createElement('a');
            a.href = videoURL;

            a.textContent = 'Download video';
            a.setAttribute('download', 'download');
            a.setAttribute('type', 'video/mp4');

        }
        function PostBlob(audioBlob, videoBlob, fileName) {
            var formData = new FormData();
            formData.append('filename', fileName);
            formData.append('audio-blob', audioBlob);
            formData.append('video-blob', videoBlob);
            xhr('save.php', formData, function (ffmpeg_output) {
                document.querySelector('h1').innerHTML = ffmpeg_output.replace(/\\n/g, '<br />');
                preview.src = 'uploads/' + fileName + '-merged.webm';
                preview.play();
                preview.muted = false;
            });
        }
        function xhr(url, data, callback) {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    callback(request.responseText);
                }
            };
            request.open('POST', url);
            request.send(data);
        }
    </script>
     <script> 
function fun1() {
    myWindow = window.open("", "myWindow", "width=1600, height=800");
    myWindow.location.href ="questionpaper.php?exgid=<?php echo $egid ;?>&egtok=<?php echo $gtok;?>&ttime=<?php echo $ttime;?>&toque=<?php echo $tq; ?>";
}

</script>
      <br><br><br>
<?php 
include('includes/footer.php');
?>