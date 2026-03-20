<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel</title>
  <link href="../src/output.css" rel="stylesheet">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="home()" x-init="checkAuth()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">
  		
  		<div class="flex h-screen bg-transparent">

					<!-- Mobile menu toggle button -->
					<input type="checkbox" id="menu-toggle" class="hidden peer">

					<?php include('../includes/admin/sidebar.php'); ?>

					<!-- Main content -->
					<div class="flex flex-col flex-1 overflow-y-auto">
						<?php include('../includes/admin/header.php'); ?>
						<div class="p-4">
							<h1 class="text-2xl font-bold bg-green-400 p-2">Beneficiaries</h1>
							
                            <div class="relative overflow-x-auto bg-green-400 shadow-xs rounded-base border border-default">
                                <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                                    <thead class="text-sm text-white bg-brand border-b border-brand-light">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Last Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                First Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Middle Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Member Type
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-medium">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                                Apple MacBook Pro 155"
                                            </th>
                                            <td class="px-6 py-4">
                                                Silver
                                            </td>
                                            <td class="px-6 py-4">
                                                Laptop
                                            </td>
                                            <td class="px-6 py-4">
                                                $2999
                                            </td>
                                            <td class="px-3 py-1">
                                                <button type="button" class="inline-flex items-center  text-white bg-yellow-500 hover:bg-yellow-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg fill="#fff" class="w-4 h-4 mr-1" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="24" height="24" viewBox="0 0 494.936 494.936" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157
                                                            c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21
                                                            s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741
                                                            c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"/>
                                                        <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069
                                                            c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963
                                                            c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692
                                                            C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107
                                                            l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005
                                                            c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"/>
                                                    </g>
                                                </g>
                                                </svg>
                                                Edit
                                                </button>
                                                <button type="button" class="inline-flex items-center  text-white bg-red-500 hover:bg-red-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg class="w-4 h-4 mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 11V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14 11V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4 7H20" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Delete
                                                </button>
                                                <button type="button" class="inline-flex items-center  text-white bg-blue-500 hover:bg-blue-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg width="24" height="24" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Show
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                                Microsoft Surface Pro
                                            </th>
                                            <td class="px-6 py-4">
                                                White
                                            </td>
                                            <td class="px-6 py-4">
                                                Laptop PC
                                            </td>
                                            <td class="px-6 py-4">
                                                $1999
                                            </td>
                                            <td class="px-3 py-1">
                                                <button type="button" class="inline-flex items-center  text-white bg-yellow-500 hover:bg-yellow-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg fill="#fff" class="w-4 h-4 mr-1" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="24" height="24" viewBox="0 0 494.936 494.936" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157
                                                            c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21
                                                            s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741
                                                            c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"/>
                                                        <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069
                                                            c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963
                                                            c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692
                                                            C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107
                                                            l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005
                                                            c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"/>
                                                    </g>
                                                </g>
                                                </svg>
                                                Edit
                                                </button>
                                                <button type="button" class="inline-flex items-center  text-white bg-red-500 hover:bg-red-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg class="w-4 h-4 mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 11V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14 11V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4 7H20" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Delete
                                                </button>
                                                <button type="button" class="inline-flex items-center  text-white bg-blue-500 hover:bg-blue-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg width="24" height="24" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Show
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                                Magic Mouse 2
                                            </th>
                                            <td class="px-6 py-4">
                                                Black
                                            </td>
                                            <td class="px-6 py-4">
                                                Accessories
                                            </td>
                                            <td class="px-6 py-4">
                                                $99
                                            </td>
                                            <td class="px-3 py-1">
                                                <button type="button" class="inline-flex items-center  text-white bg-yellow-500 hover:bg-yellow-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg fill="#fff" class="w-4 h-4 mr-1" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                                    width="24" height="24" viewBox="0 0 494.936 494.936" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157
                                                            c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21
                                                            s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741
                                                            c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"/>
                                                        <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069
                                                            c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963
                                                            c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692
                                                            C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107
                                                            l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005
                                                            c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"/>
                                                    </g>
                                                </g>
                                                </svg>
                                                Edit
                                                </button>
                                                <button type="button" class="inline-flex items-center  text-white bg-red-500 hover:bg-red-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg class="w-4 h-4 mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 11V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14 11V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4 7H20" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Delete
                                                </button>
                                                <button type="button" class="inline-flex items-center  text-white bg-blue-500 hover:bg-blue-600 box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-2 py-1 focus:outline-none cursor-pointer">
                                                <svg width="24" height="24" class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                Show
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="bg-brand border-b border-brand-light hover:bg-green-500">
                                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                                Google Pixel Phone
                                            </th>
                                            <td class="px-6 py-4">
                                                Gray
                                            </td>
                                            <td class="px-6 py-4">
                                                Phone
                                            </td>
                                            <td class="px-6 py-4">
                                                $799
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#" class="font-medium text-white hover:underline">Edit</a>
                                            </td>
                                        </tr>
                                        <tr class="bg-brand hover:bg-green-500">
                                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                                Apple Watch 5
                                            </th>
                                            <td class="px-6 py-4">
                                                Red
                                            </td>
                                            <td class="px-6 py-4">
                                                Wearables
                                            </td>
                                            <td class="px-6 py-4">
                                                $999
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#" class="font-medium text-white hover:underline">Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


						</div>
					</div>
				</div>

	<script>

		function checkAuth() {
			let logged = sessionStorage.getItem("logged");
			setTimeout(() => {
			if(!logged) {
					window.location = "../login.php";
			}
			}, 50);
		}		
		
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

</body>
</html>