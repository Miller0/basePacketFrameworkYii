<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<?php

foreach ($test as $t)
{
    echo $t['id'] ;
    echo $t['text'] ;

}

?>
