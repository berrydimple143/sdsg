<div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">            
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Payment Form
                    </h1>
                    <form @submit.prevent="submitPayment" class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Payment</label>
                            <input type="datetime-local" step="1" x-model="created_at" name="created_at" id="created_at" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please select date of payment here ..." required="">
                            <span x-show="errors.created_at" class="text-red-500" x-text="errors.created_at"></span>
                        </div>
                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount to pay</label>
                            <input type="text" x-model="amount" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Please enter your amount here ..." required="">
                            <span x-show="errors.amount" class="text-red-500" x-text="errors.amount"></span>
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">What To Pay</label>
                            <select x-model="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                <option value="">Select what to pay here ...</option>
                                <option value="ID">ID</option>          
                                <option value="Monthly Due">Monthly Due</option>                    
                            </select>
                            <span x-show="errors.type" class="text-red-500" x-text="errors.type"></span>
                        </div>
                        <div class="flex items-center justify-center">
                            <button type="submit" class="w-full text-white bg-green-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer mr-2">Pay Now</button>

                            <button @click.prevent="cancelPayment" type="button" class="w-full text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-warning-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-warning-600 dark:hover:bg-warning-700 dark:focus:ring-warning-800 cursor-pointer">Cancel</button>
                        </div>				                  
                                                
                    </form>
                </div>
            </div>                
    </div>