<div id="deletePaymentModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-md font-bold leading-tight tracking-tight text-gray-900 md:text-md dark:text-white">
                    Are you sure you want to delete this payment?
                </h1>                                            
                    <div class="flex items-center">
                        <button @click.prevent="deletePayment" type="button" class="inline-flex text-white bg-gradient-to-r from-green-500 via-green-600 to-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer mr-2">                                        
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