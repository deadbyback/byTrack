<style>
    #pic {
        width: 200px;
        height: 200px;
    }
</style>
<form id="form1">

<input type="file"
       onchange="document.getElementById('pic').src = window.URL.createObjectURL(this.files[0])">
    <hr>
    <img id="pic" src="#" alt="your image"/>
    <hr>
<button class="success">Submit</button>
</form>

<?php/* use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
$form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']);
 ActiveForm::end()*/ ?>
