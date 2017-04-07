<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use bs\yii\document\models\Document;
use bs\yii\document\assets\SummernoteAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Document */
/* @var $form yii\widgets\ActiveForm */

SummernoteAsset::register($this);

$js = <<< JS
    $(document).ready(function() {
      $('.summernote').summernote({
        height: 200,
        tabsize: 4,
        lang: 'zh-CN',
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['fontname', ['fontname']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ],        
      });

      // 0.8.2 引入
      $('.summernote').summernote('fontSize', 24);
    

      $('form').on('submit', function (e) {
        var type = $('#document-type').val();
        if (type != 1) {
            // 只有富文本编辑器需要下面的处理
            return;
        }        

        var content = $('.summernote').val();
        console.log(content);

        // 简单文本编辑器对象
        ele = $('#document-content');
        ele.val(content);

        console.log(ele);

        // e.preventDefault();
      });

      var initialType = $('#document-type').val();
      if (initialType == 1) {
        $('#rich-text-area').show();
        $('#plain-text-area').hide();
      }else{
        $('#rich-text-area').hide();
        $('#plain-text-area').show();
      }

      $('#document-type').change(function(){
        var value = $(this).val();
        if (value == 1) {
          $('#rich-text-area').show();
          $('#plain-text-area').hide();
        }else{
          $('#rich-text-area').hide();
          $('#plain-text-area').show();
        }
      });      
    }); 
JS;
$this->registerJs($js);
?>

<div class="document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->isNewRecord): ?>
      <?= $form->field($model, 'type')->dropDownList(Document::TYPE_NAMES) ?>
    <?php else: ?>
      <?= $form->field($model, 'type')->dropDownList(Document::TYPE_NAMES,['disabled' => true]) ?>
    <?php endif ?>    

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <!-- 富文本编辑框 -->
    <div class="form-group" id="rich-text-area" style="display:none">
      <label for="content">详情</label>
      <!-- textarea 用来占位，向表单提供数据，它的 id 用在 js 代码中，将用户编辑的内容写入这里 -->
      <!-- 本例中出现两种文本编辑框，他们的 id 必须保持一致 -->
      <textarea name="Document[content]" class="summernote" title="Content"><?= $model->content ?></textarea>
    </div>

    <!-- plain text 编辑框 -->
    <div class="form-group" id='plain-text-area' style="display:none">
    <?= $form->field($model, 'content')->textarea(['rows' => 12]) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
