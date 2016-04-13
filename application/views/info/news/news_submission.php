<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title>kindeditor</title>

<!-- ����������css�ļ� -->
<link rel="stylesheet" href="<?php echo base_url();?>kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo base_url();?>kindeditor/plugins/code/prettify.css" />
</head>
<body>
    <form action="Diary.php" name="myform" method="post">
     <textarea name="content" style="width:930px; height:630px; margin-top:50px;">
    </textarea>
  </form>
</div>

<!-- ����������JavaScript�ļ�����Щ�ļ����������ؿؼ�������ļ���ֱ�����ü��ɣ�ע��·��һ��Ҫ��ȷ -->
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="kindeditor/plugins/code/prettify.js"></script>
<script>
   KindEditor.ready(function(K) {//kindeditor�ؼ�����
       var editor1=K.create('textarea[name="content"]',{//name=form��textarea��name����
           cssPath : '<?php echo base_url();?>kindeditor/plugins/code/prettify.css',
           uploadJson : <?php echo base_url();?>kindeditor/php/upload_json.php',
           fileManagerJson : '<?php echo base_url();?>kindeditor/php/file_manager_json.php',
           allowFileManager : true,
           afterCreate : function() {
               var self = this;
               K.ctrl(document, 13, function() {
                   self.sync();
                   K('form[name=myform]')[0].submit(); // name=form����name����
               });
               K.ctrl(self.edit.doc, 13, function() {
                   self.sync();
                   K('form[name=myform]')[0].submit(); // name=form����name����
               });
           }
       });
       prettyPrint();
   });
</script>
</body>
</html>
