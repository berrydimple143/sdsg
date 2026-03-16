<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
  <script defer src="./js/alpinejs.cdn.min.js"></script>
</head>
<body class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">

  <div x-data="formApp()" class="flex items-center justify-center min-h-screen">
  		 <!-- Grid container for two columns -->
  		 <form @submit.prevent="submit" class="space-y-6">
  <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2 bg-white p-4 shadow-2xl">
  	<div class="sm:col-span-6 border-b-2 pb-1 border-gray-500 border-dotted"><p class="text-green-700 font-bold">Please register here..</p></div>

    <!-- Full width row -->
    <div class="sm:col-span-3">
      <label class="block text-sm font-medium text-gray-700">
      	First Name <span class="text-red-500 font-bold">*</span>
      	<span x-show="errors.firstname" class="text-red-500" x-text="errors.firstname"></span>
    </label>
      <input type="text" x-model="firstname" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">      
    </div>

    <!-- Full width row -->
    <div class="sm:col-span-3">
      <label class="block text-sm font-medium text-gray-700">
      	Middle Name (Optional)
      	<span x-show="errors.middlename" class="text-red-500" x-text="errors.middlename"></span>
    </label>
      <input type="text" x-model="middlename" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">      
    </div>

    <div class="sm:col-span-3">
      <label class="block text-sm font-medium text-gray-700">
      	Last Name <span class="text-red-500 font-bold">*</span>
      	<span x-show="errors.lastname" class="text-red-500" x-text="errors.lastname"></span>
    </label>
      <input type="text" x-model="lastname" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">      
    </div>

    <div class="sm:col-span-3">
      <label class="block text-sm font-medium text-gray-700">
      	Email <span class="text-red-500 font-bold">*</span>
      	<span x-show="errors.email" class="text-red-500" x-text="errors.email"></span>
    </label>
      <input type="email" x-model="email" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">      
    </div>

    <!-- Full width row -->
    <div class="sm:col-span-3">
      <label class="block text-sm font-medium text-gray-700">
      	Username <span class="text-red-500 font-bold">*</span>
      	<span x-show="errors.username" class="text-red-500" x-text="errors.username"></span>
    </label>
      <input type="text" x-model="username" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">      
    </div>

    <div class="sm:col-span-3">
      <label class="block text-sm font-medium text-gray-700">
      	Password <span class="text-red-500 font-bold">*</span>
      	<span x-show="errors.password" class="text-red-500" x-text="errors.password"></span>
    </label>
      <input type="password" x-model="password" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required="">      
    </div>

    <div class="sm:col-span-3">
      <label class="block text-sm font-medium text-gray-700">
      	Landline Number (Optional)
      	<span x-show="errors.phone" class="text-red-500" x-text="errors.phone"></span>
    </label>
      <input type="text" x-model="phone" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">      
    </div>

    <div class="sm:col-span-3">
      <label class="block text-sm font-medium text-gray-700">
      	Mobile Number (Optional)
      	<span x-show="errors.mobile" class="text-red-500" x-text="errors.mobile"></span>
    </label>
      <input type="text" x-model="mobile" class="mt-1 block w-full h-2/3 outline-1 outline-gray-700 p-2 rounded-none border-gray-300 shadow-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">      
    </div>
    
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md cursor-pointer">
    		<span x-show="!loading">Register</span>
      <span x-show="loading">Registering, please wait ...</span>
    </button>
  </div>

  
</form>
	</div>

	<script>
		function formApp() {
		  return {
		    firstname: '',
		    lastname: '',
		    middlename: '',
		    username: '',
		    email: '',
		    password: '',
		    phone: '',
		    mobile: '',
		    loading: false,
		    errors: {},

		    validate() {
		      this.errors = {}
		      if (!this.firstname) this.errors.firstname = "(Required)"
		      if (!this.lastname) this.errors.lastname = "(Required)"
		      if (!this.email) this.errors.email = "(Required)"
		      if (!this.username) this.errors.username = "(Required)"
		      if (!this.password) this.errors.password = "(Required)"
		      return Object.keys(this.errors).length === 0
		    },

		    async submit() {
		      if (!this.validate()) return

		      this.loading = true

		      await fetch("http://localhost/vjstore/api/register.php", {
		        method: "POST",
		        headers: {"Content-Type": "application/json"},
		        body: JSON.stringify({ 
		        	firstname: this.firstname,
		        	lastname: this.lastname,
		        	middlename: this.middlename,
		        	username: this.username,
		        	email: this.email,
		        	password: this.password,
		        	phone: this.phone,
		        	mobile: this.mobile
		        })
		      })

		      this.loading = false
		    }
		  }
		}
	</script>

</body>
</html>