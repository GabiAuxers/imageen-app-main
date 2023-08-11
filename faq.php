<body>
    <?php
    require_once 'footer.php';
    ?>

    <div class="container content-container">
        <div class="row header">
            <div class="col-12 back-button text-left" style="margin-top: 50px;">
             <!--Se establece este href para volver a atras a la pagina desde la que la llamamos, por ejemplo si lo llamamos desde perfil
            al volver hacia atras ira al perfil y si lo hacemos desde infoPerfil ira a infoPerfil.-->
                <a href="?section=<?php echo $_GET['ref']; ?>&t=3">
                    <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="padding-top: 40px;">
                </a>
            </div>
        </div>

        </div>
        <div class="col-12 p-3 ">
            <p class="txt-perfil" style="padding-top: 80px;"><?=getTxt(284, $l) ?>&nbsp;</p>
            <div class="listado2">
                <ul style="margin-top: 10px;">
                    <li>
                        <details>
                            <summary><?=getTxt(310, $l) ?>&nbsp;</summary>
                            <p><?=getTxt(252, $l) ?>&nbsp;<br><br>
                               <?=getTxt(254, $l) ?>&nbsp;<br><br>
                               <?=getTxt(255, $l) ?>&nbsp;<br><br>
                               <?=getTxt(256, $l) ?>&nbsp;</p>
                        </details>
                    </li>

                    <li style="margin-top: 10px;">
                        <details>
                            <summary><?=getTxt(311, $l) ?>&nbsp;</summary>
                            <p><?=getTxt(250, $l) ?>&nbsp;</p>
                            <p>
                                <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20Android%20v1.1.pdf"
                                    target="_blank"
                                    title="<?=getTxt(247, $l) ?>&nbsp;"><?=getTxt(247, $l) ?>&nbsp;</a><br>
                                <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20iOS%20v1.1.pdf"
                                    target="_blank" title="<?=getTxt(248, $l) ?>&nbsp;"><?=getTxt(248, $l) ?>&nbsp;</a><br>
                                <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20PC%20o%20Mac%20v1.1.pdf"
                                    target="_blank"
                                    title="<?=getTxt(249, $l) ?>&nbsp;"><?=getTxt(249, $l) ?>&nbsp;</a><br>
                            </p>
                        </details>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>