<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
  <script defer src="./js/alpinejs.cdn.min.js"></script>
</head>
<body class="min-h-screen">
    <?php include('./includes/front/header.php'); ?>         
        <div class="flex-wrap md:flex">
            <div class="w:full md:flex-1">
                <?php include('./includes/front/carousel.php'); ?>
            </div>
            <div class="w-full md:w-64">
                <h1>Hello</h1>
            </div>             
        </div>        
    <?php include('./includes/front/footer.php'); ?>  
</body>
</html>