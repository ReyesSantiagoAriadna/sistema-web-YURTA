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

<img id="imagenqr" src=" {!!QrCode::format('png')->size(300)->generate('idpedido', 'public/qrcodes/qrcode.png');!!}">

<input type="button" name="grabar" id="grabar" class="btn btn-primary" value="Grabar" onclick="saveimg()">

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



<script type="text/javascript">
    function saveimg(){
        var ref = firebase.storage().ref('/materiales/');
        var button = document.getElementById("imagenqr");
        const file = button.files[0];
        console.log("File: ",file);
        const name = (+new Date()) + '-' + file.name;
        const metadata = { contentType: file.type };
        const task = ref.child(name).put(file, metadata);
        task
            .then(snapshot => snapshot.ref.getDownloadURL())
            .then( (url) => {
                console.log('url:',url);
                document.getElementById("url").value = url;
                $("#formenvio_1").submit();
            } ).catch(console.error);
    }

</script>
</body>
</html>
