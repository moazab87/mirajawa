<script type="module">
  // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-analytics.js";
    import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-messaging.js";
    import { onBackgroundMessage } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-messaging-sw.js";

  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAxXBiY9lawPZ5XcErwznARXN32p9d2cIA",
    authDomain: "selflab-d19b0.firebaseapp.com",
    projectId: "selflab-d19b0",
    storageBucket: "selflab-d19b0.appspot.com",
    messagingSenderId: "939565702963",
    appId: "1:939565702963:web:91730472486751ce872846",
    measurementId: "G-E3Q2T7F1Y3"
  };

  // Initialize Firebase
    const app       = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);

    const messaging = getMessaging(app);
    window.fcmMessageing = messaging;

    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
        } else {
            console.log('Unable to get permission to notify.');
        }
    });

    getToken(messaging, { vapidKey: 'BFu9t9-NfDpnrKRNHgWxmoaBfBEDGtFeyRyDt1htXzzj8GcD7vtqT-dhvJp77miWNMZRcYc57REaShjM1vtc6rQ' }).then((currentToken) => {
        console.log(currentToken);
        if (currentToken) {
            console.log('Token: ', currentToken);
            function setDevice(guardType) {
                let options = {
                    url: '{{ route('web.setDevice') }}',
                    method: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        device_id: currentToken,
                        device_type: 'web',
                        guard: guardType,
                    },
                };
                $.ajax(options);
            }

            @if ($authType == 'admin' && empty(session()->get('admin_device_id')))
                setDevice('{{ $authType }}');
            @elseif ($authType == 'web' && auth()->check() && empty(session()->get('web_device_id')))
                setDevice('{{ $authType }}');
            @endif


        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
    });

    onMessage(messaging, (payload) => {
        console.log(payload, '{{ $authType }}');
        pushFcmNotification(payload);

    });

    function pushFcmNotification(payload)
    {
        let countNotify = $('#countNotify');
        countNotify.text(parseInt(countNotify.text()) + 1);
        let x = document.getElementById("soundNotify");
        x.play();
        toastr.options.onclick = function() {
            window.location.href = payload['notification']['click_action'];
        }

        toastr.info(payload['notification']['body'], payload['notification']['title']);

    }

</script>
