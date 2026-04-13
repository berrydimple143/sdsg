<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel</title>
  <link href="../src/output.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../images/logo.ico">
  <script defer src="../js/alpinejs.cdn.min.js"></script>  
  <script src="../js/chart.min.js"></script>
</head>
<body x-data="dashboard()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">
  		<?php include('../includes/admin/modals/loading.php'); ?>
  		<div class="flex h-screen bg-transparent">

					<!-- Mobile menu toggle button -->
					<input type="checkbox" id="menu-toggle" class="hidden peer">

					<?php include('../includes/admin/sidebar.php'); ?>

					<!-- Main content -->
					<div class="flex flex-col flex-1 overflow-y-auto">
						<?php include('../includes/admin/header.php'); ?>
						<div class="p-4">
							<h1 class="text-2xl font-bold">Beneficiaries for <span x-text="currentYear"></span></h1>
							<div style="position: relative; height:80vh; width:80vw">
								<canvas x-ref="canvas"></canvas>
							</div>
						</div>
					</div>
				</div>
	
	<script>
		function dashboard() {
			return {
				currentYear: null,
				loadingModal: null,
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				regular: [10, 20, 30, 15, 14, 20, 53, 17, 33, 26, 11, 18],
				paying: [40, 10, 43, 18, 16, 30, 33, 27, 43, 36, 21, 48],
				async getPaying() {
					let response = await fetch('http://localhost/sdsg/api/admin/countMembers.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'},
								body: JSON.stringify({ 
                                    mtype: 'paying'
                                })
                            });
                		const reg = await response.json();									
						this.paying[0] = reg.janMembers;
						this.paying[1] = reg.febMembers;
						this.paying[2] = reg.marMembers;
						this.paying[3] = reg.aprMembers;
						this.paying[4] = reg.mayMembers;
						this.paying[5] = reg.junMembers;
						this.paying[6] = reg.julMembers;
						this.paying[7] = reg.augMembers;
						this.paying[8] = reg.sepMembers;
						this.paying[9] = reg.octMembers;
						this.paying[10] = reg.novMembers;
						this.paying[11] = reg.decMembers;
				},
				async getNotPaying() {
					let response = await fetch('http://localhost/sdsg/api/admin/countMembers.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'},
								body: JSON.stringify({ 
                                    mtype: 'nonpaying'
                                })
                            });
                		const reg = await response.json();									
						this.regular[0] = reg.janMembers;
						this.regular[1] = reg.febMembers;
						this.regular[2] = reg.marMembers;
						this.regular[3] = reg.aprMembers;
						this.regular[4] = reg.mayMembers;
						this.regular[5] = reg.junMembers;
						this.regular[6] = reg.julMembers;
						this.regular[7] = reg.augMembers;
						this.regular[8] = reg.sepMembers;
						this.regular[9] = reg.octMembers;
						this.regular[10] = reg.novMembers;
						this.regular[11] = reg.decMembers;
				},
				checkAuth() {
					let logged = sessionStorage.getItem("logged");
					setTimeout(() => {
						if(!logged) {
							window.location = "../login.php";
						}
					}, 50);
				},				
				init() {
					this.getPaying();		
					this.getNotPaying();
					this.loadingModal = document.getElementById('loadingModal');	
                	this.loadingModal.classList.remove('hidden'); 
					const currentDate = new Date();
					this.currentYear = currentDate.getFullYear();
					this.checkAuth();										
					setTimeout(() => {

						new Chart(this.$refs.canvas, {
							type: 'bar',
							data: {
								labels: this.labels,
								datasets: [
									{
										label: 'Non-Paying Beneficiaries',
										data: this.regular,
										borderColor: '#e71d00', 
										borderWidth: 1,
										backgroundColor: '#f17766',
									},
									{
										label: 'Paying Beneficiaries',
										data: this.paying,
										borderWidth: 1,
										borderColor: '#2e4b21', 
										backgroundColor: '#00e757',
									}
								]
							},
							options: {
								plugins: {
									legend: {
										labels: {										
											font: {
												size: 18
											}
										}
									}
								}
							}
						});
						this.loadingModal.classList.add('hidden');
					}, 1000);					
				}
			}
		}
	</script>
</body>
</html>
