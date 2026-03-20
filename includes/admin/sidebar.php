<!-- Sidebar -->
<div x-data="initPage()" class="hidden peer-checked:flex md:flex flex-col w-56 bg-transparent transition-all duration-300 ease-in-out">
    <div class="flex items-center justify-between h-16 bg-green-900 opacity-90 px-4 border-b border-green-700">
        <span class="text-white font-bold uppercase">SDSG Control Panel</span>
        <label for="menu-toggle" class="text-white cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 lg:hidden" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </label>
        <!-- <span class="text-white font-bold uppercase">Sidebar</span> -->
    </div>
    <div class="flex flex-col flex-1 overflow-y-auto">
        
        <nav class="flex-1 px-2 py-4 bg-green-800 opacity-80">
            <a href="#" @click.prevent="dashboard" class="flex items-center px-4 py-2 text-gray-100 hover:bg-green-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 group-hover:transform group-hover:rotate-90" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                Dashboard
            </a>

            <!-- Users -->
            <a href="#" @click.prevent="beneficiary" class="flex items-center px-4 py-2 text-gray-100 hover:bg-green-700 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="group-hover:hidden h-6 w-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden group-hover:block h-6 w-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>						  
                Beneficiaries
            </a>
        </nav>

    </div>
</div>
<script>		
    function initPage() {
        return {
            loggedin: sessionStorage.getItem("logged"),
            dashboard() {
                window.location = "./index.php";
            },
            beneficiary() {
                window.location = "./beneficiary.php";
            },
        }
    }
</script>