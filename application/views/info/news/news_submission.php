<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title>kindeditor</title>

<!-- 在这里引入css文件 -->
<link rel="stylesheet" href="<?php echo base_url();?>kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo base_url();?>kindeditor/plugins/code/prettify.css" />
</head>
<body>
    <form action="Diary.php" name="myform" method="post">
     <textarea name="content" style="width:930px; height:630px; margin-top:50px;">
    </textarea>
  </form>
</div>

<!-- 在这里引入JavaScript文件，这些文件都是你下载控件里面的文件，直接引用即可，注意路径一定要正确 -->
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="kindeditor/plugins/code/prettify.js"></script>
<script>
   KindEditor.ready(function(K) {//kindeditor控件调用
       var editor1=K.create('textarea[name="content"]',{//name=form中textarea的name属性
           cssPath : '<?php echo base_url();?>kindeditor/plugins/code/prettify.css',
           uploadJson : <?php echo base_url();?>kindeditor/php/upload_json.php',
           fileManagerJson : '<?php echo base_url();?>kindeditor/php/file_manager_json.php',
           allowFileManager : true,
           afterCreate : function() {
               var self = this;
               K.ctrl(document, 13, function() {
                   self.sync();
                   K('form[name=myform]')[0].submit(); // name=form表单的name属性
               });
               K.ctrl(self.edit.doc, 13, function() {
                   self.sync();
                   K('form[name=myform]')[0].submit(); // name=form表单的name属性
               });
           }
       });
       prettyPrint();
   });
</script>
</body>
</html>
