
  
<?php
    if (strpos($userAgent, 'Instagram') || strpos($userAgent, 'FBAN') || strpos($userAgent, 'FBAV')) {
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename= blablabla');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($file);
    }
    else{
        header('Location: https://app.imageen.net');
    }
?>