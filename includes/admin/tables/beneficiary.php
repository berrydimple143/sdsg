<table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
    <thead class="text-md text-shadow-md text-gray-700 font-bold bg-brand border-b border-brand-light">
        <tr>            
            <th scope="col" class="px-6 py-3 font-medium">
                Last Name
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                First Name
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Middle Name
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Barangay
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Member Type
            </th>
            <th scope="col" class="px-6 py-3 font-medium text-center">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        <template x-for="(ben, index) in paginatedItems" :key="ben.id">
            <tr 
                :class="{ 'bg-brand hover:bg-green-500': ben.status, 'bg-gray-300 hover:bg-yellow-500': !ben.status }" 
                class="border-b border-brand-light">
                <th scope="row" x-text="ben.lastname" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                </th>
                <td class="px-6 py-4" x-text="ben.firstname"></td>
                <td class="px-6 py-4" x-text="ben.middlename"></td>
                <td class="px-6 py-4" x-text="capitalizeFirstLetter(ben.barangay)"></td>
                <td class="px-6 py-4">
                    <button 
                    type="button" 
                    id="infoButton"  
                    @click.prevent="changeStatus(ben.id, ben.classification)" 
                    x-text="ben.classification" 
                    :class="{ 'bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 focus:ring-blue-300 dark:focus:ring-blue-800': setClassification(ben.classification), 'bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 focus:ring-gray-300 dark:focus:ring-gray-800': !setClassification(ben.classification) }"
                    class="inline-flex items-center rounded-full text-white hover:bg-gradient-to-br focus:ring-4 focus:outline-none box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer"></button>
                </td>
                <td class="px-3 py-1 text-center inline-flex items-center justify-center align-middle" x-show="showRow">

                    <div 
                        x-data="{ isOpen: false }" 
                        @mouseenter="isOpen = true" 
                        @mouseleave="isOpen = false"
                        class="relative"
                    >

                        <button type="button" @click.prevent="payNow(ben.id)" class="inline-flex items-center text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 cursor-pointer">
                        <?php include('../includes/admin/icons/peso2.php'); ?>
                        &nbsp;
                        </button>

                        <div 
                            x-show="isOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute z-10 w-14 p-1 mt-1 bg-white rounded-lg shadow-xl border border-gray-200 left-0"
                        >
                            <p class="font-bold text-gray-900">Pay</p>                            
                        </div>
                    </div>

                    <div 
                        x-data="{ isOpen: false }" 
                        @mouseenter="isOpen = true" 
                        @mouseleave="isOpen = false"
                        class="relative"
                    >
                        <button type="button" @click.prevent="editBeneficiary(ben.id)" class="inline-flex items-center  text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                        <?php include('../includes/admin/icons/edit.php'); ?>
                        &nbsp;
                        </button>      
                        <div 
                            x-show="isOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute z-10 w-14 p-1 mt-1 bg-white rounded-lg shadow-xl border border-gray-200 left-0"
                        >
                            <p class="font-bold text-gray-900">Edit</p>                            
                        </div>
                    </div>                   

                    <div 
                        x-data="{ isOpen: false }" 
                        @mouseenter="isOpen = true" 
                        @mouseleave="isOpen = false"
                        class="relative"
                    >

                        <button @click.prevent="deleteBeneficiaryConfirm(ben.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                        <?php include('../includes/admin/icons/trash2.php'); ?>
                            &nbsp;
                        </button>

                        <div 
                            x-show="isOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute z-10 w-16 p-1 mt-1 bg-white rounded-lg shadow-xl border border-gray-200 left-0"
                        >
                            <p class="font-bold text-gray-900">Delete</p>                            
                        </div>
                    </div>

                    <div 
                        x-data="{ isOpen: false }" 
                        @mouseenter="isOpen = true" 
                        @mouseleave="isOpen = false"
                        class="relative"
                    >

                        <button type="button" @click.prevent="showForm(ben.id)" class="inline-flex items-center  text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                        <?php include('../includes/admin/icons/download2.php'); ?>
                            &nbsp;
                        </button>                    
                        <div 
                            x-show="isOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute z-10 w-14 p-1 mt-1 bg-white rounded-lg shadow-xl border border-gray-200 left-0"
                        >
                            <p class="font-bold text-gray-900">Form</p>                            
                        </div>
                    </div>

                    <div 
                        x-data="{ isOpen: false }" 
                        @mouseenter="isOpen = true" 
                        @mouseleave="isOpen = false"
                        class="relative"
                    >

                        <button type="button" @click.prevent="showTable(ben.id)" class="inline-flex items-center  text-white bg-gradient-to-r from-gray-500 via-gray-600 to-gray-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 cursor-pointer">
                        <?php include('../includes/admin/icons/table2.php'); ?>  
                            &nbsp;         
                        </button>

                        <div 
                            x-show="isOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute z-10 w-20 p-1 mt-1 bg-white rounded-lg shadow-xl border border-gray-200 left-0"
                        >
                            <p class="font-bold text-gray-900">Payments</p>                            
                        </div>
                    </div>
                </td>
            </tr>            
        </template>         
        <template x-if="filteredItems.length === 0">
            <tr>
                <td colspan="7" class="text-center">
                    No data ...
                </td>
            </tr>
        </template>    
    </tbody>
    <tfoot>        
        <tr>                
            <td colspan="7">
            
                <div class="flex items-center justify-between">
                    <!-- Pagination Container -->
                    <div class="flex items-center space-x-1 p-2 bg-green-500">                    
                            <!-- Summary Information Indicator -->
                            <span class="text-lg text-white mr-2">
                                Page <span class="font-semibold" x-text="currentPage"></span> of <span class="font-semibold" x-text="totalPages"></span>
                            </span>
                            
                            <!-- First & Previous Buttons -->
                            <button 
                                class="px-3 py-1 bg-blue-600 text-lg text-white font-bold" 
                                @click="currentPage = 1" 
                                :disabled="currentPage === 1"
                                :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'">
                                «
                            </button>
                            <button 
                                class="px-3 py-1 bg-blue-600 text-lg text-white font-bold"
                                @click="currentPage--" 
                                :disabled="currentPage === 1"
                                :class="currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'">
                                ‹
                            </button>

                            <!-- Truncated Page Numbers -->
                            <template x-for="page in visiblePages" :key="page">
                                <button 
                                    class="px-4 py-2 font-bold"
                                    @click="currentPage = page" 
                                    x-text="page"
                                    :class="currentPage === page ? 'bg-blue-600 text-white font-bold' : 'bg-gray-200 cursor-pointer'">
                                </button>
                            </template>

                            <!-- Next & Last Buttons -->
                            <button 
                                class="px-3 py-1 bg-blue-600 text-lg text-white font-bold"
                                @click="currentPage++" 
                                :disabled="currentPage === totalPages"
                                :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'">
                                ›
                            </button>
                            <button 
                                class="px-3 py-1 bg-blue-600 text-lg text-white font-bold"
                                @click="currentPage = totalPages" 
                                :disabled="currentPage === totalPages"
                                :class="currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'">
                                »
                            </button>                    
                    </div>
                    <div class="p-2 bg-green-800 text-white mr-2 border-1 border-gray-300">
                        Total Beneficiaries: <span x-text="totalUsers"></span>
                    </div>
                </div>
            </td>
        </tr>
    </tfoot>    
</table>