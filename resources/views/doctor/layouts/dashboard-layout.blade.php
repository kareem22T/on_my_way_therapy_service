<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('/css/therapist_dashboard.css') }}">
    <!-- firebase integration started -->
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-app.js"></script>
    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-functions.js"></script>
    <!-- firebase integration end -->
    <!-- Comment out (or don't include) services that you don't want to use -->
    <!-- <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-storage.js"></script> -->
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-analytics.js"></script>
    <title>Dashboard | @yield("title")</title>
</head>
<body>
    @include('doctor.includes.header')
    @yield("content")

    <script>
        // Your web app's Firebase configuration
        notifyMe()
        function notifyMe() {
            if (!("Notification" in window)) {
                // Check if the browser supports notifications
                alert("This browser does not support desktop notification");
            } else if (Notification.permission === "granted") {
                // Check whether notification permissions have already been granted;
                // if so, create a notification
                const notification = new Notification("Hi there!");
                // …
            } else if (Notification.permission !== "denied") {
                // We need to ask the user for permission
                Notification.requestPermission().then((permission) => {
                // If the user accepts, let's create a notification
                if (permission === "granted") {
                    const notification = new Notification("Hi there!");
                    // …
                }
                });
            }
        }

        // import { initializeApp } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-app.js";
        // import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.20.0/firebase-analytics.js";
        // // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyCry2wEBXSPnGCK6bbQDH1Aei90fr-cQxQ",
            authDomain: "on-my-way-85f38.firebaseapp.com",
            projectId: "on-my-way-85f38",
            storageBucket: "on-my-way-85f38.appspot.com",
            messagingSenderId: "83290735892",
            appId: "1:83290735892:web:6ab98ac9cc167b6dc92e01",
            measurementId: "G-3KBDQ5FHE0"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        //firebase.analytics();
        const messaging = firebase.messaging();
            messaging
        .requestPermission()
        .then(function () {
        //MsgElem.innerHTML = "Notification permission granted." 
            console.log("Notification permission granted.");
            // get the token in the form of promise
            return messaging.getToken()
        })
        .then(function(token) {
            // print the token on the HTML page     
            // console.log(btoa( Math.random() + navigator.userAgent + Date() ) );
            console.log(token);
        })
        .catch(function (err) {
            console.log("Unable to get permission to notify.", err);
        });

        messaging.onMessage(function(payload) {
            console.log(payload);
            var notify;
            notify = new Notification(payload.notification.title,{
                body: payload.notification.body,
                icon: payload.notification.icon,
                tag: "Dummy"
            });
            console.log(payload.notification);
        });
        //firebase.initializeApp(config);
        var database = firebase.database().ref().child("/users/");
        database.on('value', function(snapshot) {
            renderUI(snapshot.val());
        });

        // On child added to db
        database.on('child_added', function(data) {
            console.log("Comming");
            if(Notification.permission!=='default'){
                var notify;
                notify= new Notification('CodeWife - '+data.val().username,{
                    'body': data.val().message,
                    'icon': 'bell.png',
                    'tag': data.getKey()
                });
                notify.onclick = function(){
                    alert(this.tag);
                }

            }else{
                alert('Please allow the notification first');
            }
        });

        self.addEventListener('notificationclick', function(event) {       
            event.notification.close();
        });
    </script>
</body>
</html>