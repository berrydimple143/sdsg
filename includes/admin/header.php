<div x-data="home()" class="flex items-center justify-between text-white bg-gradient-to-t from-green-500 to-green-400 border-b border-green-700 py-1">
    <div>&nbsp;</div>
    <!-- <div class="flex items-center px-4">
        <label for="menu-toggle"
            class="md:hidden mr-4 bg-gray-800 text-white p-2 rounded focus:outline-none cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none"
                viewBox="0 0 24 24" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>					  
        <input class="text-gray-700 mx-4 w-full bg-white border border-green-800 rounded-md px-4 py-2" type="text" placeholder="Search">
    </div> -->

    <div class="pr-1">
                <div title="Logout" @click.prevent="logout" class="flex items-center justify-center text-white text-shadow-black px-3 py-1 bg-gradient-to-t from-green-600 to-green-500 border border-green-600 cursor-pointer hover:bg-green-800 rounded-full">
                    <button class="flex items-center justify-center text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 cursor-pointer">									
                        <svg class="h-6 w-6" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.75 9.874C11.75 10.2882 12.0858 10.624 12.5 10.624C12.9142 10.624 13.25 10.2882 13.25 9.874H11.75ZM13.25 4C13.25 3.58579 12.9142 3.25 12.5 3.25C12.0858 3.25 11.75 3.58579 11.75 4H13.25ZM9.81082 6.66156C10.1878 6.48991 10.3542 6.04515 10.1826 5.66818C10.0109 5.29121 9.56615 5.12478 9.18918 5.29644L9.81082 6.66156ZM5.5 12.16L4.7499 12.1561L4.75005 12.1687L5.5 12.16ZM12.5 19L12.5086 18.25C12.5029 18.25 12.4971 18.25 12.4914 18.25L12.5 19ZM19.5 12.16L20.2501 12.1687L20.25 12.1561L19.5 12.16ZM15.8108 5.29644C15.4338 5.12478 14.9891 5.29121 14.8174 5.66818C14.6458 6.04515 14.8122 6.48991 15.1892 6.66156L15.8108 5.29644ZM13.25 9.874V4H11.75V9.874H13.25ZM9.18918 5.29644C6.49843 6.52171 4.7655 9.19951 4.75001 12.1561L6.24999 12.1639C6.26242 9.79237 7.65246 7.6444 9.81082 6.66156L9.18918 5.29644ZM4.75005 12.1687C4.79935 16.4046 8.27278 19.7986 12.5086 19.75L12.4914 18.25C9.08384 18.2892 6.28961 15.5588 6.24995 12.1513L4.75005 12.1687ZM12.4914 19.75C16.7272 19.7986 20.2007 16.4046 20.2499 12.1687L18.7501 12.1513C18.7104 15.5588 15.9162 18.2892 12.5086 18.25L12.4914 19.75ZM20.25 12.1561C20.2345 9.19951 18.5016 6.52171 15.8108 5.29644L15.1892 6.66156C17.3475 7.6444 18.7376 9.79237 18.75 12.1639L20.25 12.1561Z" fill="#fff"/>
                        </svg>
                    </button> <span>Logout</span>
            </div>
    </div>
</div>
<script>		
    function home() {
        return {
            loggedin: sessionStorage.getItem("logged"),
            logout() {
                sessionStorage.clear();
                window.location = "../login.php";
            }
        }
    }
</script>