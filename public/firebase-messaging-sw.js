importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyCUPR-IH3vYGd04WVfUTHSEd0U0oR8ZhX0",
    authDomain: "kuponzetu.firebaseapp.com",
    databaseURL: "https://kuponzetu.firebaseio.com",
    projectId: "kuponzetu",
    storageBucket: "kuponzetu.appspot.com",
    messagingSenderId: "32675017495",
    appId: "1:32675017495:web:44ac064f3bf007f377bd52"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );

    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});

// firebase.initializeApp({
//     apiKey: "AIzaSyCUPR-IH3vYGd04WVfUTHSEd0U0oR8ZhX0",
//     authDomain: "kuponzetu.firebaseapp.com",
//     projectId: "kuponzetu",
//     storageBucket: "kuponzetu.appspot.com",
//     messagingSenderId: "32675017495",
//     appId: "1:32675017495:web:44ac064f3bf007f377bd52",
//     measurementId: "G-JG96SSSDT2"
// });
