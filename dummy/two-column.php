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
  		 
  		 <div class="p-4 bg-white shadow-2xl w-lg">

	  		<form @submit.prevent="submit" class="max-w-4xl mx-auto">
				  <div class="grid grid-cols-2 gap-6 mb-6">
				    <!-- First Column: First Name Input -->
				    <div>
				      <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
				      <input type="text" x-model="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
				      <span x-show="errors.firstname" class="text-red-500" x-text="errors.firstname"></span>
				    </div>
				    <!-- Second Column: Last Name Input -->
				    <div>
				      <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
				      <input type="text" x-model="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe" required />
				      <span x-show="errors.lastname" class="text-red-500" x-text="errors.lastname"></span>
				    </div>
				    <!-- Add more field pairs here within the grid container -->
				    <div>
				        <label for="middlename" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
				        <input type="text" x-model="middlename" id="middlename" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Flowbite" required />
				    </div>
				    <div>
				        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
				    		<input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
				    </div>
				  </div>

				  <!-- Single column full-width field (e.g., email or address) -->
				  <div class="mb-6">
				    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
				    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
				  </div>

				  <!-- Submit Button -->
				  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
			</form>

			</div>
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