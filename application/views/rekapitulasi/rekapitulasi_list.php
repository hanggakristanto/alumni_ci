<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Data Alumni
            </h2>
            <?php if (isset($message)) {
                echo '<div class="alert bg-cyan alert-dismissible" role="alert" id="flash-msg">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                ' . $message . '
                            </div>';
            } ?>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <!-- <a class="btn btn-flat btn-default">IMPORT DATA</a> -->
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <form method="post" enctype="multipart/form-data" action="<?php echo base_url('rekapitulasi/proses') ?>">
                                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                    <input type="file" id="files" name="files" required /> <br>
                                    <p>
                                        <input type="submit" value="Import Data" class="btn btn-lg btn-primary" />
                                        <a class="btn btn-lg btn-primary" href="<?php echo base_url('rekapitulasi/download_template') ?>">Download
                                            Template</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-exportable dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Prodi</th>
                                        <th>Tempat & Tanggal Lahir</th>
                                        <th>No Telp</th>
                                        <th>Tahun Lulus</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($get_all as $row) : ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td>
                                                <?php if ($row->picture != 'default.jpg') : ?>
                                                    <img src="<?php echo base_url('assets/backend/avatar/' . $row->picture) ?>" alt="" height="100" width="100">
                                                <?php else : ?>
                                                    <button type="button" class="btn btn-info btn-lg upload-picture" data-toggle="modal" data-target="#myModal" data-id="<?php echo $row->profil_id ?>">Upload
                                                        Foto</button>
                                            </td>
                                        <?php endif ?>
                                        <td><?php echo htmlspecialchars($row->nisn, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row->first_name, ENT_QUOTES, 'UTF-8'); ?>
                                            <?php echo htmlspecialchars($row->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row->jenis_kelamin, ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row->jr, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row->tempat_lahir, ENT_QUOTES, 'UTF-8'); ?>,
                                            <?php echo indonesian_date($row->tanggal_lahir); ?></td>
                                        <td><?php echo htmlspecialchars($row->no_telp, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row->tahun_lulus, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row->status ?? "active", ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td><?php echo anchor('rekapitulasi/detail/' . $row->id_user, '<button type="button" class="btn btn-primary btn-circle waves-effect waves-circle waves-float">
													<i class="material-icons" data-toggle="tooltip" data-placement="top" title="Detail">list</i>
												</button>'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>nisn</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>jr</th>
                                        <th>Tempat & Tanggal Lahir</th>
                                        <th>No Telp</th>
                                        <th>Tahun Lulus</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>

                            </table>
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Upload Foto</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data" action="<?php echo base_url('rekapitulasi/upload_picture') ?>">
                                                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                                                <input type="hidden" name="id" id="id_upload_picture">
                                                <input type="file" name="picture" required /> <br>
                                                <p>
                                                    <input type="submit" value="Upload Foto" class="btn btn-lg btn-primary" />
                                                </p>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
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