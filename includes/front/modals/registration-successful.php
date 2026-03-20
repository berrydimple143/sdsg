<!-- Backdrop -->
<div id="successModal" x-data="initModal()" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
  <!-- Modal Card -->
  <div class="bg-[radial-gradient(circle_at_center,var(--tw-gradient-stops))] from-green-400 to-green-600 rounded-lg shadow-xl p-6 m-4 max-w-sm w-full text-center">
    <div class="text-green-500 mb-4">
      <!-- Success Icon -->
      <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
    </div>
    <h2 class="text-2xl text-green-500 font-bold mb-2">Initial Registration Successful!</h2>
    <h2 class="text-lg text-yellow-500 font-bold mb-2">Thank you so much!</h2>
    <p class="text-gray-200 mb-6">Please look for Ms. Lotsie Capuyan at Purok 1-A Brgy. Lubogan, Toril, Davao City for your payment amounting P 100.00 in order to complete your registration for SDSG membership. Or you may contact her at facebook or call 09096400461.</p>
    <button @click="redirectToHome" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-800 cursor-pointer">
        Close
    </button>    
  </div>
</div>
<script>
    function initModal() {
        return {
            loading: false,
            redirectToHome() {
                window.location = "index.php";
            }
        }
    }
</script>