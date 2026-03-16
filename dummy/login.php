 <!-- Grid container for two columns -->
  		 <form @submit.prevent="submitAuth" class="space-y-6">
  <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2 bg-white p-6 shadow-2xl">
    <!-- Full width row -->
    <div class="sm:col-span-2">
      <label class="block text-sm font-medium text-gray-700">
      	Email Address
      	<span x-show="errors.email" class="text-red-500" x-text="errors.email"></span>
    </label>
      <input type="email" x-model="email" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">      
    </div>

    <div class="sm:col-span-2">
      <label class="block text-sm font-medium text-gray-700">
      	Password
      	<span x-show="errors.password" class="text-red-500" x-text="errors.password"></span>
    </label>
      <input type="password" x-model="password" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">      
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md cursor-pointer">
    		<span x-show="!loading">Sign In</span>
      <span x-show="loading">Loading, please wait ...</span>
    </button>
  </div>

  
</form>