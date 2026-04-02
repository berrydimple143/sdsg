<div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">

    <div class="px-5 py-3 bg-white shadow-2xl w-lg">  		 		
        <form @submit.prevent="addPurok" class="max-w-4xl mx-auto">
            <div class="mb-6">
                    <p class="text-center text-white text-2xl text-shadow-lg bg-gradient-to-t from-green-500 to-green-400 rounded-md py-2">* * * Purok/Sitio Registration * * *</p>
            </div>
                <div class="grid grid-cols-2 gap-6 mb-6">		    
                <div>
                    <label for="region_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region <span class="text-red-500 text-md font-bold">*</span></label>                    
                    <select x-model="region_id" 
                       @change="selectField($event.target.value, 'province')" 
                        name="region_id" id="region_id"  
                        class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                        required="">
                        <option value="">Select region here ...</option>
                        <template x-for="reg in regions" :key="reg.id">
                            <option :value="reg.id" x-text="reg.name"></option>
                        </template>
                        </select>
                        <span x-show="errors.region_id" class="text-red-500" x-text="errors.region_id"></span>
                </div>
                <div>
                    <label for="province_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province <span class="text-red-500 text-md font-bold">*</span></label>                    
                    <select x-model="province_id" 
                       @change="selectField($event.target.value, 'city')" 
                        name="province_id" id="province_id"  
                        class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                        required="">
                        <option value="">Select province here ...</option>
                        <template x-for="prov in provinces" :key="prov.id">
                            <option :value="prov.id" x-text="prov.name"></option>
                        </template>
                        </select>
                        <span x-show="errors.province_id" class="text-red-500" x-text="errors.province_id"></span>
                </div>                
                <div>
                    <label for="city_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City <span class="text-red-500 text-md font-bold">*</span></label>                    
                    <select x-model="city_id" 
                       @change="selectField($event.target.value, 'district')" 
                        name="city_id" id="city_id"  
                        class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                        required="">
                        <option value="">Select city here ...</option>
                        <template x-for="ct in cities" :key="ct.id">
                            <option :value="ct.id" x-text="ct.name"></option>
                        </template>
                        </select>
                        <span x-show="errors.city_id" class="text-red-500" x-text="errors.city_id"></span>
                </div>
                <div>
                    <label for="district_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">District <span class="text-red-500 text-md font-bold">*</span></label>                    
                    <select x-model="district_id" 
                       @change="selectField($event.target.value, 'barangay')" 
                        name="district_id" id="district_id"  
                        class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                        required="">
                        <option value="">Select district here ...</option>
                        <template x-for="dist in districts" :key="dist.id">
                            <option :value="dist.id" x-text="dist.name"></option>
                        </template>
                        </select>
                        <span x-show="errors.district_id" class="text-red-500" x-text="errors.district_id"></span>
                </div>
                <div>
                    <label for="barangay_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay <span class="text-red-500 text-md font-bold">*</span></label>                    
                    <select 
                        x-model="barangay_id"                        
                        name="barangay_id" id="barangay_id"  
                        class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" 
                        required="">
                        <option value="">Select barangay here ...</option>
                        <template x-for="bar in barangays" :key="bar.id">
                            <option :value="bar.id" x-text="bar.name"></option>
                        </template>
                        </select>
                        <span x-show="errors.barangay_id" class="text-red-500" x-text="errors.barangay_id"></span>
                </div>

                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Purok/Sitio Name <span class="text-red-500 text-md font-bold">*</span></label>
                    <input type="text" id="name" name="name" placeholder="Enter purok/sitio name here ..." x-model="name" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">
                    <span x-show="errors.name" class="text-red-500" x-text="errors.name"></span>
                </div>              
                <div>
                    <button type="submit" class="inline-flex text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer mr-2">
                    <?php include('../includes/admin/icons/region-add.php'); ?>
                    Add
                    </button>
                    <button @click.prevent="cancelAddition" type="button" class="inline-flex text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-warning-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-warning-600 dark:hover:bg-warning-700 dark:focus:ring-warning-800 cursor-pointer">
                        <?php include('../includes/admin/icons/region-add-cancel.php'); ?> 
                        Cancel</button>
                </div>
                </div>
        </form>
    </div>
</div>
</div>