<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel - Cities</title>
  <link href="../src/output.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../images/logo.ico">
  <style>
    [x-cloak] { display: none !important; }
  </style>
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="pageLoad()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">      
        <?php include('../includes/admin/modals/save-successful.php'); ?>
        <?php include('../includes/admin/modals/delete-successful.php'); ?>
        <?php include('../includes/admin/modals/add-successful.php'); ?>
        <?php include('../includes/admin/modals/change-successful.php'); ?>

        <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
				          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				              <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-md dark:text-white">
				                  Are you sure you want to delete this city?
				              </h1>
				             			                  
                                  <div class="flex items-center justify-around">
                                        <button @click.prevent="deleteCity" type="button" class="inline-flex text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer mr-2">                                        
                                        <?php include('../includes/admin/icons/region-delete.php'); ?>     
                                        Yes
                                        </button>

                                        <button @click.prevent="cancelDeletion" type="button" class="inline-flex text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-warning-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-warning-600 dark:hover:bg-warning-700 dark:focus:ring-warning-800 cursor-pointer">
                                        <?php include('../includes/admin/icons/region-delete-cancel.php'); ?>
                                        No</button>
                                  </div>
				          </div>
				      </div>                
        </div>
        <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
				          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">				              
				              <form @submit.prevent="updateCity" class="space-y-4 md:space-y-6" action="#">
				                  <div>
				                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City Name</label>
				                      <input type="text" x-model="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter city here ..." required="">
				                      <span x-show="errors.name" class="text-red-500" x-text="errors.name"></span>
				                  </div>
                                  <div class="flex items-center justify-around">
                                        <button type="submit" class="inline-flex text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer mr-2">
                                        <?php include('../includes/admin/icons/save.php'); ?>
                                        Save Changes
                                        </button>

                                        <button @click.prevent="cancelUpdate" type="button" class="inline-flex text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-warning-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-warning-600 dark:hover:bg-warning-700 dark:focus:ring-warning-800 cursor-pointer">
                                        <?php include('../includes/admin/icons/region-add-cancel.php'); ?> 
                                        Cancel</button>
                                  </div>				                  
				                  		                  
				              </form>
				          </div>
				      </div>                
        </div>        

        <?php include('../includes/admin/modals/add-city.php'); ?>

        <div class="flex h-screen bg-transparent">

					<!-- Mobile menu toggle button -->
					<input type="checkbox" id="menu-toggle" class="hidden peer">

					<?php include('../includes/admin/sidebar.php'); ?>

					<!-- Main content -->
					<div class="flex flex-col flex-1 overflow-y-auto">
						<?php include('../includes/admin/header.php'); ?>
						<div class="p-1">
                            <div class="w-full flex items-center justify-between bg-green-400 p-2">
                                <h1 class="text-2xl text-purple-600 font-bold p-2 text-shadow-lg">List of Cities/Municipalities</h1>
                                <button @click.prevent="addNow" type="button" class="inline-flex items-center text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-md p-2  cursor-pointer">
                                <?php include('../includes/admin/icons/region-add.php'); ?>
                                Add
                                </button>
                            </div>
							
							
                            <div class="relative overflow-x-auto bg-green-400 shadow-xs rounded-base border border-default">
                                <?php include('../includes/admin/tables/city.php'); ?>
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
            province_id: null,
            region_id: null,
            district_id: null,
            barangay_id: null,
            city_id: null,
            regions: [],
            provinces: [],
            cities: [],
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
                                        page: 'city'
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
            async deleteCity() {                
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/deleteData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.deleteId,
                                        page: 'city'
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
            async addCity() {
                if (!this.validate()) return;
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/addData.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            name: this.name,
                            province_id: this.province_id,                            
                            region_id: 7,
                            district_id: 7,   
                            barangay_id: 7,
                            city_id: 7,
                            page: 'city'
                        })
                    });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {                    
                    this.init(); 
                    this.addModal.classList.add('hidden');
                    this.displayModal('add', 2000);
                }
            },
            async editCity(id) {
                this.editId = id;
                this.editModal = document.getElementById('editModal');
                this.editModal.classList.remove('hidden');
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/getData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.editId,
                                        page: 'city'
                                    })
                                });
                    let res = await response.json();
                    this.name = res.data.name;
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } 
            },
            async updateCity() {
                if (!this.validate()) return;
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/editData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        name: this.name,
                                        id: this.editId,
                                        page: 'city'
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
            async selectField(id, page) {
                let response = await fetch('http://localhost/sdsg/api/admin/getAllDataById.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'},
                                body: JSON.stringify({                                     
                                    page: page,
                                    id: id
                                })
                            });
                let res = await response.json();
                if(page == 'province') {
                    this.provinces = res.data;
                } else if(page == 'city') {
                    this.cities = res.data;
                }   
            },
            async getAllData(page) {
                let response = await fetch('http://localhost/sdsg/api/admin/getAllData.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'},
                                body: JSON.stringify({                                     
                                    page: page
                                })
                            });
                let res = await response.json();
                if(page == 'region') {
                    this.regions = res.data;     
                } else if(page == 'province') {
                    this.provinces = res.data;
                } else if(page == 'city') {
                    this.cities = res.data; 
                    this.showRow = false;                 
                    if(this.cities.length > 0) {
                        this.showRow = true;
                    }
                }               
            },
            init() {                
                this.getAllData('region');
                this.getAllData('city');
            }	
		  }
		}        
	</script>

</body>
</html>