<?php include('../layout/header.php');
$createMsg = '';

$page_uri = $_SERVER['QUERY_STRING'];
$query_uri_arr = explode('&', $page_uri);
$family_arr = explode('=', $query_uri_arr[0]);
$YearListArr = $membershipModel->YearList();
$yearLists = $YearListArr['data'];

if(isset($_POST['MM_insert']) && $family_arr[1] != ''){
    $InsertArr = [
        'familyid1' => $family_arr[1],
        'preFix' => $_POST['preFix'],
        'SurName' => $_POST['SurName'],
        'FirstName' => $_POST['FirstName'],
        'MiddleName' => $_POST['MiddleName'],
        'Relation' => $_POST['Relation'],
        'DOB' => $_POST['DOB'],
        'M_Status' => $_POST['M_Status'],
        'Mosal' => $_POST['Mosal'],
        'Qualification' => $_POST['Qualification'],
        'Occupation' => $_POST['Occupation'],
        'Email' => $_POST['Email'],
        'Created_Year' => $_POST['Created_Year'],
    ];
	$createRes = $membershipModel->createMember($InsertArr);
	if($createRes == 'success'){
		$createMsg = $createRes;
	}else{
		$createMsg = $createRes;
	}
}
?>
<script>
	let createMsg = "<?php echo $createMsg; ?>";
	if(createMsg === 'success'){
		window.location.href = "<?php echo $base_url; ?>"+"membership/member-list.php?family=<?php echo $family_arr[1]; ?>";
	}
</script>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
												<h3 class="card-title">Create Member</h3>
											</div>
											<!--begin::Form-->
											<form method="post" action="" id="newMemberUpdate">
												<div class="card-body">
                                                    <?php if($createMsg == 'fail'){ ?>
                                                        <div class="form-group mb-8">
                                                            <div class="alert alert-custom alert-danger" role="alert">  
                                                                <div class="alert-text">Something wrong in membership form, please try again.</div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Salutation
                                                                <span class="text-danger">*</span></label>
                                                                <select name="preFix" id="preFix" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <option value="Mr">Mr</option>
                                                                    <option value="Mrs">Mrs</option>
                                                                    <option value="Ms">Ms</option>
                                                                    <option value="Miss">Miss</option>
                                                                    <option value="Master">Master</option>
                                                                    <option value="Dr">Dr</option>
                                                                    <option value="Er">Er</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="preFixErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Surname
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Surname" name="SurName" id="SurName" />
                                                                <span class="form-text text-danger" id="SurNameErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Name
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Name" name="FirstName" id="FirstName" />
                                                                <span class="form-text text-danger" id="FirstNameErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Father's Name
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Father's Name" name="MiddleName" id="MiddleName" />
                                                                <span class="form-text text-danger" id="MiddleNameErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Relation with Family
                                                                <span class="text-danger">*</span></label>
                                                                <select name="Relation" id="Relation" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <option value="HEAD">HEAD</option>
                                                                    <option value="WIFE">WIFE</option>
                                                                    <option value="SON">SON</option>
                                                                    <option value="DAUGHTER">DAUGHTER</option>
                                                                    <option value="FATHER">FATHER</option>
                                                                    <option value="MOTHER">MOTHER</option>
                                                                    <option value="HUSBAND">HUSBAND</option>
                                                                    <option value="DAUGHTER-IN-LAW">DAUGHTER-IN-LAW</option>
                                                                    <option value="SON-IN-LAW">SON-IN-LAW</option>
                                                                    <option value="GRAND SON">GRAND SON</option>
                                                                    <option value="GRAND DAUGHTER">GRAND DAUGHTER</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="RelationErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Birth Date
                                                                <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" placeholder="CountryBirth Date" name="DOB" id="DOB" />
                                                                <span class="form-text text-danger" id="DOBErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Maritul Status
                                                                <span class="text-danger">*</span></label>
                                                                <select name="M_Status" id="M_Status" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <option value="Married">Married</option>
                                                                    <option value="Unmarried">Unmarried</option>
                                                                    <option value="Divorcee">Divorcee</option>
                                                                    <option value="Widow">Widow</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="M_StatusErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Mosal</label>
                                                                <input type="text" class="form-control" placeholder="Mosal" name="Mosal" id="Mosal" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Qualification</label>
                                                                <input type="text" class="form-control" placeholder="Qualification" name="Qualification" id="Qualification" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Occupation</label>
                                                                <input type="text" class="form-control" placeholder="Occupation" name="Occupation" id="Occupation" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Email</label>
                                                                <input type="email" class="form-control" placeholder="Email" name="Email" id="Email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Created Year
                                                                <span class="text-danger">*</span></label>
                                                                <select name="Created_Year" id="Created_Year" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <?php foreach($yearLists as $list){ ?>
                                                                        <option value="<?php echo $list['yearID']; ?>"><?php echo $list['yearName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="form-text text-danger" id="Created_YearErr"></span>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												<div class="card-footer">
                                                    <input type="hidden" name="MM_insert" id="MM_insert" value="form1">
													<button type="submit" class="btn btn-primary mr-2" id="createUser">Create</button>
													<a href="<?php echo $base_url; ?>membership/member-list.php?family=<?php echo $family_arr[1]; ?>" class="btn btn-secondary">Cancel</a>
												</div>
											</form>
											<!--end::Form-->
										</div>
								<!--end::Dashboard-->
							</div>
							<!--end::Content-->
						</div>
						<!--begin::Content Wrapper-->
					</div>
					<!--end::Container-->
<?php include('../layout/footer.php'); ?>
<script type="text/javascript">
    $('#newMemberUpdate').on('submit', function(e){
		let form = $(this).parents('form');
        let preFix = $('#preFix').val();
		let SurName = $('#SurName').val();
		let FirstName = $('#FirstName').val();
		let MiddleName = $('#MiddleName').val();
        let Relation = $('#Relation').val();
        let DOB = $('#DOB').val();
        let M_Status = $('#M_Status').val();
        let Created_Year = $('#Created_Year').val();
		
		if(preFix == ''){e.preventDefault();
			$('#preFixErr').html('Please select salutation');
			timeOut('preFixErr', 3000);
            scrollTop('preFix');
		}else if(SurName == ''){e.preventDefault();
			$('#SurNameErr').html('Please enter surname');
			timeOut('SurNameErr', 3000);
            scrollTop('SurNameErr');
		}else if(FirstName == ''){e.preventDefault();
			$('#FirstNameErr').html('Please enter name');
			timeOut('FirstNameErr', 3000);
            scrollTop('FirstNameErr');
		}else if(MiddleName == ''){e.preventDefault();
			$('#MiddleNameErr').html('Please enter father name');
			timeOut('MiddleNameErr', 3000);
            scrollTop('MiddleNameErr');
		}else if(Relation == ''){e.preventDefault();
			$('#RelationErr').html('Please select relation with family');
			timeOut('RelationErr', 3000);
            scrollTop('RelationErr');
		}else if(DOB == ''){e.preventDefault();
			$('#DOBErr').html('Please select DOB');
			timeOut('DOBErr', 3000);
            scrollTop('DOBErr');
		}else if(M_Status == ''){e.preventDefault();
			$('#M_StatusErr').html('Please select maritual status');
			timeOut('M_StatusErr', 3000);
            scrollTop('M_StatusErr');
		}else if(Created_Year == ''){e.preventDefault();
			$('#Created_YearErr').html('Please select created year');
			timeOut('Created_YearErr', 3000);
            scrollTop('Created_YearErr');
		}else{
			form.submit();
		}
    });
</script>