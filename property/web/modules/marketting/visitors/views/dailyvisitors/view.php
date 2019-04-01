<?php
    $vd=NULL;
    $bd=NULL;
    
    if(isset($modelvisits))
        $vd=$modelvisits;
    
    if(isset($modelbookings))
        $bd=$modelbookings;
    
    echo $this->render('_view',[
        'model' => $model,
        'modelvisits' => $vd,
        'modelbookings' => $bd,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
