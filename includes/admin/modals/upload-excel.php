<div id="uploadExcelModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">            
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-sm xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    
                    <div>
                        <form @submit.prevent="uploadExcelFile">
                            <div class="flex-col items-center justify-center p-2 border-2 border-dashed border-gray-600">
                                <input type="file" @change.prevent="hideExcelInput" class="bg-green-500 text-white p-2 rounded w-full cursor-pointer" x-ref="excelFile" accept=".xlsx, .xls, .csv">
                                
                                <button type="submit" x-ref="excelUploadButton" class="bg-blue-500 text-white p-2 rounded w-full cursor-pointer hidden" :disabled="excelUploadLoading">
                                    <span x-text="excelUploadLoading ? 'Uploading...' : 'Upload File Now'"></span>
                                </button>
                            </div>
                        </form>

                        <div x-text="excelUploadMessage" class="mt-4 font-semibold"></div>
                    </div>

                </div>
            </div>                
    </div>