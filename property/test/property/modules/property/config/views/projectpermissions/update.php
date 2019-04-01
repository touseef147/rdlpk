<?php

    echo $this->render('_update',[
        'model' => $model,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
