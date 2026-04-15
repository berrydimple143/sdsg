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
                Member Type
            </th>
            <th scope="col" class="px-6 py-3 font-medium text-center">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        <template x-for="ben in beneficiaries" :key="ben.id">
            <tr 
                :class="{ 'bg-brand hover:bg-green-500': ben.status, 'bg-gray-300 hover:bg-yellow-500': !ben.status }" 
                class="border-b border-brand-light">
                <th scope="row" x-text="ben.lastname" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                </th>
                <td class="px-6 py-4" x-text="ben.firstname"></td>
                <td class="px-6 py-4" x-text="ben.middlename"></td>
                <td class="px-6 py-4">
                    <button 
                    type="button" 
                    id="infoButton"  
                    @click.prevent="changeStatus(ben.id, ben.classification)" 
                    x-text="ben.classification" 
                    :class="{ 'bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 focus:ring-blue-300 dark:focus:ring-blue-800': setClassification(ben.classification), 'bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 focus:ring-gray-300 dark:focus:ring-gray-800': !setClassification(ben.classification) }"
                    class="inline-flex items-center rounded-full text-white hover:bg-gradient-to-br focus:ring-4 focus:outline-none box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer"></button>
                </td>
                <td class="px-3 py-1 text-right" x-show="showRow">
                    <button type="button" @click.prevent="payNow(ben.id)" class="inline-flex items-center text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 cursor-pointer">
                    <?php include('../includes/admin/icons/peso.php'); ?>
                    Pay
                    </button>
                    <button type="button" @click.prevent="editBeneficiary(ben.id)" class="inline-flex items-center  text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                    <?php include('../includes/admin/icons/region-edit.php'); ?>
                    Edit
                    </button>                    
                    <button x-show="!ben.status" @click.prevent="changeUserStatus(ben.id, 1)" type="button" class="inline-flex items-center text-white bg-gradient-to-r from-green-600 via-green-700 to-green-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/active.php'); ?>
                    Enable
                    </button>
                    <button x-show="ben.status" @click.prevent="changeUserStatus(ben.id, 0)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/inactive.php'); ?>
                    Disable
                    </button>
                    <button type="button" @click.prevent="showForm(ben.id)" class="inline-flex items-center  text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/download.php'); ?>
                    Form
                    </button>                    
                    <button type="button" @click.prevent="showTable(ben.id)" class="inline-flex items-center  text-white bg-gradient-to-r from-gray-500 via-gray-600 to-gray-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 cursor-pointer">
                    <?php include('../includes/admin/icons/table.php'); ?>  
                    Payments                  
                    </button>
                </td>
            </tr>
        </template>                                        
    </tbody>
</table>