 <html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

</head>
<body>
<script language="javascript">
var d = new Date();
var vYear = d.getFullYear();
var vMon = d.getMonth()+1;
var vDay = d.getDate();
var h = d.getHours(); 
var m = d.getMinutes(); 
var se = d.getSeconds(); 
s=vYear+(vMon<10 ? "0" + vMon : vMon)+(vDay<10 ? "0"+ vDay : vDay)+(h<10 ? "0"+ h : h)+(m<10 ? "0" + m : m)+(se<10 ? "0" +se : se);
$.ajax({
     type: 'POST',
     url: ,
    data: {'currentTime',s},
    success: function(data) {
    	document.write(data);
    },
    dataType: 'json'
});
</script>
</body>
</html>