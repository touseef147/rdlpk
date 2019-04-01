<?php

    echo $this->render('_update',[
        'model' => $model,
        'modeldetail' => $modeldetail,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
