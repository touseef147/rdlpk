<?php
    $this->title = 'Update Members';

    echo $this->render('_form', [
        'model' => $model,
    ]); 
    //echo $this->render('_update',[
      //  'model' => $model,
    //]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
