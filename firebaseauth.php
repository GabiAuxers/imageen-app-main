<!-- TODO: revisar version Firebase -->
<script src="https://www.gstatic.com/firebasejs/9.13.0/firebase-auth-compat.js"></script>

<!-- Firebase auth UI -->
<?php
if (isset($l)) {
    $src = '';
    switch ($l) {
        case '2':
            $src = 'https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.js';
            break;
        case '3':
            $src = 'https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth__fr.js';
            break;
        case '4':
            $src = 'https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth__ca.js';
            break;
        default:
            $src = 'https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth__es.js';
    }
    echo '<script src="' . $src . '"></script>';
}
?>


<link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/6.0.1/firebase-ui-auth.css" />

<!-- Firebase: inicialización -->
<script>

    /**** I picked this up somewhere off SO - kudos to them - I use it a lot!.... :) */
    function setCookie(name, value, days = 7, path = '/') {
        var expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=' + path;
    }

    function getCookie(c_name) {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf(c_name + "=");
            if (c_start !== -1) {
                c_start = c_start + c_name.length + 1;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end === -1) {
                    c_end = document.cookie.length;
                }
                return unescape(document.cookie.substring(c_start, c_end));
            }
        }
        return "";
    }

    //import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.6.2/firebase-app.js';
    //If you enabled Analytics in your project, add the Firebase SDK for Google Analytics
    //import { getAnalytics } from 'https://www.gstatic.com/firebasejs/9.6.2/firebase-analytics.js';
    // Add Firebase products that you want to use
    //import { getAuth, PhoneAuthProvider } from 'https://www.gstatic.com/firebasejs/9.6.2/firebase-auth.js';

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional

    const auth = firebaseApp.auth();

    /*// Initialize Firebase
    const defaultProject = initializeApp(firebaseConfig);
    const analytics = getAnalytics(defaultProject);
    // INicializa el objeto auth
    var auth = getAuth(defaultProject);*/
    // Initialize the FirebaseUI Widget using Firebase auth
    var ui = new firebaseui.auth.AuthUI(auth);

    var is_uiwebview = /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(navigator.userAgent);
    var is_safari_or_uiwebview = /(iPhone|iPod|iPad).*AppleWebKit/i.test(navigator.userAgent);

    console.log("is_uiwebview: "+is_uiwebview);
    console.log("is_safari_or_uiwebview: "+is_safari_or_uiwebview);

    var uiConfig = {
        callbacks: {
            signInSuccessWithAuthResult: function(authResult, redirectUrl) {
                login(authResult.user, <?=$l?>,1);
                 return false;
            },
            uiShown: function() {
                // The widget is rendered.
                // Hide the loader.
                document.getElementById('loader').style.display = 'none';
            },
            signInFailure: function(error) {
                // Some unrecoverable error occurred during sign-in.
                // Return a promise when error handling is completed and FirebaseUI
                // will reset, clearing any UI. This commonly occurs for error code
                // 'firebaseui/anonymous-upgrade-merge-conflict' when merge conflict
                // occurs. Check below for more details on this.
                console.log(error);
                return handleUIError(error);
            }
        },

        // Will use popup for IDP Providers sign-in flow instead of the default, redirect.
        signInFlow: 'popup',
        
        //TODO: Metodo original para login firebase signInFlow: 'redirect', Otro método signInFlow: 'popup',
        signInSuccessUrl: '',
        signInOptions: [
        // Leave the lines as is for the providers you want to offer your users.
            //TODO: Hacer cambios para que funcione popup en iOs
            //{ provider:firebase.auth.GoogleAuthProvider.PROVIDER_ID, buttonColor: '#2765a0'},
            //TODO: Hacer cambios para que funcione popup de facebook 
            //{ provider:firebase.auth.FacebookAuthProvider.PROVIDER_ID, buttonColor: '#2765a0'},
            {
                provider: firebase.auth.PhoneAuthProvider.PROVIDER_ID,
                recaptchaParameters: {
                    type: 'image', // 'audio'
                    size: 'invisible', // 'invisible' or 'compact'
                    badge: 'bottonright' //' bottomright' or 'inline' applies to invisible.
                },
                defaultCountry: 'ES', // Set default country to Spain (+34)
                buttonColor: '#2765a0'
            },
            { provider:firebase.auth.EmailAuthProvider.PROVIDER_ID, buttonColor: '#2765a0'},
            //{ provider:"apple.com", buttonColor: '#2765a0'}
        ],
        // Terms of service url.
        tosUrl: 'https://www.imageen.net/web/legal-terms/',
        // Privacy policy url.
        privacyPolicyUrl: 'https://www.imageen.net/web/legal-terms/'
    }

    // The start method will wait until the DOM is loaded.
    //ui.start('#firebaseui-auth-container', uiConfig);
    
</script>
