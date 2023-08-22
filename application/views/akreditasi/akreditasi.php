<section class="content">
<div class="container-fluid">
            <div class="block-header">
                <h2>Akreditasi</h2>
            </div>
			<?php if (isset($message)) {
    echo '<div class="alert bg-teal alert-dismissible" role="alert" id="flash-msg">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				'.$message.'
				</div>';
}?>

            <!-- Basic Alerts -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               SK Akreditasi
                            </h2>
                            
                           
                        </div> <br>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="container-fluid">
                                    <div class="col-md-12">
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="file" id="files" name="files" multiple="multiple" /> <br>
                                            <p>
                                                <input type="submit" value="Import Data" class="btn btn-lg btn-primary" />
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6">
                                <div class="container-fluid">
                            <div class="col-md-12">
                                <form method="post" enctype="multipart/form-data">
                                    <input type="file" id="files" name="files" multiple="multiple" /> <br>
                                    <p>
                                        <input type="submit" value="Import Data" class="btn btn-lg btn-primary" />
                                    </p>
                                </form>
                            </div>
                        </div>
                                </div>
                            </div>
                        </div>
                    
					</div>
				</div>
            <!-- #END# Basic Alerts -->
		</div>
</section>