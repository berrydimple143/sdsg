<div id="selectImageModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center overflow-y-hidden">
  <div class="flex flex-col space-y-3 bg-white rounded-lg shadow-xl p-2 max-w-md w-full h-32 text-center">   
    <div class="w-full p-2 bg-green-500 rounded-lg text-shadow-lg text-gray-200 text-lg text-center">
        * * Please select from the options below * *
    </div>
    <div class="flex space-x-2 items-center justify-between">
        <button @click.prevent="gotoCapture" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-800 cursor-pointer">
            Take a photo
        </button>
        <button @click.prevent="showUploadImageModal" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-800 cursor-pointer">
            Upload a photo
        </button>
        <button @click.prevent="hideImageSelectModal" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-800 cursor-pointer">
            Cancel
        </button>
    </div>        
  </div>
</div>