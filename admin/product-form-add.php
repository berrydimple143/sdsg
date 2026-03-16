<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../src/output.css" rel="stylesheet">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">

  <div x-data="formApp()" class="flex items-center justify-center min-h-screen">
  		 <!-- Grid container for two columns -->
  		 <form @submit.prevent="submit" class="space-y-6">
  <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2 bg-white p-6 shadow-2xl">
    <!-- Full width row -->
    <div class="sm:col-span-2">
      <label class="block text-sm font-medium text-gray-700">
      	Product Name
      	<span x-show="errors.name" class="text-red-500" x-text="errors.name"></span>
    </label>
      <input type="text" x-model="name" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">      
    </div>

    <!-- Column 1 -->
    <div>
      <label class="block text-sm font-medium text-gray-700">
      	Product Price
      	<span x-show="errors.price" class="text-red-500" x-text="errors.price"></span>
      </label>
      <input type="text" x-model="price" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">      
    </div>

    <!-- Column 2 -->
    <div>
      <label class="block text-sm font-medium text-gray-700">
      	Product Quantity
      	<span x-show="errors.quantity" class="text-red-500" x-text="errors.quantity"></span>
      </label>
      <input type="text" x-model="quantity" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">      
    </div>

    <div class="sm:col-span-2">
      <label class="block text-sm font-medium text-gray-700">Product Description</label>      
      <textarea x-model="description" rows="5" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
      <span x-show="errors.description" x-text="errors.description"></span>
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md cursor-pointer">
    		<span x-show="!loading">Create</span>
      <span x-show="loading">Creating ...</span>
    </button>
  </div>

  
</form>
	</div>

	<script>
		function formApp() {
		  return {
		    name: '',
		    price: '',
		    quantity: '',
		    description: '',
		    loading: false,
		    errors: {},

		    validate() {
		      this.errors = {}
		      if (!this.name) this.errors.name = "(Required)"
		      if (!this.price) this.errors.price = "(Required)"
		      if (!this.quantity) this.errors.quantity = "(Required)"
		      return Object.keys(this.errors).length === 0
		    },

		    async submit() {
		      if (!this.validate()) return

		      this.loading = true

		      await fetch("http://localhost/vjstore/api/product/create.php", {
		        method: "POST",
		        headers: {"Content-Type": "application/json"},
		        body: JSON.stringify({ 
		        	name: this.name,
		        	price: this.price,
		        	quantity: this.quantity,
		        	description: this.description
		        })
		      })

		      this.loading = false
		    }
		  }
		}
	</script>

</body>
</html>