<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SDSD Initiative Inc. - Administration Panel</title>
  <link href="../src/output.css" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../images/logo.ico">
  <script defer src="../js/alpinejs.cdn.min.js"></script>
</head>
<body x-data="pageLoad()" class="w-screen h-screen bg-[url(../images/greenbg.jpg)] bg-center bg-cover bg-no-repeat">
    <?php include('../includes/admin/modals/tables/payments.php'); ?>
    <?php include('../includes/admin/modals/payment.php'); ?>    
    <?php include('../includes/admin/modals/edit-payment.php'); ?>
    <?php include('../includes/admin/modals/delete-payment.php'); ?>
    <?php include('../includes/admin/modals/change-successful.php'); ?>
    <?php include('../includes/admin/modals/add-successful.php'); ?>
    <?php include('../includes/admin/modals/delete-successful.php'); ?>
    <?php include('../includes/admin/modals/edit-successful.php'); ?>
    
    <canvas id="formCanvas" x-ref="printableForm" width="1699" height="2360" class="top-0 left-0 hidden"></canvas>

    <div class="flex h-screen bg-transparent">
        <input type="checkbox" id="menu-toggle" class="hidden peer">
        <?php include('../includes/admin/sidebar.php'); ?>
        <div class="flex flex-col flex-1 overflow-y-auto">
            <?php include('../includes/admin/header.php'); ?>
            <div class="p-1">
                <div class="flex bg-green-400 items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <h1 class="text-2xl text-purple-600 font-bold p-2 text-shadow-lg">List of Beneficiaries</h1>
                        <input 
                            type="text" 
                            x-model="searchWord" 
                            @keyup.enter="searchData"  
                            placeholder="Search beneficiary here and press enter" 
                            class="text-md bg-white h-6 w-80 p-4 rounded-sm border-green-900 shadow-md outline-none">
                    </div>
                    <button type="button" class="inline-flex items-center text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 box-border border border-transparent shadow-lg font-medium leading-5 rounded-full text-sm px-3 py-1.5 focus:outline-none cursor-pointer">
                    <?php include('../includes/admin/icons/add.php'); ?>
                        Add Beneficiary
                    </button>
                </div>                                							
                <div class="relative overflow-x-auto bg-green-400 shadow-xs rounded-base border border-default">                                
                    <?php include('../includes/admin/tables/beneficiary.php'); ?>
                </div>
            </div>
        </div>
    </div>
	<script>
        function pageLoad() {
		  return {
		    user: {}, 
            showRow: false,
            userId: null,
            created_at: '',
            paymentModal: null,
            paymentsTableModal: null,
            editPaymentModal: null,
            changeSuccessful: null,
            deleteSuccessful: null,
            deletePaymentModal: null,
            editSuccessfulModal: null,
            totalPay: 0.00,
            amount: '',
            searchWord: '',
            owner: '',            
            errors: [],
            beneficiaries: [],
            users: [],
            payments: [],
            downloadCanvas() {
                const canvas = this.$refs.printableForm;
                const image = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = image;
                link.download = `${this.user.firstname}-${this.user.lastname}.png`;
                link.click();
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
					this.benname4, this.convertDate(this.benbirthdate1), 
                    this.convertDate(this.benbirthdate2), this.convertDate(this.benbirthdate3), 
                    this.convertDate(this.benbirthdate4), this.benage1, this.benage2, this.benage3, 
                    this.benage4, this.benrelationship1, this.benrelationship2, this.benrelationship3, 
                    this.benrelationship4, this.insurance, this.burial, this.courseToAvail, this.filename
				);
			},
            drawForm(fname, lname, mname, sfx, nname, reg, pr, ct, ds, br, pk, zp, bdy, bp, ag, 
				rlg, nat, cnty, cstat, gend, bldt, hgt, wgt, fth, mth, sps, edc, pos, skl, org,
				cntc, fcb, eml, ss, phil, vtr, pspt, prof, pag, lic, sen, cls, chr, are, mcn,
				trb, ctcnam, ctcnum, ctcadr, benn1, benn2, benn3, benn4, benb1, benb2, benb3,
				benb4, beng1, beng2, beng3, beng4, benr1, benr2, benr3, benr4, ins, bur, cta, fln
			) {
				const canvas = document.getElementById('formCanvas');
				const ctx = canvas.getContext('2d');
				const img = new Image();
				img.onload = function() {
					ctx.drawImage(img, 0, 0);
					ctx.font = '25px Arial';
					ctx.fillStyle = '#3e3d3d'; 
					const fullname = `${fname}  ${mname}  ${lname}  ${sfx}`;
					if(fln !== '') {                        
						const img2 = new Image();
						img2.src = `../images/photos/${fln}`;                       
						ctx.drawImage(img2, 1300, 65);
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
				img.src = '../images/form.jpg';				
			},
            cancelUpdate() {                
                this.editPaymentModal.classList.add('hidden');
            },
            async updatePayment() {                
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/editData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        name: this.amount,
                                        id: this.editId,
                                        page: 'payment'
                                    })
                                });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('edit', 2000);
                }
            },
            async editPayment(id) {
                this.editId = id;
                this.editPaymentModal = document.getElementById('editPaymentModal');
                this.editPaymentModal.classList.remove('hidden');
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/getData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.editId,
                                        page: 'payment'
                                    })
                                });
                    let res = await response.json();
                    this.amount = res.data.amount;
                } catch (error) {
		      		console.error('Error fetching data:', error);
                }
            },
            async deletePayment() {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/deleteData.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: this.deleteId,
                                        page: 'payment'
                                    })
                                });
                    let res = await response.json();                            
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {                    
                    this.init();
                    this.displayModal('delete', 2000);
                }
            },
            cancelDeletion() {
                this.deletePaymentModal.classList.add('hidden');
            },
            deleteConfirm(id) {
                this.deleteId = id;
                this.deletePaymentModal = document.getElementById('deletePaymentModal');
                this.deletePaymentModal.classList.remove('hidden');                
            },            
            async getName(id) {
                let response = await fetch('http://localhost/sdsg/api/admin/payment.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ 
                        user_id: id,                        
                        amount: 10,
                        created_at: '2026-02-21',
                        mode: "single"
                    })
                });
                let payment = await response.json();
                this.owner =  `${payment.data.firstname} ${payment.data.lastname}`;
            },
            async searchData() {
                if(this.searchWord == '') {
                    this.init();
                } else {
                    try {
                        let response = await fetch('http://localhost/sdsg/api/admin/readMembers.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify({ 
                                user_id: 1,
                                page: 'some',
                                searchWord: this.searchWord
                            })
                        });
                        let data = await response.json();
                        this.beneficiaries = data.users;                            
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    } 
                }
            },
            getTotal(arr) {
                let total = 0;
                arr.forEach((element, index, array) => {
                    total += element.amount;
                });
                return total;
            },
            closeTable() {
                this.owner = '';
                this.paymentsTableModal.classList.add('hidden');
            },
            setClassification(cls) {
                if(cls == 'paying') {
                    return true;
                } else {
                    return false;
                }
            },
            async changeStatus(id, classification) {
                classification = classification === 'paying' ? 'nonpaying' : 'paying';
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/changeStatus.php', {
                            method: 'POST',
                            headers: {'Content-Type': 'application/json'},
                            body: JSON.stringify({ 
                                id: id,
                                status: classification,
                                page: 'payment'
                            })
                        });
                    let res = await response.json();                    
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('change', 2000);                                        
                }
            },
            async changeUserStatus(id, status) {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/changeStatus.php', {
                                    method: 'POST',
                                    headers: {'Content-Type': 'application/json'},
                                    body: JSON.stringify({ 
                                        id: id,
                                        status: status,
                                        page: 'beneficiary'
                                    })
                                });
                    let res = await response.json();
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('change', 2000);
                }
            },
            displayModal(page, msec) {
                if(page == 'change') {
                    this.changeSuccessful = document.getElementById('changeSuccessful');
                    this.changeSuccessful.classList.remove('hidden');
                } else if(page == 'delete') {
                    this.deletePaymentModal.classList.add('hidden');
                    this.paymentsTableModal.classList.add('hidden');
                    this.deleteSuccessful = document.getElementById('deleteSuccessful');
                    this.deleteSuccessful.classList.remove('hidden');
                } else if(page == 'edit') {
                    this.editPaymentModal.classList.add('hidden');
                    this.paymentsTableModal.classList.add('hidden');
                    this.editSuccessfulModal = document.getElementById('editSuccessfulModal');
                    this.editSuccessfulModal.classList.remove('hidden');
                } else if(page == 'add') {
                    this.paymentModal.classList.add('hidden');
                    this.addSuccessful = document.getElementById('addSuccessful');
                    this.addSuccessful.classList.remove('hidden');
                }
                setTimeout(() => {
                    if(page == 'change') {
                        this.changeSuccessful.classList.add('hidden');
                    } else if(page == 'delete') {
                        this.deleteSuccessful.classList.add('hidden');
                    } else if(page == 'edit') {
                        this.editSuccessfulModal.classList.add('hidden');
                    } else if(page == 'add') {
                        this.addSuccessful.classList.add('hidden');
                    }
                }, msec);
            },
            convertDate(dt) {
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
            async showTable(id) {
                this.getName(id);
                this.userId = id;
                this.paymentsTableModal = document.getElementById('paymentsTableModal');	
                this.paymentsTableModal.classList.remove('hidden');
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/payment.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            user_id: this.userId,
                            amount: 10,
                            created_at: '2026-02-21',
                            mode: "search"
                        })
                    });
                    let payment = await response.json();                    
                    this.payments = payment.data;
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.totalPay = this.getTotal(this.payments);
                }
            },
            async submitPayment() {
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/payment.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            user_id: this.userId,
                            amount: this.amount,
                            created_at: this.created_at,
                            mode: "add"
                        })
                    });
                    this.user = await response.json();
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } finally {
                    this.init();
                    this.displayModal('add', 2000);                    
                }
            },            
            payNow(id) {
                this.userId = id;
                this.amount = '';
                this.paymentModal = document.getElementById('paymentModal');	
                this.paymentModal.classList.remove('hidden');
            },
            cancelPayment() {                
                paymentModal.classList.add('hidden');
            },
            async showForm(id) {
                this.userId = id;
                try {
                    let response = await fetch('http://localhost/sdsg/api/admin/payment.php', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json'},
                        body: JSON.stringify({ 
                            user_id: id,
                            amount: 10,
                            created_at: '2026-02-21',
                            mode: "download"
                        })
                    });
                    let user = await response.json();                    
                    let usr = user.data;
                    this.user = usr;
                    //console.log(JSON.stringify(this.users));
                    this.drawForm(usr.firstname, usr.lastname, usr.middlename, usr.suffix,
                        usr.nickname, usr.region, usr.province, usr.city, usr.district,
                        usr.barangay, usr.purok, usr.zipcode, this.convertDate(usr.bday), usr.birthplace,
                        usr.age, usr.religion, usr.nationality, usr.country, usr.civilstatus, 
                        usr.gender, usr.bloodtype, usr.height, usr.weight, usr.father,
                        usr.mother, usr.spouse, usr.education, usr.position, usr.skill,
                        usr.organization, usr.contact, usr.fb, usr.email, usr.sss,
                        usr.philhealth, usr.voter, usr.passport, usr.profid, usr.pagibig,
                        usr.license, usr.senior, usr.classification, usr.chairman, usr.area,
                        usr.mcnumber, usr.tribe, usr.contactname, usr.contactnumber,
                        usr.contactaddress, usr.benname1, usr.benname2, usr.benname3,
                        usr.benname4, this.convertDate(usr.benbirthdate1), 
                        this.convertDate(usr.benbirthdate2), this.convertDate(usr.benbirthdate3), 
                        this.convertDate(usr.benbirthdate4), usr.benage1, usr.benage2, usr.benage3, 
                        usr.benage4, usr.benrelationship1, usr.benrelationship2, usr.benrelationship3, 
                        usr.benrelationship4, usr.insurance, usr.burial, usr.courseToAvail, usr.photo
                    );
                    setTimeout(() => {
						this.downloadCanvas();						
					}, 2000);
                } catch (error) {
		      		console.error('Error fetching data:', error);
                } 
            },
            initDateInput(di) {
                let dt = new Date();
                if(di != '') {
                    dt = new Date(di);
                }                
                let day = ("0" + dt.getDate()).slice(-2);
                let month = ("0" + (dt.getMonth() + 1)).slice(-2);
                let hour = ("0" + (dt.getHours() + 1)).slice(-2);
                let minute = ("0" + (dt.getMinutes() + 1)).slice(-2);
                let second = ("0" + (dt.getSeconds() + 1)).slice(-2);
                return `${dt.getFullYear()}-${month}-${day} ${hour}:${minute}:${second}`; 
            },
            async init() { 
                this.created_at = this.initDateInput(''); 
                let user_id = sessionStorage.getItem('user_id');                
                let response = await fetch('http://localhost/sdsg/api/admin/readMembers.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ 
                        user_id: user_id,
                        page: 'all',
                        searchWord: 'sample'
                    })
                });
                this.user = await response.json();
                this.beneficiaries = this.user.users;               
                this.showRow = false;                 
                if(this.beneficiaries.length > 0) { 
                    this.showRow = true;
                }
            }	
		  }
		}        
	</script>
</body>
</html>