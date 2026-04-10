<div id="paymentsTableModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">            
        <div class="w-[50%] max-h-[90vh] overflow-y-auto bg-white rounded-lg shadow dark:border md:mt-0 dark:bg-gray-800 dark:border-gray-700">                     
            <div class="p-2">
                <h1 class="text-2xl font-bold bg-green-400 p-2">Payments of <span x-model="owner" x-text="owner"></span></h1>							
                <div class="relative overflow-x-auto bg-green-400 shadow-xs rounded-base border border-default">                                
                    <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                        <thead class="text-lg text-black bg-brand border-b border-brand-light">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-bold">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3 font-bold">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 font-bold">
                                    Date of Payment
                                </th>                        
                                <th scope="col" class="px-6 py-3 font-bold text-center">
                                    Action
                                </th>                        
                            </tr>
                        </thead>
                        <tbody>
                            <tr x-show="payments.length === 0" class="bg-brand border-b border-brand-light hover:bg-green-500">
                                <td colspan="4" class="px-3 py-2 text-center text-md font-bold">No payments made yet ...</td>
                            </tr>                    
                            <template x-for="(pay, index) in payments" :key="pay.id">
                                <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                                    <th scope="row" x-text="index + 1" class="px-6 py-4  font-medium text-fg-brand-subtle whitespace-nowrap">                                            
                                    </th>               
                                    <th scope="row" class="flex items-center space-x-2 px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                        <?php include('../includes/admin/icons/peso-black.php'); ?>         
                                        <span x-text="pay.amount.toFixed(2)"></span>                         
                                    </th>
                                    <th scope="row" x-text="convertDate(pay.created_at)" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                                    </th>                                   
                                    <th scope="row" class="flex items-center space-x-2 px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                     
                                        <button @click.prevent="editPayment(pay.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                        <?php include('../includes/admin/icons/region-edit.php'); ?>
                                        Edit
                                        </button>
                                        <button @click.prevent="deleteConfirm(pay.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                                        <?php include('../includes/admin/icons/trash.php'); ?>
                                        Delete
                                        </button>
                                    </th>
                                </tr>
                            </template>    
                            <tr colspan="4" class="bg-brand border-b border-brand-light hover:bg-green-500">
                                <th scope="row" class="px-6 py-4 text-md font-bold text-fg-brand-subtle whitespace-nowrap">
                                    Total                                
                                    </th>                   
                                <th scope="row" class="flex items-center space-x-2 px-6 py-4 font-bold text-fg-brand-subtle whitespace-nowrap">
                                    <?php include('../includes/admin/icons/peso-black.php'); ?>         
                                    <span x-text="totalPay.toFixed(2)"></span>                         
                                </th>
                            </tr>                        
                        </tbody>
                    </table>
                </div>
                <button @click.prevent="closeTable" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2 cursor-pointer mt-2">
                    <?php include('../includes/admin/icons/inactive.php'); ?>
                    Close
                </button>
            </div>
        </div>                
    </div>