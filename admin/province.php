<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel - Provinces</title>
  <link href="../src/output.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../images/logo.ico">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="pageLoad()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">      
        <?php include('../includes/admin/modals/save-successful.php'); ?>
        <?php include('../includes/admin/modals/delete-successful.php'); ?>
        <?php include('../includes/admin/modals/add-successful.php'); ?>
        <?php include('../includes/admin/modals/change-successful.php'); ?>       
        <?php include('../includes/admin/modals/add-province.php'); ?>
        <?php include('../includes/admin/modals/edit-province.php'); ?>
        <?php include('../includes/admin/modals/delete-province.php'); ?>

        <div class="flex h-screen bg-transparent">

					<!-- Mobile menu toggle button -->
					<input type="checkbox" id="menu-toggle" class="hidden peer">

					<?php include('../includes/admin/sidebar.php'); ?>

					<!-- Main content -->
					<div class="flex flex-col flex-1 overflow-y-auto">
						<?php include('../includes/admin/header.php'); ?>
						<div class="p-1">
                            <div class="w-full flex items-center justify-between bg-green-400 p-2">
                                <h1 class="text-2xl text-purple-600 font-bold p-2 text-shadow-lg">List of Provinces</h1>
                                <button @click.prevent="addNow" type="button" class="inline-flex items-center text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-md p-2  cursor-pointer">
                                <?php include('../includes/admin/icons/region-add.php'); ?>
                                Add
                                </button>
                            </div>						
							
                            <div class="relative overflow-x-auto bg-green-400 shadow-xs rounded-base border border-default">
                                <?php include('../includes/admin/tables/province.php'); ?>
                            </div>
						</div>
					</div>
				</div>

	<script>
        function pageLoad() {
		  return {
            showRow: false,
            name: '',
            deleteId: null,
            editId: null,
            addModal: {},
            deleteModal: {},
            successModal: {},
            deleteSuccessful: {},
            addSuccessful: {},
            region_id: null,
            district_id: null,
            barangay_id: null,
            city_id: null,
            province_id: null,
            regions: [],
            provinces: [],
            errors: [],
            clearInputs() {
                this.name = '';
            },
            formatDate(dt) {
                const dat = new Date(dt);
                return dat.toDateString();
            },
            setStatus(st) {
                return st ? "Active" : "Inactive";     
            },
            validate() {
		      this.errors = {}
		      if (!this.name) this.errors.name = "(Required)"		            
		      return Object.keys(this.errors).length === 0
		    },
            addNow() {
                this.clearInputs();
                this.addModal = document.getElementById('addModal');
                this.addModal.classList.remove('hidden');                                
            },
            async changeStatus(id, status) {                
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/changeStatus.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: id,
                                        status: status,
                                        page: 'province'
                                    })
                                });
                    let res = await response.json();
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('change', 2000);
                }
            },
            async editProvince(id) {
                this.editId = id;
                this.editModal = document.getElementById('editModal');
                this.editModal.classList.remove('hidden');
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/getData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.editId,
                                        page: 'province'
                                    })
                                });
                    let res = await response.json();
                    this.name = res.data.name;
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } 
            },
            async updateProvince() {
                if (!this.validate()) return;
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/editData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        name: this.name,
                                        id: this.editId,
                                        page: 'province'
                                    })
                                });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {                    
                    this.init();                                  
                    this.editModal.classList.add('hidden');
                    this.displayModal('edit', 2000);
                }
            },
            displayModal(page, msec) {
                if(page == 'edit') {
                    this.successModal = document.getElementById('successModal');
                    this.successModal.classList.remove('hidden');
                } else if(page == 'delete') {
                    this.deleteSuccessful = document.getElementById('deleteSuccessful');
                    this.deleteSuccessful.classList.remove('hidden');
                } else if(page == 'add') {
                    this.addSuccessful = document.getElementById('addSuccessful');
                    this.addSuccessful.classList.remove('hidden');
                } else if(page == 'change') {
                    this.changeSuccessful = document.getElementById('changeSuccessful');
                    this.changeSuccessful.classList.remove('hidden');
                }
                setTimeout(() => {
                    if(page == 'edit') {
                        this.successModal.classList.add('hidden');
                    } else if(page == 'delete') {
                        this.deleteSuccessful.classList.add('hidden');
                    } else if(page == 'add') {
                        this.addSuccessful.classList.add('hidden');
                    } else if(page == 'change') {
                        this.changeSuccessful.classList.add('hidden');
                    }
                }, msec);
            },            
            cancelUpdate() {                
                this.editModal.classList.add('hidden');
            },
            cancelAddition() {                
                this.addModal.classList.add('hidden');
            },
            cancelDeletion() {
                this.deleteModal.classList.add('hidden');
            },
            deleteConfirm(id) {
                this.deleteId = id;
                this.deleteModal = document.getElementById('deleteModal');
                this.deleteModal.classList.remove('hidden');                
            },
            async deleteProvince() {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/deleteData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.deleteId,
                                        page: 'province'
                                    })
                                });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();                  
                    this.deleteModal.classList.add('hidden');
                    this.displayModal('delete', 2000);
                }
            },
            async addProvince() {
                if (!this.validate()) return;
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/addData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        name: this.name,
                                        region_id: this.region_id,                                       
                                        district_id: 7,   
                                        barangay_id: 7,
                                        city_id: 7,
                                        province_id: 7,
                                        page: 'province'
                                    })
                                });
                    let res = await response.json();       
                    console.log(res.data);                     
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {                    
                    this.init(); 
                    this.addModal.classList.add('hidden');
                    this.displayModal('add', 2000);
                }
            },
            async getProvinces() {
                let response = await fetch('http://localhost/sdsg/api/admin/getProvinces.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'}
                            });
                let province = await response.json();
                this.provinces = province.provinces;               
                this.showRow = false;                 
                if(this.provinces.length > 0) {
                    this.showRow = true;
                }
            },
            async getRegions() {
                let response = await fetch('http://localhost/sdsg/api/admin/getRegions.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'}
                            });
                let region = await response.json();
                this.regions = region.regions;               
            },
            init() {                
                this.getRegions();
                this.getProvinces();
            }	
		  }
		}        
	</script>

</body>
</html>