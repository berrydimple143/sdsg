<div id="photoModal" class="hidden fixed inset-0 bg-black bg-opacity-20 flex items-center justify-center p-4 z-50">
    <div class="w-full rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-5 py-3 bg-white shadow-2xl w-lg">  		 		
            <div class="max-w-4xl mx-auto flex-col">
                <div		
                    id="photoHolder" 			    
                    class="flex space-x-1 p-1">
                    <video class="" id="preview" autoplay playsinline width="400" height="340"></video>
                    <!-- <img x-ref="uploadedImage" id="uploadedImage" class="bg-blue-700 border-1 border-blue-200 p-2 hidden"> -->
                </div>
                <div class="flex items-center space-x-2">
                <button type="button" class="inline-flex items-center text-white bg-gradient-to-r from-green-600 via-green-700 to-green-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-400 dark:focus:ring-green-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-md px-4 py-3 mt-2 cursor-pointer" @click.prevent="captureNow">
                <?php include('./includes/admin/icons/camera.php'); ?>
                Capture Now
                </button>
                <button 
                class="inline-flex items-center text-white bg-gradient-to-r from-orange-600 via-orange-700 to-orange-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-orange-400 dark:focus:ring-orange-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-3 cursor-pointer mt-2"
                @click.prevent="closeWindow">
                <?php include('./includes/admin/icons/close.php'); ?>
                Close</button>
                </div>
                <button 
                x-show="isSupported" 
                @click.prevent="zoomNow" 
                class="items-center text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-400 dark:focus:ring-blue-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-3 cursor-pointer mt-2">+</button>
                <button 
                x-show="isSupported" 
                @click.prevent="zoomOut"
                class="items-center text-white bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-400 dark:focus:ring-blue-900 box-border border border-transparent shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-3 cursor-pointer mt-2">-</button>
            </div>
        </div>
    </div>
</div>