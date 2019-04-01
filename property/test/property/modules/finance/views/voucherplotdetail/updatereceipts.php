<?php

echo $this->render('_updatereceipts', [
    'model' => $model,
    'modelreceipts' => $modelreceipts,
]);

$this->beginBlock('pagesidebar');

echo $this->render('_sidebarinput');

$this->endBlock();
?>
