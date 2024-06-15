<?php include('../layout/header.php'); 
?>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
												<h3 class="card-title">Letters to Members Families</h3>
											</div>
											<!--begin::Form-->
											<form method="post" action="<?php echo $base_url; ?>letter/export-letter-all-member.php" id="newUserUpdate">
												<div class="card-body">
                                                    <?php if($createMsg == 'fail'){ ?>
                                                        <div class="form-group mb-8">
                                                            <div class="alert alert-custom alert-danger" role="alert">  
                                                                <div class="alert-text">Something wrong in family form, please try again.</div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Page Size
                                                                <span class="text-danger">*</span></label>
                                                                <select name="pageType" id="pageType" class="form-control">
                                                                    <option value="A4">A4</option>
                                                                    <option value="A5">A5</option>
                                                                    <option value="Letter">Letter</option>
                                                                    <option value="OFFICE">OFFICE</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="pageTypeErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Page Oriention
                                                                <span class="text-danger">*</span></label>
                                                                <select name="pageOrientation" id="pageOrientation" class="form-control">
                                                                    <option value="PORTRAIT">PORTRAIT</option>
                                                                    <option value="LANDSCAPE">LANDSCAPE</option>
                                                                </select>
                                                                <span class="form-text text-danger" id="pageOrientationErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Margin Left
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Margin Left" name="left" id="left" value="1.5" />
                                                                <span class="form-text text-danger" id="leftErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Margin Right
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Margin Right" name="right" id="right" value="1.5" />
                                                                <span class="form-text text-danger" id="rightErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Margin Top
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Margin Top" name="top" id="top" value="1.0" />
                                                                <span class="form-text text-danger" id="topErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Margin Bottom
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Margin Bottom" name="bottom" id="bottom" value="1.0" />
                                                                <span class="form-text text-danger" id="bottomErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Date
                                                                <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" placeholder="Date" name="date" id="date" />
                                                                <span class="form-text text-danger" id="dateErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Subject
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Subject" name="subject" id="subject" />
                                                                <span class="form-text text-danger" id="subjectErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Body Text
                                                                <span class="text-danger">*</span></label>
                                                                <textarea name="lettertext" id="lettertext" cols="30" rows="10" class="form-control" placeholder="Body Text"></textarea>
                                                                <span class="form-text text-danger" id="lettertextErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">Closing Text <span class="text-danger">*</span></label>
                                                                <textarea name="closetext" id="closetext" cols="30" rows="10" class="form-control" placeholder="Closing Text"></textarea>
                                                                <span class="form-text text-danger" id="closetextErr"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="usrName">PS <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="PS" name="pstext" id="pstext" />
                                                                <span class="form-text text-danger" id="pstextErr"></span>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												<div class="card-footer">
                                                    <input type="hidden" name="doc_generate" id="doc_generate" value="doc_generate">
													<button type="submit" class="btn btn-primary mr-2" id="createUser">Create</button>
													<a href="<?php echo $base_url; ?>membership/list.php" class="btn btn-secondary">Cancel</a>
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
    $('#newUserUpdate').on('submit', function(e){
		let form = $(this).parents('form');
        let pageType = $('#pageType').val();
		let pageOrientation = $('#pageOrientation').val();
		let left = $('#left').val();
		let right = $('#right').val();
        let top = $('#top').val();
        let bottom = $('#bottom').val();
        let date = $('#date').val();
        let subject = $('#subject').val();
        let lettertext = $('#lettertext').val();
        let closetext = $('#closetext').val();
        let pstext = $('#pstext').val();
		
		if(pageType == ''){e.preventDefault();
			$('#pageTypeErr').html('Please select page type');
			timeOut('pageTypeErr', 3000);
            scrollTop('pageType');
		}else if(pageOrientation == ''){e.preventDefault();
			$('#pageOrientationErr').html('Please select page orientation');
			timeOut('pageOrientationErr', 3000);
            scrollTop('pageOrientation');
		}else if(left == ''){e.preventDefault();
			$('#leftErr').html('Please enter enter left margin');
			timeOut('leftErr', 3000);
            scrollTop('left');
		}else if(right == ''){e.preventDefault();
			$('#rightErr').html('Please enter right margin');
			timeOut('rightErr', 3000);
            scrollTop('right');
		}else if(top == ''){e.preventDefault();
			$('#topErr').html('Please enter top margin');
			timeOut('topErr', 3000);
            scrollTop('top');
		}else if(bottom == ''){e.preventDefault();
			$('#bottomErr').html('Please enter bottom margin');
			timeOut('bottomErr', 3000);
            scrollTop('bottom');
		}else if(date == ''){e.preventDefault();
			$('#dateErr').html('Please select date');
			timeOut('dateErr', 3000);
            scrollTop('date');
		}else if(subject == ''){e.preventDefault();
			$('#subjectErr').html('Please enter subject');
			timeOut('subjectErr', 3000);
            scrollTop('subject');
		}else if(lettertext == ''){e.preventDefault();
			$('#lettertextErr').html('Please enter Body Text');
			timeOut('lettertextErr', 3000);
            scrollTop('lettertext');
		}else if(closetext == ''){e.preventDefault();
			$('#closetextErr').html('Please enter Closing Text');
			timeOut('closetextErr', 3000);
            scrollTop('closetext');
		}else if(pstext == ''){e.preventDefault();
			$('#pstextErr').html('Please enter PS Text');
			timeOut('pstextErr', 3000);
            scrollTop('pstext');
		}else{
			form.submit();
		}
    });
</script>