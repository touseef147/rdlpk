<?php

    echo $this->render('_submit', [
        'model' => $model,
    ]);

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
