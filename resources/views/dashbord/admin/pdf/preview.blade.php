<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Preview</title>
</head>
<body>
<!-- Embed the PDF content for preview -->
<embed src="data:application/pdf;base64,{{ base64_encode($pdf) }}" width="100%" height="600px" type="application/pdf">
</body>
</html>
