<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel</title>
  <link href="../src/output.css" rel="stylesheet">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="dashboard()" x-init="checkAuth()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">
  		
  		<div class="flex h-screen bg-transparent">

					<!-- Mobile menu toggle button -->
					<input type="checkbox" id="menu-toggle" class="hidden peer">

					<?php include('../includes/admin/sidebar.php'); ?>

					<!-- Main content -->
					<div class="flex flex-col flex-1 overflow-y-auto">
						<?php include('../includes/admin/header.php'); ?>
						<div class="p-4">
							<h1 class="text-2xl font-bold">Welcome to my dashboard!</h1>
							<p class="mt-2 text-gray-600">This is an example dashboard using Tailwind CSS.</p>
						</div>
					</div>
				</div>

	<script>

		function checkAuth() {
			let logged = sessionStorage.getItem("logged");
			setTimeout(() => {
			if(!logged) {
					window.location = "../login.php";
			}
			}, 50);
		}		
		
		function dashboard() {
		  return {
		    loggedin: sessionStorage.getItem("logged")			
		  }
		}
	</script>

</body>
</html>