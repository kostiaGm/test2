<?php
/* @var $this OptionsController */
/* @var $model Options */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'options-options-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation' => false,
    ));
    ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'domain'); ?>
        <?php echo $form->textField($model, 'domain'); ?>
        <?php echo $form->error($model, 'domain'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'maxPage'); ?>
        <?php echo $form->textField($model, 'maxPage', array('size' => '4')); ?>
        <?php echo $form->error($model, 'maxPage'); ?>
        <?php echo $form->dropDownList($model, 'maxPageOn', array('page' => 'на странице', 'inAll' => 'всего')); ?>
        <?php echo $form->error($model, 'maxPageOn'); ?>

    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'maxLevel'); ?>
        <?php echo $form->textField($model, 'maxLevel', array('size' => '4')); ?>
        <?php echo $form->error($model, 'maxLevel'); ?>
        <?php echo $form->hiddenField($model, 'status', array('value' => 'read')); ?>
    </div>	




    <div class="row buttons">
        <?php echo CHtml::submitButton('Пуск', array('id' => 'bt-go')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $(function () {
        $('#load-content').hide();
   //     $('#index-content').show();

        $('#bt-go').on('click', function () {
          //  $('#index-content').hide();
            $('#load-content').show();
        });


    });

    var timerId = setInterval( status, 2000);
    function status() {
        $.get("/site/status", function (data) {
            if (data == '0') {
                $('#load-content').hide();
              //  $('#index-content').show();
                clearInterval(timerId);
            } else {
              //  $('#index-content').hide();
                $('#load-content').show();
            }
        });
    }

  
</script>

