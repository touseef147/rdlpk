<?php

    echo $this->render('_update',[
        'model' => $model,
        'plot' => $plot,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
