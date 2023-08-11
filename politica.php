
<body>
    <?php
    include 'footer.php';
    ?>

    <div class="container content-container">
        <div class="row header">
            <div class="col-12 back-button text-left" style="margin-top: 50px;">
            <a href="?section=<?php echo $_GET['ref']; ?>&t=3">
                    <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="padding-top: 40px;">
                </a>
            </div>
        </div>
        <div class="col-12 p-3" style="padding-bottom: 70px;">
            <p class="txt-perfil" style="padding-top: 80px;"><?=getTxt(283, $l) ?>&nbsp; </p>
            <div class="txt-parrafo">
                <p><?=getTxt(306, $l) ?>&nbsp;</p>  

                <p><?=getTxt(182, $l) ?>&nbsp;  <?=getTxt(183, $l) ?>&nbsp; <?=getTxt(184, $l) ?>&nbsp; </p>
                  
                <p><?=getTxt(185, $l) ?>&nbsp;</p
                >
                <p><?=getTxt(186, $l) ?>&nbsp;</p>

                <p><?=getTxt(187, $l) ?>&nbsp;</p>

                <p><?=getTxt(188, $l) ?>&nbsp;</p>

                <p><?=getTxt(189, $l) ?>&nbsp; <?=getTxt(190, $l) ?>&nbsp; <?=getTxt(210, $l) ?>&nbsp;</p>

                <p><?=getTxt(191, $l) ?>&nbsp; <?=getTxt(192, $l) ?>&nbsp; <?=getTxt(193, $l) ?>&nbsp; </p>


                <p><?=getTxt(194, $l) ?>&nbsp;</p>

                <p><?=getTxt(195, $l) ?>&nbsp;</p>

                <p><?=getTxt(196, $l) ?>&nbsp; <?=getTxt(197, $l) ?>&nbsp; <?=getTxt(198, $l) ?>&nbsp; <?=getTxt(199, $l) ?>&nbsp; <?=getTxt(200, $l) ?>&nbsp;</p>
                
                <p><?=getTxt(201, $l) ?>&nbsp;</p>
                <p><?=getTxt(202, $l) ?>&nbsp;</p>
                <p><?=getTxt(203, $l) ?>&nbsp; <?=getTxt(204, $l) ?>&nbsp;</p>
                <p><?=getTxt(205, $l) ?>&nbsp; <?=getTxt(206, $l) ?>&nbsp; <?=getTxt(207, $l) ?>&nbsp;</p>
                <p><?=getTxt(208, $l) ?>&nbsp; <?=getTxt(209, $l) ?>&nbsp;</p>
            </div>
        </div>
    </div>
</body>
