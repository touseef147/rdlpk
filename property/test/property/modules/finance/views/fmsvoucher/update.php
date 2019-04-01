<?php

    echo $this->render('_update',[
        'model' => $model,
        'modelmember' => $modelmember,
        'modelreceipts' => $modelreceipts,
        'modelreceiptdetail' => $modelreceiptdetail,
    ]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
