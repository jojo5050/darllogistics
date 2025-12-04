
<?php
return [
  'apiKey' => env('FIREBASE_API_KEY', ''),
  'authDomain' => env('FIREBASE_AUTH_DOMAIN', 'your-app.firebaseapp.com'),
  'projectId' => env('FIREBASE_PROJECT_ID', 'your-app-id'),
  'storageBucket' => env('FIREBASE_STORAGE_BUCKET', 'your-app.appspot.com'),
  'messagingSenderId' => env('FIREBASE_MESSAGING_SENDER_ID', ''),
  'appId' => env('FIREBASE_APP_ID', ''),
];