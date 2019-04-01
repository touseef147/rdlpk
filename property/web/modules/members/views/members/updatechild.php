<?php
    $this->title = 'Update Nominee';

    echo $this->render('_form', [
        'model' => $model,
    ]); 
    //echo $this->render('_updatechild',[
      //  'model' => $model,
    //]); 

    $this->beginBlock('pagesidebar'); 

    echo $this->render('_sidebarinput'); 

    $this->endBlock(); 
?>
