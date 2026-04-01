<table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
    <thead class="text-sm text-white bg-brand border-b border-brand-light">
        <tr>
            <th scope="col" class="px-6 py-3 font-medium">
                City/Municipality
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Province
            </th>
            <th scope="col" class="px-6 py-3 font-medium">
                Region
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

        <tr x-show="cities.length === 0" class="bg-brand border-b border-brand-light hover:bg-green-500">
            <td colspan="3" class="px-3 py-2 text-center text-md font-bold">No cities yet ...</td>
        </tr>
        
        <template x-for="ben in cities" :key="ben.id">

            <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                <th scope="row" x-text="ben.cname" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                </th>
                <th scope="row" x-text="ben.pname" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                </th>
                <th scope="row" x-text="ben.rname" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">                                
                </th>
                <td class="px-6 py-4 text-center flex justify-center items-center">
                    <span title="Active" x-show="ben.status"><?php include('../includes/admin/icons/location.php'); ?></span>
                    <span title="Inactive" x-show="!ben.status"><?php include('../includes/admin/icons/unavailable.php'); ?></span> 
                </td>  
                <td class="px-6 py-4" x-text="formatDate(ben.created_at)"></td>                                                
                <td class="px-3 py-1 text-center" x-show="showRow">                                                    
                    <button @click.prevent="editCity(ben.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                    <?php include('../includes/admin/icons/region-edit.php'); ?>
                    Edit
                    </button>
                    <button @click.prevent="deleteConfirm(ben.id)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/trash.php'); ?>
                    Delete
                    </button>

                    <button x-show="!ben.status" @click.prevent="changeStatus(ben.id, 1)" type="button" class="inline-flex items-center text-white bg-gradient-to-r from-green-600 via-green-700 to-green-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/active.php'); ?>
                    Activate
                    </button>

                    <button x-show="ben.status" @click.prevent="changeStatus(ben.id, 0)" type="button" class="inline-flex items-center  text-white bg-gradient-to-r from-purple-400 via-purple-500 to-purple-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1  cursor-pointer">
                    <?php include('../includes/admin/icons/inactive.php'); ?>
                    De-Activate
                    </button>
                    
                </td>
            </tr>
        </template>                                        
    </tbody>
</table>