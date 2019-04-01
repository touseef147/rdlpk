<?php

    $this->render('_update',[
        'model' => $model,
    ]); 

    $this->beginBlock('pagesidebar'); 

    $this->render('_sidebarinput'); 

    $this->endBlock(); ?>"; 
?>
