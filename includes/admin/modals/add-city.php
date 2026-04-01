<div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    City Registration
                </h1>
                <form @submit.prevent="addCity" class="space-y-4 md:space-y-6" action="#">
                    <div>
                        <label for="region_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region</label>
                        <select x-model="region_id" @change="selectField($event.target.value, 'province')" name="region_id" id="region_id" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        <option value="">Select region here ...</option>
                        <template x-for="reg in regions" :key="reg.id">
                            <option :value="reg.id" x-text="reg.name"></option>
                        </template>
                        </select>
                        <span x-show="errors.region_id" class="text-red-500" x-text="errors.region_id"></span>
                    </div>
                    <div>
                        <label for="province_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                        <select x-model="province_id" name="province_id" id="province_id" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        <option value="">Select province here ...</option>
                        <template x-for="prov in provinces" :key="prov.id">
                            <option :value="prov.id" x-text="prov.name"></option>
                        </template>
                        </select>
                        <span x-show="errors.province_id" class="text-red-500" x-text="errors.province_id"></span>
                    </div>
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City Name</label>
                        <input type="text" x-model="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter city here ..." required="">
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