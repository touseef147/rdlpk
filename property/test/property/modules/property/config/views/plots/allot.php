<?php

    echo $this->render('_allot',[
        'model' => $model,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo  $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
