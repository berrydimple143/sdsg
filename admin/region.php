<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel - Regions</title>
  <link href="../src/output.css" rel="stylesheet">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="pageLoad()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">      

        <!-- Backdrop -->
        <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
            <!-- Modal Card -->
                
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
				          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				              <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-md dark:text-white">
				                  Are you sure you want to delete this region?
				              </h1>
				             			                  
                                  <div class="flex items-center justify-around">
                                        <button @click.prevent="deleteRegion" type="button" class="inline-flex text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer mr-2">                                        
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

        <!-- Edit Modal -->
        <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
				          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">				              
				              <form @submit.prevent="addRegion" class="space-y-4 md:space-y-6" action="#">
				                  <div>
				                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region Name</label>
				                      <input type="text" x-model="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter region name here ..." required="">
				                      <span x-show="errors.name" class="text-red-500" x-text="errors.name"></span>
				                  </div>
                                  <div class="flex items-center justify-around">
                                        <button type="submit" class="inline-flex text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer mr-2">
                                        <?php include('../includes/admin/icons/region-add.php'); ?>
                                        Add
                                        </button>

                                        <button @click.prevent="cancelUpdate" type="button" class="inline-flex text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-warning-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-warning-600 dark:hover:bg-warning-700 dark:focus:ring-warning-800 cursor-pointer">
                                        <?php include('../includes/admin/icons/region-add-cancel.php'); ?> 
                                        Cancel</button>
                                  </div>				                  
				                  		                  
				              </form>
				          </div>
				      </div>                
        </div>

        <!-- Add Modal -->
        <div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
            <!-- Modal Card -->
                
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
				          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
				              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
				                  Region Registration Form
				              </h1>
				              <form @submit.prevent="addRegion" class="space-y-4 md:space-y-6" action="#">
				                  <div>
				                      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region Name</label>
				                      <input type="text" x-model="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter region name here ..." required="">
				                      <span x-show="errors.name" class="text-red-500" x-text="errors.name"></span>
				                  </div>
                                  <div class="flex items-center justify-around">
                                        <button type="submit" class="inline-flex text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer mr-2">
                                        <?php include('../includes/admin/icons/region-add.php'); ?>
                                        Add
                                        </button>

                                        <button @click.prevent="cancelAddition" type="button" class="inline-flex text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-warning-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-warning-600 dark:hover:bg-warning-700 dark:focus:ring-warning-800 cursor-pointer">
                                        <?php include('../includes/admin/icons/region-add-cancel.php'); ?> 
                                        Cancel</button>
                                  </div>				                  
				                  		                  
				              </form>
				          </div>
				      </div>                
        </div>

        <div class="flex h-screen bg-transparent">

					<!-- Mobile menu toggle button -->
					<input type="checkbox" id="menu-toggle" class="hidden peer">

					<?php include('../includes/admin/sidebar.php'); ?>

					<!-- Main content -->
					<div class="flex flex-col flex-1 overflow-y-auto">
						<?php include('../includes/admin/header.php'); ?>
						<div class="p-1">
                            <div class="w-full flex items-center justify-between bg-green-400 p-2">
                                <h1 class="text-2xl font-bold">Regions</h1>
                                <button @click.prevent="addNow" type="button" class="inline-flex items-center text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-md p-2  cursor-pointer">
                                <?php include('../includes/admin/icons/region-add.php'); ?>
                                Add
                                </button>
                            </div>
							
							
                            <div class="relative overflow-x-auto bg-green-400 shadow-xs rounded-base border border-default">
                                <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                                    <thead class="text-sm text-white bg-brand border-b border-brand-light">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Region Name
                                            </th>           
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Status
                                            </th>                               
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Date Created
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr x-show="regions.length === 0" class="bg-brand border-b border-brand-light hover:bg-green-500">
                                            <td colspan="3" class="px-3 py-2 text-center text-md font-bold">No regions yet ...</td>
                                        </tr>
                                        
                                        <template x-for="ben in regions" :key="ben.id">

                                            <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                                                <th scope="row" x-text="ben.name" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                                                </th>
                                                <td class="px-6 py-4" x-text="setStatus(ben.status)"></td>  
                                                <td class="px-6 py-4" x-text="formatDate(ben.created_at)"></td>                                                
                                                <td class="px-3 py-1 text-center" x-show="showRow">                                                    
                                                    <button @click.prevent="editRegion(ben.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                    <?php include('../includes/admin/icons/region-edit.php'); ?>
                                                    Edit
                                                    </button>
                                                    <button @click.prevent="deleteConfirm(ben.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                                                    <?php include('../includes/admin/icons/trash.php'); ?>
                                                    Delete
                                                    </button>
                                                    
                                                </td>
                                            </tr>
                                        </template>                                        
                                    </tbody>
                                </table>
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
            regions: [],
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
            async editRegion(id) {
                this.editId = id;
                this.editModal = document.getElementById('editModal');
                this.editModal.classList.remove('hidden');
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/getRegion.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.editId                                        
                                    })
                                });
                    let res = await response.json();       
                    this.name = res.region[0].name;
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } 
            },
            async updateRegion() {
                
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
            async deleteRegion() {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/deleteRegion.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.deleteId
                                    })
                                });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();                  
                    this.deleteModal.classList.add('hidden');                    
                }
            },
            async addRegion() {
                if (!this.validate()) return;
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/addRegion.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        name: this.name
                                    })
                                });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {                    
                    this.init(); 
                    this.addModal.classList.add('hidden');
                }
            },
            async init() {               
                let response = await fetch('http://localhost/sdsg/api/admin/getRegions.php', {
                                method: 'POST',
                                headers: {'Content-Type': 'application/json'}
                            });
                let region = await response.json();
                this.regions = region.regions;               
                this.showRow = false;                 
                if(this.regions.length > 0) {
                    this.showRow = true;
                }
            }	
		  }
		}        
	</script>

</body>
</html>