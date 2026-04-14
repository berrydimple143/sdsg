<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc.</title>
  <link href="./src/output.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="./images/logo.ico">
  <script defer src="./js/alpinejs.cdn.min.js"></script>
  <script src="./js/elements@1.js" type="module"></script>
</head>
<body x-data="pageLoad" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat overflow-x-hidden">
  		
    <?php include('./includes/front/site/header.php'); ?>
    <div class="flex-wrap md:flex">
        <div class="w:full md:flex-1">
            <?php include('./includes/front/carousel.php'); ?>
        </div>                    
    </div>   
	<script>  
        function pageLoad() {
            return {
                isLogged: false,
                register() {
                    window.location = "register.php";
                }
            }
        }		
	</script>
</body>
</html>