<style>
    body{
        padding-top: 600px;
        background-color: #CEEEEA;
/*        margin-top: 700px;*/
    }
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;  
  margin: 4px 2px;
  cursor: pointer;
    position: inherit;
}
    .button2 {
        background-color: #f44336; /* Green */
        position:fixed;
        top: 619px;
        left:1250px;
        padding: 10px;
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
    width: 30%;
    margin-top: 120px;
  left: 0;
  //background-color: #111;
}

.right {
  right: 0;
    width: 70%;
    margin-top: 5%;}

</style>

    <video></video> <br><br>
        
         
    <header>
        <video id="vid2"  controls height="240" width="240"></video>
    </header>
<button class="btn btn-info esb" id="btnStop" onclick="myFunction()">End Recording</button>
        <!-- could save to canvas and do image manipulation and saving too -->
    <script>
//function myFunction() {
//  alert("Hello! please click on the above link to download the live vedio for further upload from the link mentioned above as DOWNLOAD LINK!");
//}
//function myFunction2() {
//  alert("lease upload the downloaded vedio on the next page");
//}
//
//        function myFunction() {
//            alert("Hello! please download your video through the link given!");
//        }
//        let constraintObj = {
//            audio: {
//                audio: false,
//                echoCancellation: true,
//                noiseSuppression: true,
//                sampleRate: 10100
//            },
//
//            video: {
//                facingMode: "user",
//                width: { min: 240, ideal: 128, max: 1920 },
//                height: { min: 240, ideal: 72, max: 1080 }
//            }
//        };
//        // width: 1280, height: 720  -- preference only
//        // facingMode: {exact: "user"}
//        // facingMode: "environment"
//
//        //handle older browsers that might implement getUserMedia in some way
//        if (navigator.mediaDevices === undefined) {
//            navigator.mediaDevices = {};
//            navigator.mediaDevices.getUserMedia = function (constraintObj) {
//                let getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
//                if (!getUserMedia) {
//                    return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
//                }
//                return new Promise(function (resolve, reject) {
//                    getUserMedia.call(navigator, constraintObj, resolve, reject);
//
//                });
//            }
//        } else {
//            navigator.mediaDevices.enumerateDevices()
//                .then(devices => {
//                    devices.forEach(device => {
//                        console.log(device.kind.toUpperCase(), device.label);
//                        device.deviceId
//                    })
//                })
//                .catch(err => {
//                    console.log(err.name, err.message);
//                })
//        }
//
//        navigator.mediaDevices.getUserMedia(constraintObj)
//            .then(function (mediaStreamObj) {
//                //connect the media stream to the first video element
//                let video = document.querySelector('video');
//
//                if ("srcObject" in video) {
//                    video.srcObject = mediaStreamObj;
//
//                } else {
//                    //old version
//                    video.src = window.URL.createObjectURL(mediaStreamObj);
//
//                }
//
//                video.onloadedmetadata = function (ev) {
//                    //show in the video element what is being captured by the webcam
//
//                    video.play();
//                    video.muted = "muted";
//                    video.muted = true;
//                };
//
//                //add listeners for saving video/audio
//
//                let mediaRecorder = new MediaRecorder(mediaStreamObj);
//
//                mediaRecorder.start();
//                console.log("STARTING"+mediaRecorder.state);
//
//                let start = document.getElementById('btnStart');
//                let stop = document.getElementById('btnStop');
//                let vidSave = document.getElementById('vid2');
//                let downl = document.getElementById('btndown');
//                let chunks = [];
//                stop.addEventListener('click', (ev) => {
//                    mediaRecorder.stop();
//                    console.log(mediaRecorder.state);
//                });
//                mediaRecorder.ondataavailable = function (ev) {
//                    chunks.push(ev.data);
//
//                }
//                mediaRecorder.onstop = (ev) => {
//                    let blob = new Blob(chunks, { 'type': 'video/mp4;' });
//                    chunks = [];
//                    let videoURL = window.URL.createObjectURL(blob);
//                    vidSave.src = videoURL;
//
//
//                    console.log(videoURL);
//                    let a = document.createElement('a');
//                    a.href = videoURL;
//                    a.style.cssText = "color:red; border: 5px solid black; padding:10px;margin-top:100px";
//
//                    a.textContent = 'Download video';
//                    a.setAttribute('download', 'download');
//                    a.setAttribute('type', 'video/mp4');
//                    
//                    
//                    document.body.appendChild(a);
//                }
//            }
//            )
//            .catch(function (err) {
//                console.log(err.name, err.message);
//            });

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
//        function fun() {
//            console.log(videoURL);
//            let a = document.createElement('a');
//            a.href = videoURL;
//
//            a.textContent = 'Download video';
//            a.setAttribute('download', 'download');
//            a.setAttribute('type', 'video/mp4');
//
//        }
//        function PostBlob(audioBlob, videoBlob, fileName) {
//            var formData = new FormData();
//            formData.append('filename', fileName);
//            formData.append('audio-blob', audioBlob);
//            formData.append('video-blob', videoBlob);
//            xhr('save.php', formData, function (ffmpeg_output) {
//                document.querySelector('h1').innerHTML = ffmpeg_output.replace(/\\n/g, '<br />');
//                preview.src = 'uploads/' + fileName + '-merged.webm';
//                preview.play();
//                preview.muted = false;
//            });
//        }
    </script>
