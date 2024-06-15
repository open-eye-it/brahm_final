<?php include('../layout/header.php');
$createMsg = '';

$page_uri = $_SERVER['QUERY_STRING'];
$query_uri_arr = explode('&', $page_uri);
$family_arr = explode('=', $query_uri_arr[0]);
$member_arr = explode('=', $query_uri_arr[1]);  
$YearListArr = $membershipModel->YearList();
$yearLists = $YearListArr['data'];

$memberData = [];
if(isset($family_arr) && isset($member_arr) && $family_arr[1] != '' && $member_arr[1] != ''){
    $memberArr = $membershipModel->singleMember($family_arr[1], $member_arr[1]);
    $memberData = $memberArr['data'];

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
            'Status_' => $_POST['Status_']
        ];
        $createRes = $membershipModel->updateMember($InsertArr, $member_arr[1], $family_arr[1]);
        if($createRes['status'] == 'success'){
            $createMsg = $createRes['status'];
        }else{
            $createMsg = $createRes;
        }
    }
}else{
    $createMsg = 'success';
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
												<h3 class="card-title">Update Member</h3>
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
                                                                    <option value="Mr" <?php echo ($memberData['preFix'] == 'Mr') ? 'selected' : ''; ?>>Mr</option>
                                                                    <option value="Mrs" <?php echo ($memberData['preFix'] == 'Mrs') ? 'selected' : ''; ?>>Mrs</option>
                                                                    <option value="Ms" <?php echo ($memberData['preFix'] == 'Ms') ? 'selected' : ''; ?>>Ms</option>
                                                                    <option value="Miss" <?php echo ($memberData['preFix'] == 'Miss') ? 'selected' : ''; ?>>Miss</option>
                                                                    <option value="Master" <?php echo ($memberData['preFix'] == 'Master') ? 'selected' : ''; ?>>Master</option>
                                                                    <option value="Dr" <?php echo ($memberData['preFix'] == 'Dr') ? 'selected' : ''; ?>>Dr</option>
                                                                    <option value="Er" <?php echo ($memberData['preFix'] == 'Er') ? 'selected' : ''; ?>>Er</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="preFixErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Surname
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Surname" name="SurName" id="SurName" value="<?php echo $memberData['SurName']; ?>" />
                                                                <span class="form-text text-danger" id="SurNameErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Name
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Name" name="FirstName" id="FirstName" value="<?php echo $memberData['FirstName']; ?>" />
                                                                <span class="form-text text-danger" id="FirstNameErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Father's Name
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Father's Name" name="MiddleName" id="MiddleName" value="<?php echo $memberData['MiddleName']; ?>" />
                                                                <span class="form-text text-danger" id="MiddleNameErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Relation with Family
                                                                <span class="text-danger">*</span></label>
                                                                <select name="Relation" id="Relation" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <option value="HEAD" <?php echo ($memberData['Relation'] == 'HEAD') ? 'selected' : ''; ?>>HEAD</option>
                                                                    <option value="WIFE" <?php echo ($memberData['Relation'] == 'WIFE') ? 'selected' : ''; ?>>WIFE</option>
                                                                    <option value="SON" <?php echo ($memberData['Relation'] == 'SON') ? 'selected' : ''; ?>>SON</option>
                                                                    <option value="DAUGHTER" <?php echo ($memberData['Relation'] == 'DAUGHTER') ? 'selected' : ''; ?>>DAUGHTER</option>
                                                                    <option value="FATHER" <?php echo ($memberData['Relation'] == 'FATHER') ? 'selected' : ''; ?>>FATHER</option>
                                                                    <option value="MOTHER" <?php echo ($memberData['Relation'] == 'MOTHER') ? 'selected' : ''; ?>>MOTHER</option>
                                                                    <option value="HUSBAND" <?php echo ($memberData['Relation'] == 'HUSBAND') ? 'selected' : ''; ?>>HUSBAND</option>
                                                                    <option value="DAUGHTER-IN-LAW" <?php echo ($memberData['Relation'] == 'DAUGHTER-IN-LAW') ? 'selected' : ''; ?>>DAUGHTER-IN-LAW</option>
                                                                    <option value="SON-IN-LAW" <?php echo ($memberData['Relation'] == 'SON-IN-LAW') ? 'selected' : ''; ?>>SON-IN-LAW</option>
                                                                    <option value="GRAND SON" <?php echo ($memberData['Relation'] == 'GRAND SON') ? 'selected' : ''; ?>>GRAND SON</option>
                                                                    <option value="GRAND DAUGHTER" <?php echo ($memberData['Relation'] == 'GRAND DAUGHTER') ? 'selected' : ''; ?>>GRAND DAUGHTER</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="RelationErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Birth Date
                                                                <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" placeholder="CountryBirth Date" name="DOB" id="DOB" value="<?php echo $memberData['DOB']; ?>" />
                                                                <span class="form-text text-danger" id="DOBErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Maritul Status
                                                                <span class="text-danger">*</span></label>
                                                                <select name="M_Status" id="M_Status" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <option value="Married" <?php echo ($memberData['M_Status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                                                    <option value="Unmarried" <?php echo ($memberData['M_Status'] == 'Unmarried') ? 'selected' : ''; ?>>Unmarried</option>
                                                                    <option value="Divorcee" <?php echo ($memberData['M_Status'] == 'Divorcee') ? 'selected' : ''; ?>>Divorcee</option>
                                                                    <option value="Widow" <?php echo ($memberData['M_Status'] == 'Widow') ? 'selected' : ''; ?>>Widow</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="M_StatusErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Mosal</label>
                                                                <input type="text" class="form-control" placeholder="Mosal" name="Mosal" id="Mosal" value="<?php echo $memberData['Mosal']; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Qualification</label>
                                                                <input type="text" class="form-control" placeholder="Qualification" name="Qualification" id="Qualification" value="<?php echo $memberData['Qualification']; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Occupation</label>
                                                                <input type="text" class="form-control" placeholder="Occupation" name="Occupation" id="Occupation" value="<?php echo $memberData['Occupation']; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Email</label>
                                                                <input type="email" class="form-control" placeholder="Email" name="Email" id="Email" value="<?php echo $memberData['Email']; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Created Year
                                                                <span class="text-danger">*</span></label>
                                                                <select name="Created_Year" id="Created_Year" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <?php foreach($yearLists as $list){ ?>
                                                                        <option value="<?php echo $list['yearID']; ?>"  <?php echo ($memberData['Created_Year'] == $list['yearID']) ? 'selected' : ''; ?>><?php echo $list['yearName']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <span class="form-text text-danger" id="Created_YearErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Status</label>
                                                                <select name="Status_" id="Status_" class="form-control">
                                                                    <option value="">-Select-</option>
                                                                    <option value="Active" <?php echo ($memberData['Status_'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="New Born" <?php echo ($memberData['Status_'] == 'New Born') ? 'selected' : ''; ?>>New Born</option>
                                                                    <option value="Left Family" <?php echo ($memberData['Status_'] == 'Left Family') ? 'selected' : ''; ?>>Left Family</option>
                                                                    <option value="Away - Temporary" <?php echo ($memberData['Status_'] == 'Away - Temporary') ? 'selected' : ''; ?>>Away - Temporary</option>
                                                                    <option value="Death" <?php echo ($memberData['Status_'] == 'Death') ? 'selected' : ''; ?>>Death</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="Created_YearErr"></span>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												<div class="card-footer">
                                                    <input type="hidden" name="MM_insert" id="MM_insert" value="form1">
													<button type="submit" class="btn btn-primary mr-2" id="createUser">Update</button>
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