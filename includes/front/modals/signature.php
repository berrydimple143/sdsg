<div id="signatureModal" x-data="initModal()" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center overflow-y-hidden">
  <div class="flex flex-col bg-white rounded-lg shadow-xl p-2 max-w-lg w-full h-80 text-center">   
    <div class="w-full p-2 bg-green-500 rounded-lg text-shadow-lg text-gray-200 text-2xl text-center">* * Please write your signature below * *</div>
    <canvas
     @mousemove="moveSignature($event)" 
     @mousedown="downSignature($event)" 
     @mouseup="upSignature($event)" 
     @mouseout="outSignature($event)" 
     id="signatureCanvas" 
     width="370" 
     height="150" 
     class="border-2 border-dashed border-gray-400 my-2"></canvas>
    <div class="flex space-x-2 items-center">
        <button @click.prevent="saveSignature" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-800 cursor-pointer">
            Save
        </button>
        <button @click.prevent="clearSignatureModal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-800 cursor-pointer">
            Clear
        </button>
        <button @click.prevent="hideSignatureModal" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-800 cursor-pointer">
            Cancel
        </button>
    </div>        
  </div>
</div>
<script>
    function initModal() {
        return {
            loading: false
        }
    }
</script>