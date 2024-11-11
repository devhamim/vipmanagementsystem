importScripts('https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/9.23.0/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyBe03zQH1HyjnSB16CeaRSYecBLJv83p64",
    authDomain: "vipsystem-c6a35.firebaseapp.com",
    projectId: "vipsystem-c6a35",
    storageBucket: "vipsystem-c6a35.firebasestorage.app",
    messagingSenderId: "472431567567",
    appId: "1:472431567567:web:f177ade51fdb8bca5c8dba",
    measurementId: "G-YWKTL9XKF3"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  console.log('Background message received:', payload);
  self.registration.showNotification(payload.notification.title, {
    body: payload.notification.body,
    icon: payload.notification.icon,
  });
});
