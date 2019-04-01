<?php

    echo $this->render('_update',[
        'model' => $model,
        'modelprojects' => $modelprojects,
        'modelcenters' => $modelcenters,
        'selectedproj' => $selectedproj,
        'selectedcenter' => $selectedcenter,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
