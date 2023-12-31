<section class="content">
<div class="container-fluid">
            <div class="block-header">
                <h2>SK Akreditasi</h2>
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
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><?php echo anchor('eventa/create', 'Tambah data'); ?></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
											<th>Judul</th>
											<th>Download</th>
											<th>Tanggal Posting</th>
											<th>Aksi</th>
										</tr>
                                    </thead>                                    
                                    <tbody>                                        
										<?php foreach ($_get_eventa as $row):?>
											<tr>
                                                <td><?php echo htmlspecialchars($row->nama_event, ENT_QUOTES, 'UTF-8'); ?></td>
												<td><a href="<?php echo htmlspecialchars($row->event_title, ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($row->event_title, ENT_QUOTES, 'UTF-8'); ?></a></td>
                                                <td><?php echo htmlspecialchars(indonesian_date($row->tanggal_posting), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
												<?php echo anchor('eventa/delete/'.$row->id, '<button type="button" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
													<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Delete">delete</i>
                                                </button>'); ?>
                                                </td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
                                        <tr>
                                            <th>Judul</th>
											<th>Download</th>
											<th>Tanggal Posting</th>
											<th>Aksi</th>
										</tr>
                                    </tfoot>
								</table>								
							</div>
							
						</div>
					</div>
				</div>
            <!-- #END# Basic Alerts -->
		</div>
</section>