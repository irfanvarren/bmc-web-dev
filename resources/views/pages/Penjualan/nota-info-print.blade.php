<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Nota</title>
    <style type="text/css">
    	html,body{
    		margin:0;
    		padding:0;
    	}
    	*{
    		box-sizing: border-box;
    	}
    </style>
</head>
<body>
    <embed src="{!! $pdf !!}" type="application/pdf" id="pdfDoc" style="height:100vh;width: 100%;">
</body>
</html>