<table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
    <thead class="text-sm text-white bg-brand border-b border-brand-light">
        <tr>
            <th scope="col" class="px-6 py-3 font-medium">
                Purok
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Barangay
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                District
            </th>             
            <th scope="col" class="px-6 py-3 font-medium text-center">
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

        <tr x-show="puroks.length === 0" class="bg-brand border-b border-brand-light hover:bg-green-500">
            <td colspan="6" class="px-3 py-2 text-center text-md font-bold">No puroks yet ...</td>
        </tr>
        
        <template x-for="ben in puroks" :key="ben.id">

            <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                <th scope="row" 
                    class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">  
                    <button 
                    @mouseover="showInformation(ben.prkname, ben.bname, ben.dname, ben.cname, ben.pname, ben.rname, true)"
                    @mouseleave="showInformation(ben.prkname, ben.bname, ben.dname, ben.cname, ben.pname, ben.rname, false)" 
                    type="button" 
                    id="infoButton"  
                    x-text="ben.prkname" 
                    :class="{ 'bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 focus:ring-blue-300 dark:focus:ring-blue-800': ben.status, 'bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 focus:ring-gray-300 dark:focus:ring-gray-800': !ben.status }"
                    class="inline-flex items-center rounded-full text-white hover:bg-gradient-to-br focus:ring-4 focus:outline-none box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer"></button>                              
                </th>
                <th scope="row" x-text="ben.bname" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                </th>
                <th scope="row" x-text="ben.dname" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                </th>                
                <td class="px-6 py-4 text-center flex justify-center items-center">
                    <span title="Active" x-show="ben.status"><?php include('../includes/admin/icons/location.php'); ?></span>
                    <span title="Inactive" x-show="!ben.status"><?php include('../includes/admin/icons/unavailable.php'); ?></span> 
                </td>  
                <td class="px-6 py-4" x-text="formatDate(ben.created_at)"></td>                                                
                <td class="px-3 py-1 text-center" x-show="showRow">                                                    
                    <button @click.prevent="editPurok(ben.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                    <?php include('../includes/admin/icons/region-edit.php'); ?>
                    Edit
                    </button>
                    <button @click.prevent="deleteConfirm(ben.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/trash.php'); ?>
                    Delete
                    </button>
                    <button x-show="!ben.status" @click.prevent="changeStatus(ben.id, 1)" type="button" class="inline-flex items-center text-white bg-gradient-to-r from-green-600 via-green-700 to-green-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/active.php'); ?>
                    Enable
                    </button>
                    <button x-show="ben.status" @click.prevent="changeStatus(ben.id, 0)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/inactive.php'); ?>
                    Disable
                    </button>                    
                </td>
            </tr>
        </template>                                        
    </tbody>
</table>