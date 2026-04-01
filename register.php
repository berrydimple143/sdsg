<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc.</title>
  <link href="./src/output.css" rel="stylesheet">
  <script defer src="./js/alpinejs.cdn.min.js"></script>
</head>
<body class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover">
	<?php include('./includes/front/modals/registration-successful.php'); ?>
  <div x-data="formApp()" class="flex items-center justify-center min-h-screen">  		 
  		 <div class="px-3 py-3 w-full">  		 		
	  		<?php include('./includes/front/registration-form.php'); ?>
		</div>
	</div>
	<script>				
		function formApp() {
		  return {			
		  	regions: [],
		    provinces: [],
		    cities: [],
			districts: [],
			barangays: [],
			puroks: [],
			cstatuses: [
				{ id: 1, value: 'Single' },
				{ id: 2, value: "Married" },
				{ id: 3, value: 'Separated' },
				{ id: 4, value: "Widowed" }
			],
			genders: [
				{ id: 1, value: 'Male' },
				{ id: 2, value: "Female" }
			],
			bloodtypes: [
				{ id: 1, value: 'A+' },
				{ id: 2, value: "A-" },
				{ id: 3, value: 'B+' },
				{ id: 4, value: "B-" },
				{ id: 5, value: 'O+' },
				{ id: 6, value: "O-" },
				{ id: 7, value: 'AB+' },
				{ id: 8, value: "AB-" }
			],
			attainments: [
				{ id: 1, value: 'Elementary Level' },
				{ id: 2, value: 'Elementary Graduate' },
				{ id: 3, value: 'High School Level' },
				{ id: 4, value: 'High School Graduate' },
				{ id: 5, value: 'College Undergraduate' },
				{ id: 6, value: "College Graduate" },
				{ id: 7, value: 'Vocational' },
				{ id: 8, value: "Graduate Studies" }
			],
			insurances: [
				{ id: 1, value: 50 },
				{ id: 2, value: 100 },
				{ id: 3, value: 150 },
				{ id: 4, value: 200 },
				{ id: 5, value: 250 },
				{ id: 6, value: 300 }
			],
			burials: [
				{ id: 1, value: 50 },
				{ id: 2, value: 100 },
				{ id: 3, value: 150 },
				{ id: 4, value: 200 },
				{ id: 5, value: 250 },
				{ id: 6, value: 300 }
			],			
		    firstname: '',
		    lastname: '',
		    middlename: '',
		    nickname: '',
		    suffix: '',
		    region: '',
		    province: '',
		    city: '',		 
		    district: '',
		    barangay: '',
		    purok: '',
		    zipcode: '',
			birthdate: '1982-02-21',
			benbirthdate1: '2010-02-21',
			benbirthdate2: '2010-02-21',
			benbirthdate3: '2010-02-21',
			benbirthdate4: '2010-02-21',
			birthplace: '',
			age: '',
			civilstatus: '',	
			gender: '',		
			nationality: 'Filipino',
			country: 'Philippines',
			religion: '',
			bloodtype: '',
			height: '',
			weight: '',
			father: '',
			mother: '',
			spouse: '',
			position: '',
			education: '',
			skill: '',
			organization: '',
			contact: '',
			fb: '',
			email: '',
			sss: '',
			philhealth: '',
			voter: '',
			passport: '',
			profid: '',
			pagibig: '',
			license: '',
			senior: '',
			chairman: '',
			area: '',
			mcnumber: '',
			classification: '',
			tribe: '',
			tribe1: '',
			contactname: '',
			contactnumber: '',
			contactaddress: '',
			benname1: '',
			benage1: '',
			benrelationship1: '',
			benname2: '',
			benage2: '',
			benrelationship2: '',
			benname3: '',
			benname4: '',
			benage3: '',
			benage4: '',
			benrelationship3: '',
			benrelationship4: '',
			insurance: '',
			burial: '',
			courseToAvail: '',
		    loading: false,
		    errors: {},
			async getAllData(page) {
                let response = await fetch('http://localhost/sdsg/api/admin/getAllData.php', {
					method: 'POST',
					headers: {'Content-Type': 'application/json'},
					body: JSON.stringify({                                     
						page: page
					})
				});
                let res = await response.json();
                if(page == 'region') {
                    this.regions = res.data;                    
                } else if(page == 'province') {
                    this.provinces = res.data;   
				} else if(page == 'city') {
                    this.cities = res.data; 
				} else if(page == 'district') {
                    this.districts = res.data; 
				} else if(page == 'barangay') {
                    this.barangays = res.data; 
				} else if(page == 'purok') {
                    this.puroks = res.data; 
                }               
            },
			init() {
				this.getAllData('region');
			},

			getTribe(trb) {
				const tribeContainer = document.getElementById('tribe-container');	
				if(trb == "Others") {
					tribeContainer.classList.remove('hidden');
					this.tribe = this.tribe1;
				} else {
					tribeContainer.classList.add('hidden');
					this.tribe = trb;
				}
			},

			setTribe() {
				this.tribe = this.tribe1;
			},

			addBeneficiary() {
				const fourthBeneficiaryName = document.getElementById('benname4');
				const fourthBeneficiaryBday = document.getElementById('benbirthdate4');
				const fourthBeneficiaryAge = document.getElementById('benage4');
				const fourthBeneficiaryRelation = document.getElementById('benrelationship4');
				fourthBeneficiaryName.classList.remove('hidden');
				fourthBeneficiaryBday.classList.remove('hidden');
				fourthBeneficiaryAge.classList.remove('hidden');
				fourthBeneficiaryRelation.classList.remove('hidden');
			},

			async getZipcode() {
				return await fetch('./data/zipcodes.json')
				.then(response => response.json())
				.then(json => {
					console.log(json); 
				}).catch(error => console.error('Error fetching JSON:', error));
			},

			async getAllDataWithId(page, id) {
                let response = await fetch('http://localhost/sdsg/api/admin/getAllDataWithId.php', {
					method: 'POST',
					headers: {'Content-Type': 'application/json'},
					body: JSON.stringify({                                     
						page: page,
						id: id
					})
				});
                let res = await response.json();
                if(page == 'region') {
                    this.regions = res.data;                    
                } else if(page == 'province') {
                    this.provinces = res.data;   
				} else if(page == 'city') {
                    this.cities = res.data; 
				} else if(page == 'district') {
                    this.districts = res.data; 
				} else if(page == 'barangay') {
                    this.barangays = res.data; 
				} else if(page == 'purok') {
                    this.puroks = res.data; 
                }               
            },

		    selectRegion(id) {
		    	this.region = id;
		    	this.getAllDataWithId('province', id);
		    },

		    selectProvince(id) {
		    		this.province = id;
		    		this.getAllDataWithId('city', id);
		    },	

		    selectCity(id) {
					//const zipcodes = this.getZipcode();			
					//console.log(zipcodes);
					//alert(zc.reverse(ct + ' City'));
		    		this.city = id;
		    		this.getAllDataWithId('district', id);
		    },

			selectDistrict(ds) {
		    		this.district = ds;
		    		if(ds == "Third") {
			    		this.barangays = thirdDistrictBarangays;
			    	}
			    	if(ds == "First") {
			    		this.barangays = firstDistrictBarangays;
			    	}
		    },

			selectBarangay(bar) {
		    		this.barangay = bar;
		    		if(bar == "Lubogan") {
			    		this.puroks = barangayLubogan;
			    	}
			    	if(bar == "Baliok") {
			    		this.puroks = barangayBaliok;
			    	}
		    },

		    validate() {
		      this.errors = {}
		      if (!this.firstname) this.errors.firstname = "(Required)"
		      if (!this.lastname) this.errors.lastname = "(Required)"
		      if (!this.email) this.errors.email = "(Required)"		      
		      return Object.keys(this.errors).length === 0
		    },

		    clearInputs() {
		    		this.firstname = '';
		    		this.lastname = '';
		    		this.middlename = '';		    		
		    		this.email = '';
					this.region = '';
		    		this.province = '';
		    		this.city = '';		    		
		    		this.district = '';
					this.barangay = '';
		    		this.purok = '';
		    		this.civilstatus = '';		    		
		    		this.gender = '';
					this.religion = '';
		    		this.bloodtype = '';
		    		this.nickname = '';		    		
		    		this.suffix = '';
					this.zipcode = '';
		    		this.birthdate = '1982-02-21';
		    		this.birthplace = '';		    		
		    		this.age = '';
					this.nationality = '';
		    		this.country = '';
		    		this.height = '';		    		
		    		this.weight = '';
					this.father = '';
		    		this.mother = '';
		    		this.spouse = '';		    		
		    		this.education = '';
					this.position = '';
		    		this.skill = '';
		    		this.organization = '';		    		
		    		this.contact = '';
					this.fb = '';
		    		this.sss = '';
		    		this.philhealth = '';		    		
		    		this.voter = '';
					this.passport = '';
		    		this.profid = '';
		    		this.pagibig = '';		    		
		    		this.license = '';
					this.senior = '';
		    		this.chairman = '';
		    		this.area = '';		    		
		    		this.mcnumber = '';
					this.classification = '';
		    		this.tribe = '';
		    		this.contactname = '';		    		
		    		this.contactnumber = '';
					this.contactaddress = '';
		    		this.benname1 = '';
		    		this.benage1 = '';
		    		this.benrelationship1 = '';
					this.benbirthdate1 = '2010-02-21';
					this.benname2 = '';
		    		this.benage2 = '';
		    		this.benrelationship2 = '';
					this.benbirthdate2 = '2010-02-21';
					this.benname3 = '';
		    		this.benage3 = '';
		    		this.benrelationship3 = '';
					this.benbirthdate3 = '2010-02-21';
					this.benname4 = '';
		    		this.benage4 = '';
		    		this.benrelationship4 = '';
					this.benbirthdate4 = '2010-02-21';
					this.insurance = '';
					this.burial = '';
					this.courseToAvail = '';
		    },

		    async submit() {
		      if (!this.validate()) return;

		      this.loading = true;

		    	try {

			       const response = await fetch("http://localhost/sdsg/api/member.php", {
			        method: "POST",
			        headers: {"Content-Type": "application/json"},
			        body: JSON.stringify({ 
			        	firstname: this.firstname,
			        	lastname: this.lastname,
			        	middlename: this.middlename,
			        	email: this.email,
						nickname: this.nickname,
						suffix: this.suffix,
						region: this.region,
						province: this.province,
						city: this.city,
						district: this.district,
						barangay: this.barangay,
						purok: this.purok,
						zipcode: this.zipcode,
						birthdate: this.birthdate,
						birthplace: this.birthplace,
						age: this.age,
						civilstatus: this.civilstatus,
						gender: this.gender,
						nationality: this.nationality,
						country: this.country,
						religion: this.religion,
						bloodtype: this.bloodtype,
						height: this.height,
						weight: this.weight,
						father: this.father,
						mother: this.mother,
						spouse: this.spouse,
						education: this.education,
						position: this.position,
						skill: this.skill,
						organization: this.organization,
						contact: this.contact,
						fb: this.fb,
						sss: this.sss,
						philhealth: this.philhealth,
						voter: this.voter,
						passport: this.passport,
						profid: this.profid,
						pagibig: this.pagibig,
						license: this.license,
						senior: this.senior,
						chairman: this.chairman,
						area: this.area,
						mcnumber: this.mcnumber,
						classification: this.classification,
						tribe: this.tribe,
						contactname: this.contactname,
						contactnumber: this.contactnumber,
						contactaddress: this.contactaddress,
						benname1: this.benname1,
						benage1: this.benage1,
						benrelationship1: this.benrelationship1,
						benbirthdate1: this.benbirthdate1,
						benname2: this.benname2,
						benage2: this.benage2,
						benrelationship2: this.benrelationship2,
						benbirthdate2: this.benbirthdate2,
						benname3: this.benname3,
						benage3: this.benage3,
						benrelationship3: this.benrelationship3,
						benbirthdate3: this.benbirthdate3,
						benname4: this.benname4,
						benage4: this.benage4,
						benrelationship4: this.benrelationship4,
						benbirthdate4: this.benbirthdate4,
						insurance: this.insurance,
						burial: this.burial,
						courseToAvail: this.courseToAvail
			        })
			      });

		      	const res = await response.json();
		      	const modal = document.getElementById('successModal');

			      if(!res.status) {
			      	alert(res.message);
			      } else {
			      	this.clearInputs();
			      	modal.classList.remove('hidden');
			      	// setTimeout(() => {
					// 	modal.classList.add('hidden');
					// 	window.location = "login.php";
					// }, 3000);
			      }
		      } catch (error) {
		      		console.error('Error fetching data:', error);
          } finally {
              this.loading = false;
          }

		    }
		  }
		}
	</script>

</body>
</html>