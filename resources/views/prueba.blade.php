<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yurta App</title>
    <script src="plugins/jquery/jquery.min.js"></script>
</head>
<body>
<input type="button" name="grabar" id="grabar" class="btn btn-primary" value="Aceptar" onclick="upload()">
<input type="file" id="upload-file-selector" required>

<script src="https://www.gstatic.com/firebasejs/7.9.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.9.0/firebase-storage.js"></script>

<script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyB3_eHqhTh_OHewWL1Mg3YvxDMMWrn9w_Q",
        authDomain: "yurta-b4d1d.firebaseapp.com",
        databaseURL: "https://yurta-b4d1d.firebaseio.com",
        projectId: "yurta-b4d1d",
        storageBucket: "yurta-b4d1d.appspot.com",
        messagingSenderId: "1091299166428",
        appId: "1:1091299166428:web:133c7801c3c5509b350c19",
        measurementId: "G-6VYB96F10Z"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    // firebase.analytics();
</script>
<script>
    var vselect;
    $("#upload-file-selector").on("change",function (event) {
        vselect= event.target.files[0];
        console.log("sel",vselect.name);
    });

    function upload() {
        var filename = vselect.name;
        var sreference = firebase.storage().ref('/materiales/'+filename);
        var upTask = sreference.put(vselect);

        upTask.on('state_changed',function (snapshot) {

            },function (error) {

            },function () {
               // var dowurl =upTask.snapshot.downloadURL;
                ///console.log(dowurl);
            }
        );
    }
</script>
<script>
</script>
</body>
</html>
