<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc.</title>
  <link href="./src/output.css" rel="stylesheet">
  <link href="./css/site.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="./images/logo.ico">
  <script defer src="./js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="formApp()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover">
	<?php include('./includes/front/modals/registration-successful.php'); ?>	
	<?php include('./includes/front/modals/signature.php'); ?>	
	<?php include('./includes/front/modals/loadingPicture.php'); ?>			
	<?php //include('./includes/front/modals/imageModal.php'); ?>	
	<canvas id="formCanvas" x-ref="printableForm" width="1699" height="2360" class="top-0 left-0"></canvas>

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

  	<div class="flex items-center justify-center min-h-screen">  		 
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
			region_id: '',			
		    province: '',
			province_id: '',
		    city: '',		
			city_id: '', 
		    district: '',
			district_id: '',
		    barangay: '',
			barangay_id: '',
		    purok: '',
			purok_id: '',
			bday: '',
			benday1: '',
			benday2: '',
			benday3: '',
			benday4: '',
		    zipcode: '',
			birthdate: '',
			benbirthdate1: '',
			benbirthdate2: '',
			benbirthdate3: '',
			benbirthdate4: '',
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
			insurance: '50',
			burial: '50',
			courseToAvail: '',
			video: null,
		    loading: false,
			photoModal: null,
			imageCapture: null,
			imageUrl: null,
			zoomInValue: 2,
			isSupported: false,
			stream: null,
			track: null,
			filename: '',
		    errors: {},
			loadingPictureModal: null,
			signatureModal: null,
			photoButton: null,
			uploadedImage: null,
			signatureCanvas: null,
			ctxCanvas: null,
			signatureURL: '',
			mCanvas: null,			
			printCanvas() {
                // 1. Get data URL
                const dataUrl = this.$refs.printableForm.toDataURL('image/png');

                // 2. Open new window
                const windowContent = '<!DOCTYPE html>' +
                    '<html><head><title>Print Canvas</title></head><body>' +
                    '<img src="' + dataUrl + '" onload="window.print();window.close();">' +
                    '</body></html>';
                
                const printWin = window.open('', '', 'width=600,height=400');
                printWin.document.open();
                printWin.document.write(windowContent);
                printWin.document.close();
            },
			downloadCanvas() {
                const canvas = this.$refs.printableForm;
                const image = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = image;
                link.download = 'sdsgform.png';
                link.click();
            },
			convertDate(dt, frmt) {
				if(dt == '') {
					return dt;
				} else {
					const date = new Date(dt);
					return date.toLocaleDateString('en-US', {
						year: 'numeric',
						month: 'long',
						day: 'numeric',
					});
				}
			},
			getStatus(stat) {
				this.drawText();
			},
			drawText() {
				this.drawForm(this.firstname, this.lastname, this.middlename, this.suffix,
					this.nickname, this.region, this.province, this.city, this.district,
					this.barangay, this.purok, this.zipcode, this.bday, this.birthplace,
					this.age, this.religion, this.nationality, this.country, this.civilstatus, 
					this.gender, this.bloodtype, this.height, this.weight, this.father,
					this.mother, this.spouse, this.education, this.position, this.skill,
					this.organization, this.contact, this.fb, this.email, this.sss,
					this.philhealth, this.voter, this.passport, this.profid, this.pagibig,
					this.license, this.senior, this.classification, this.chairman, this.area,
					this.mcnumber, this.tribe, this.contactname, this.contactnumber,
					this.contactaddress, this.benname1, this.benname2, this.benname3,
					this.benname4, this.convertDate(this.benbirthdate1), this.convertDate(this.benbirthdate2),
					this.convertDate(this.benbirthdate3), this.convertDate(this.benbirthdate4),
					this.benage1, this.benage2, this.benage3, this.benage4, this.benrelationship1,
					this.benrelationship2, this.benrelationship3, this.benrelationship4,
					this.insurance, this.burial, this.courseToAvail, this.filename, this.signatureURL
				);
			},
			drawForm(fname, lname, mname, sfx, nname, reg, pr, ct, ds, br, pk, zp, bdy, bp, ag, 
				rlg, nat, cnty, cstat, gend, bldt, hgt, wgt, fth, mth, sps, edc, pos, skl, org,
				cntc, fcb, eml, ss, phil, vtr, pspt, prof, pag, lic, sen, cls, chr, are, mcn,
				trb, ctcnam, ctcnum, ctcadr, benn1, benn2, benn3, benn4, benb1, benb2, benb3,
				benb4, beng1, beng2, beng3, beng4, benr1, benr2, benr3, benr4, ins, bur, cta, fln, sign
			) {
				const canvas = document.getElementById('formCanvas');
				const ctx = canvas.getContext('2d');
				const img = new Image();
				img.onload = function() {
					ctx.drawImage(img, 0, 0);
					ctx.font = '25px Arial';
					ctx.fillStyle = '#3e3d3d'; 
					if(sign !== '') {
						const img3 = new Image();
						img3.onload = function() {
							ctx.drawImage(img3, 610, 2190);
						}
						img3.src = sign;						
					}
					const fullname = `${fname}  ${mname}  ${lname}  ${sfx}`;
					if(fln !== '') {
						const img2 = new Image();
						img2.onload = function() {
							ctx.drawImage(img2, 1300, 65);
						}
						img2.src = `./images/photos/${fln}`;						
					}
					if(ins == '50') {
						ctx.fillText('/', 220, 2063);
					} else if(ins == '100') {
						ctx.fillText('/', 220, 2095);
					} else if(ins == '150') {
						ctx.fillText('/', 220, 2135);
					} else if(ins == '200') {
						ctx.fillText('/', 390, 2063);
					} else if(ins == '250') {
						ctx.fillText('/', 390, 2095);
					} else if(ins == '300') {
						ctx.fillText('/', 390, 2135);
					}
					if(bur == '50') {
						ctx.fillText('/', 750, 2063);
					} else if(bur == '100') {
						ctx.fillText('/', 750, 2095);
					} else if(bur == '150') {
						ctx.fillText('/', 750, 2135);
					} else if(bur == '200') {
						ctx.fillText('/', 920, 2063);
					} else if(bur == '250') {
						ctx.fillText('/', 920, 2095);
					} else if(bur == '300') {
						ctx.fillText('/', 920, 2135);
					}
					if(cls == "4P's") {
						ctx.fillText('/', 435, 1490);
					} else if(cls == "IP's") {
						ctx.fillText('/', 545, 1490);
					}
					if(trb == "Muslim") {
						ctx.fillText('/', 785, 1490);
					} else {
						ctx.fillText('/', 947, 1490);
						ctx.fillText(trb, 1100, 1490);
					} 								
					if(edc == 'High School Graduate') {
						ctx.fillText("/", 508, 1030);
					} else if(edc == 'College Graduate') {
						ctx.fillText("/", 837, 1030);
					} else if(edc == 'Vocational') {
						ctx.fillText("/", 1117, 1030);
					} else if(edc == 'Graduate Studies') {
						ctx.fillText("/", 1297, 1030);
					}					
					if(cstat == 'Single') {
						ctx.fillText("/", 391, 725);
					} else if(cstat == 'Married') {
						ctx.fillText("/", 545, 725);
					} else if(cstat == 'Separated') {
						ctx.fillText("/", 727, 725);
					} else if(cstat == 'Widowed') {
						ctx.fillText("/", 947, 725);
					}
					if(gend == 'Male') {
						ctx.fillText("/", 1275, 725);
					} else if(gend == 'Female') {
						ctx.fillText("/", 1405, 725);
					}					
					ctx.fillText(fullname, 300, 597);			
					ctx.fillText(nname, 1290, 597);
					ctx.fillText(reg, 320, 635);
					ctx.fillText(pr, 460, 635);
					ctx.fillText(ct, 680, 635);
					ctx.fillText(ds, 940, 635);		
					ctx.fillText(br, 1115, 635);
					ctx.fillText(pk, 1310, 635);
					ctx.fillText(zp, 1500, 635);
					ctx.fillText(bdy, 365, 770);
					ctx.fillText(bp, 880, 770);	
					ctx.fillText(ag, 1490, 770);
					ctx.fillText(rlg, 330, 805);						
					ctx.fillText(nat, 980, 805);
					ctx.fillText(cnty, 1300, 805);		
					ctx.fillText(fth, 430, 915);
					ctx.fillText(mth, 1150, 915);
					ctx.fillText(sps, 410, 950);
					ctx.fillText(bldt, 380, 840);
					ctx.fillText(hgt, 610, 840);
					ctx.fillText(wgt, 880, 840);
					ctx.fillText(pos, 340, 1070);
					ctx.fillText(skl, 1000, 1070);
					ctx.fillText(org, 200, 1140);		
					ctx.fillText(cntc, 395, 1255);
					ctx.fillText(fcb, 860, 1255);
					ctx.fillText(eml, 1312, 1255);	
					ctx.fillText(ss, 330, 1335);
					ctx.fillText(phil, 910, 1335);
					ctx.fillText(vtr, 1380, 1335);	
					ctx.fillText(pspt, 350, 1370);
					ctx.fillText(prof, 850, 1370);	
					ctx.fillText(pag, 1330, 1370);
					ctx.fillText(lic, 510, 1405);
					ctx.fillText(sen, 1230, 1405);	
					ctx.fillText(chr, 455, 1535);	
					ctx.fillText(are, 870, 1535);
					ctx.fillText(mcn, 1270, 1535);			
					ctx.fillText(ctcnam, 305, 1685);	
					ctx.fillText(ctcnum, 1190, 1685);
					ctx.fillText(ctcadr, 340, 1725);
					ctx.fillText(benn1, 195, 1850);	
					ctx.fillText(benn2, 195, 1900);
					ctx.fillText(benn3, 195, 1955);
					//ctx.fillText(benn4, 340, 1725);
					ctx.fillText(benb1, 555, 1850);	
					ctx.fillText(benb2, 555, 1900);
					ctx.fillText(benb3, 555, 1955);
					//ctx.fillText(benb4, 340, 1725);
					ctx.fillText(beng1, 1040, 1850);	
					ctx.fillText(beng2, 1040, 1900);
					ctx.fillText(beng3, 1040, 1955);
					//ctx.fillText(beng4, 340, 1725);
					ctx.fillText(benr1, 1320, 1850);	
					ctx.fillText(benr2, 1320, 1900);
					ctx.fillText(benr3, 1320, 1955);
					//ctx.fillText(benr4, 340, 1725);
					if(cta != '') {
						ctarr = cta.match(/(?:\S+\s*){1,4}/g);						
						ctx.fillText(ctarr[0], 1170, 2095);	
						if(ctarr[1] !== undefined || ctarr[1] !== '') {
							ctx.fillText(ctarr[1], 1170, 2125);	
						}				
					}					
				};
				img.src = './images/form.jpg';				
			},			
			getFilenameWithDate(p) {
				const now = new Date();
				const year = now.getFullYear();
				const month = now.getMonth();
				const day = now.getDate();
				const hours = now.getHours();
				const minutes = now.getMinutes();
				const seconds = now.getSeconds();
				return `${p}-${year}-${month}-${day}-${hours}-${minutes}-${seconds}`;
			},
			// async compressImageBlob(blob, quality = 0.7) {
			// 	const img = new Image();
			// 	img.src = URL.createObjectURL(blob);
			// 	await img.decode(); 
			// 	const canvas = document.createElement('canvas');
			// 	canvas.width = img.naturalWidth;
			// 	canvas.height = img.naturalHeight;
			// 	const ctx = canvas.getContext('2d');
			// 	ctx.drawImage(img, 0, 0);
			// 	return new Promise((resolve) => {
			// 		canvas.toBlob((compressedBlob) => {
			// 			URL.revokeObjectURL(img.src);
			// 			resolve(compressedBlob);
			// 		}, 'image/jpeg', quality);
			// 	});
			// },
			captureNow() {
                this.photoModal = document.getElementById('photoModal');
                this.photoModal.classList.add('hidden');			
				this.track = this.video.srcObject.getVideoTracks()[0];
				this.imageCapture = new ImageCapture(this.track);
				setTimeout(() => {						
					this.takeNow(); 
				}, 3000);
            },
			async takeNow() {
				try {
					const blob = await this.imageCapture.takePhoto({
						fillLightMode: "auto", 
						redEyeReduction: true, 
						imageWidth: 400,
  						imageHeight: 450
					});											
					this.imageUrl = URL.createObjectURL(blob);
					//const myFile = new File([this.imageUrl], "image.png", { type: "image/png" });
					//console.log(myFile);
					//this.downloadSameOrigin(this.imageUrl, 'myPhoto.png');
					this.uploadImage(blob);					
				} catch (error) {
					console.error("Error fetching data:", error);
				}
			},
			async uploadImage(blob) {
				const formData = new FormData();
				this.filename = this.getFilenameWithDate(`${this.firstname}-${this.lastname}`) + '.png';
				formData.append('image', blob, this.filename);
				this.loadingPictureModal = document.getElementById('loadingPictureModal');
				this.loadingPictureModal.classList.remove('hidden');
				const response = await fetch('http://localhost/sdsg/api/upload.php', {
					method: 'POST',
					body: formData
				});
				if (response.ok) {					
					console.log("Picture was uploaded successfully!");
				} else {
					console.log(response);
				}	
				setTimeout(() => {					
					this.loadingPictureModal.classList.add('hidden');
					this.photoButton.classList.add('hidden');	
					this.uploadedImage.classList.remove('hidden');
					this.$refs.uploadedImage.src = `./images/photos/${this.filename}`;
				}, 3000);
			},
			downloadSameOrigin(imgUrl, fileName) {
				const link = document.createElement('a');
				link.href = imgUrl;
				link.download = fileName;
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			},		
			closeWindow() {
				this.photoModal.classList.add('hidden');
			},
			zoomNow() {
				this.zoomInValue += 2;
				this.zoomVideo(this.zoomInValue);
			},			
			zoomOut() {
				this.zoomInValue -= 2;
				this.zoomVideo(this.zoomInValue);
			},
			async zoomVideo(zm) {
				this.track = this.video.srcObject.getVideoTracks()[0];				
				const capabilities = this.track.getCapabilities();
				if (!('zoom' in capabilities)) {
					this.isSupported = false;
					console.log("Zoom not supported by this camera");
				} else {
					this.isSupported = true;
					const min = capabilities.zoom.min;
					const max = capabilities.zoom.max;
					const step = capabilities.zoom.step;
					console.log(min, max, step);
					await this.track.applyConstraints({
						advanced: [{ zoom: zm }]
					});
				}
			}, 				
			async startPreview() {
				try {
					const constraints = {
						video: {
							aspectRatio: { ideal: 1.0 },
							width: { ideal: 150 },
							height: { ideal: 160 }
						}
					};
					this.stream = await navigator.mediaDevices.getUserMedia(constraints);
					// this.stream = await navigator.mediaDevices.getUserMedia({ video: true });
					this.video.srcObject = this.stream;
				} catch (err) {
					console.error("Error accessing camera: ", err);
				}
			},
			captureImage() {
				if(this.firstname == '' && this.lastname == '') {
					alert("You must enter a firstname and lastname first before taking picture!");
				} else {
					this.photoModal = document.getElementById('photoModal');
					this.photoModal.classList.remove('hidden');
					this.video = document.getElementById('preview');
					this.startPreview();
					// this.imageModal = document.getElementById('imageModal');
					// this.imageModal.classList.remove('hidden');
				}				
			},
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
			moveSignature(e) {				
				this.mCanvas.lastX = this.mCanvas.x;
				this.mCanvas.lastY = this.mCanvas.y;
				// this.mCanvas.x = e.x - this.signatureCanvas.offsetLeft;
				// this.mCanvas.y = e.y - this.signatureCanvas.offsetTop;	
				const rect = this.signatureCanvas.getBoundingClientRect();			
				this.mCanvas.x = e.clientX - rect.left;
				this.mCanvas.y = e.clientY - rect.top;
				this.drawSignature("move");
			},
			downSignature(e) {
				this.drawSignature("down");
			},
			upSignature(e) {
				this.drawSignature("up");
			},
			outSignature(e) {
				this.drawSignature("up");
			},
			initSignatureCanvas() {
				this.signatureCanvas = document.getElementById("signatureCanvas");
				this.ctxCanvas = this.signatureCanvas.getContext("2d");
				this.signatureCanvas.style.border = "1px solid black";
				this.mCanvas = {
					draw: false,
					x: 0,
					y: 0,
					lastX: 0,
					lastY: 0
				};
			},
			showSignatureModal() {				
				this.signatureModal = document.getElementById('signatureModal');
                this.signatureModal.classList.remove('hidden');		
			},
			saveSignature() {				
				this.signatureURL = this.signatureCanvas.toDataURL();	
				// const head = 'data:image/png;base64,';
				// const sizeInBytes = Math.round((this.signatureURL.length - head.length) * 3 / 4);		
				// console.log(sizeInBytes);	
                this.signatureModal.classList.add('hidden');
				this.drawText();
			},
			hideSignatureModal() {				
                this.signatureModal.classList.add('hidden');		
			},
			clearSignatureModal() {
				let temp = confirm("Are you sure you want to erase your signature?");
				if(temp) {
					this.ctxCanvas.clearRect(0, 0, this.signatureCanvas.offsetWidth, this.signatureCanvas.offsetHeight);
				}
			},
			drawSignature(val) {
				if (val === "up") {
					this.mCanvas.draw = false;
				}
				if (val === "down") {
					this.mCanvas.draw = true;
				}
				if (this.mCanvas.draw) {
					//console.log("drawing");
					this.ctxCanvas.beginPath();
					this.ctxCanvas.moveTo(this.mCanvas.lastX, this.mCanvas.lastY);
					this.ctxCanvas.lineTo(this.mCanvas.x, this.mCanvas.y);
					this.ctxCanvas.strokeStyle = 2;
					this.ctxCanvas.lineWidth = 1;
					this.ctxCanvas.stroke();
					this.ctxCanvas.closePath();
				}
			},
			init() {
				this.drawText();				
				this.getAllData('region');
				this.initSignatureCanvas();
				this.photoButton = document.getElementById("photoButton");
				this.uploadedImage = document.getElementById("uploadedImage");				
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
				this.drawText();
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

			// async getZipcode() {
			// 	return await fetch('./data/zipcodes.json')
			// 	.then(response => response.json())
			// 	.then(json => {
			// 		console.log(json); 
			// 	}).catch(error => console.error('Error fetching JSON:', error));
			// },

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

		    selectRegion(id, txt) {
		    	this.region_id = id;
				this.region = txt;
				this.drawText();
		    	this.getAllDataWithId('province', id);
		    },

		    selectProvince(id, txt) {
				this.province_id = id;
				this.province = txt;
				this.drawText();
				this.getAllDataWithId('city', id);
		    },	

		    selectCity(id, txt) {
				this.city_id = id;
				this.city = txt;
				this.drawText();
				this.getAllDataWithId('district', id);
		    },

			selectDistrict(id, txt) {
		    	this.district_id = id;
				this.district = txt;
				this.drawText();
				this.getAllDataWithId('barangay', id);
		    },
			selectBarangay(id, txt) {
		    	this.barangay_id = id;
				this.barangay = txt;
				this.drawText();
				this.getAllDataWithId('purok', id);
		    },
			selectPurok(id, txt) {
				this.purok_id = id;
				this.purok = txt;
				this.drawText();
			},
			getBday(btype) {
				if(btype == 'own') {
					this.bday = this.convertDate(this.birthdate);
				} else if(btype == 'ben1') {
					this.benday1 = this.convertDate(this.benbirthdate1);
				} else if(btype == 'ben2') {
					this.benday2 = this.convertDate(this.benbirthdate2);
				} else if(btype == 'ben3') {
					this.benday3 = this.convertDate(this.benbirthdate3);
				} else if(btype == 'ben4') {
					this.benday4 = this.convertDate(this.benbirthdate4);
				}
				this.drawText();
			},
		    validate() {
		      this.errors = {}			  
			  
		      if(!this.firstname) {
				this.errors.firstname = "(Required)";
				alert('First Name is required');
				const fname = document.getElementById("firstname");
				fname.focus();
			  } 
		      if(!this.lastname) {
				this.errors.lastname = "(Required)";
				alert('Last Name is required');
				const lname = document.getElementById("lastname");
				lname.focus();
			  } 
			  if(!this.filename) {
				alert('Picture is required');				
				this.photoButton.focus();
			  }
		      //if (!this.email) this.errors.email = "(Required)"		      
		      return Object.keys(this.errors).length === 0
		    },

		    clearInputs() {
		    		this.firstname = ''; this.lastname = ''; this.middlename = '';		    		
		    		this.email = ''; this.region = ''; this.province = '';
		    		this.city = ''; this.district = ''; this.barangay = '';
		    		this.purok = ''; this.civilstatus = ''; this.gender = '';
					this.religion = ''; this.bloodtype = ''; this.nickname = '';		    		
		    		this.suffix = ''; this.zipcode = ''; this.birthdate = ''; 
					this.birthplace = ''; this.age = ''; this.nationality = ''; 
					this.country = ''; this.height = ''; this.weight = ''; this.father = '';
		    		this.mother = ''; this.spouse = ''; this.education = '';
					this.position = ''; this.skill = ''; this.organization = '';		    		
		    		this.contact = ''; this.fb = ''; this.sss = ''; this.philhealth = '';		    		
		    		this.voter = ''; this.passport = ''; this.profid = ''; this.pagibig = '';		    		
		    		this.license = ''; this.senior = ''; this.chairman = ''; this.area = '';		    		
		    		this.mcnumber = ''; this.classification = ''; this.tribe = '';
		    		this.contactname = ''; this.contactnumber = ''; this.contactaddress = '';
		    		this.benname1 = '';	this.benage1 = ''; this.benrelationship1 = '';
					this.benbirthdate1 = ''; this.benname2 = ''; this.benage2 = '';
		    		this.benrelationship2 = ''; this.benbirthdate2 = ''; this.benname3 = '';
		    		this.benage3 = ''; this.benrelationship3 = ''; this.benbirthdate3 = '';
					this.benname4 = ''; this.benage4 = ''; this.benrelationship4 = '';
					this.benbirthdate4 = ''; this.insurance = ''; this.burial = '';
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
			        	firstname: this.firstname, lastname: this.lastname,
			        	middlename: this.middlename, email: this.email,
						nickname: this.nickname, suffix: this.suffix,
						region_id: this.region_id, province_id: this.province_id,
						city_id: this.city_id, district_id: this.district_id,
						barangay_id: this.barangay_id, purok_id: this.purok_id,
						zipcode: this.zipcode, birthdate: this.birthdate,
						birthplace: this.birthplace, age: this.age,
						civilstatus: this.civilstatus, gender: this.gender,
						nationality: this.nationality, country: this.country,
						religion: this.religion, bloodtype: this.bloodtype,
						height: this.height, weight: this.weight,
						father: this.father, mother: this.mother,
						spouse: this.spouse, education: this.education,
						position: this.position, skill: this.skill,
						organization: this.organization, contact: this.contact,
						fb: this.fb, sss: this.sss, philhealth: this.philhealth,
						voter: this.voter, passport: this.passport,
						profid: this.profid, pagibig: this.pagibig,
						license: this.license, senior: this.senior,
						chairman: this.chairman, area: this.area,
						mcnumber: this.mcnumber, classification: this.classification,
						tribe: this.tribe, contactname: this.contactname,
						contactnumber: this.contactnumber, contactaddress: this.contactaddress,
						benname1: this.benname1, benage1: this.benage1,
						benrelationship1: this.benrelationship1, benbirthdate1: this.benbirthdate1,
						benname2: this.benname2, benage2: this.benage2,
						benrelationship2: this.benrelationship2, benbirthdate2: this.benbirthdate2,
						benname3: this.benname3, benage3: this.benage3,
						benrelationship3: this.benrelationship3, benbirthdate3: this.benbirthdate3,
						benname4: this.benname4, benage4: this.benage4,
						benrelationship4: this.benrelationship4, benbirthdate4: this.benbirthdate4,
						insurance: this.insurance, burial: this.burial, 
						courseToAvail: this.courseToAvail, filename: this.filename
			        })
			      });

		      	const res = await response.json();
		      	const modal = document.getElementById('successModal');

			      if(!res.status) {
			      	alert(res.message);
			      } else {
			      	this.clearInputs();
			      	modal.classList.remove('hidden');
			      	setTimeout(() => {
						modal.classList.add('hidden');
						this.downloadCanvas();
						setTimeout(() => {
							window.location = "index.php";
						}, 2000);
					}, 2000);
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