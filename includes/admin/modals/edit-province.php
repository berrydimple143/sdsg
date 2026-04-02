<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
    <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">				              
            <form @submit.prevent="updateProvince" class="space-y-4 md:space-y-6" action="#">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province Name</label>
                    <input type="text" x-model="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter province name here ..." required="">
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