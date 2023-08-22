<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Home</h2>
        </div>
        <?php if (isset($message)) {
    echo '<div class="alert bg-teal alert-dismissible" role="alert" id="flash-msg">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					'.$message.'
			    </div>';
}?>
    
    <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">face</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL ALUMNI</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"><?php echo $count_alumni; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="info-box-4 hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons col-teal">today</i>
                        </div>
                        <div class="content">
                            <div class="text">HARI & TANGGAL SEKARANG</div>                            
                            <div class="number" id="date"></div>
                            <script>
                                var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                var date = new Date();
                                var weekday = new Array(7);
                                weekday[0] = "Minggu";
                                weekday[1] = "Senin";
                                weekday[2] = "Selasa";
                                weekday[3] = "Rabu";
                                weekday[4] = "Kamis";
                                weekday[5] = "Jum'at";
                                weekday[6] = "Sabtu";

                                var nowadays = weekday[date.getDay()];
                                var day = date.getDate();
                                var month = date.getMonth();
                                var year = date.getFullYear();
                                
                                document.getElementById("date").innerHTML =" " + nowadays + ", " + day + " " + months[month] + " " + year ;
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="info-box-4 hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons col-light-blue">access_time</i>
                        </div>
                        <div class="content">
                            <div class="text">WAKTU SEKARANG</div>                            
                            <div class="number" id="time"></div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Hai, Selamat datang <?php echo humanize($is_user->first_name);?>!
                            </h2>                            
                        </div>
                        <div class="body">
                            <p class="lead">
                                Anda saat ini sedang berada di halaman <i><?php echo humanize($group);?>..</i>
                            </p> 
                            <table class="table">
                            
                            <tr>
                                <td>Nama</td>
                                <td><?php echo humanize($is_user->first_name);?></td>
                            </tr>
                            <!-- <tr>
                                <td>Nim</td>
                                <td>Mexico</td>
                            </tr>
                            <tr>
                                <td>Prodi</td>
                                <td>Mexico</td>
                            </tr>
                            <tr>
                                <td>IPK</td>
                                <td>Mexico</td>
                            </tr> -->
                            
                            </table>
                            
                                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Tentang Kampus 
                            </h2>                            
                        </div>
                        <div class="body">
                            <!-- <p class="lead">
                                Anda saat ini sedang berada di halaman <i><?php echo humanize($group);?>..</i>
                            </p> -->
                            <p>
                            Kawasan Bisnis CBD Ciledug Blok A5 No.29-36, Jl. HOS Cokroaminoto, Karang Tengah, Kota Tangerang, Banten 15157 <br>
                            (021) 5098-6099 <br>
                            0811 939 1441 <br>
                            info@antarbangsa.ac.id
                            </p>  
                            
                            
                                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="card">
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
                                        <td><?php echo htmlspecialchars($row->nim, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row->first_name, ENT_QUOTES, 'UTF-8'); ?>
                                            <?php echo htmlspecialchars($row->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row->jenis_kelamin, ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row->prodi, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row->tempat_lahir, ENT_QUOTES, 'UTF-8'); ?>,
                                            <?php echo indonesian_date($row->tanggal_lahir); ?></td>
                                        <td><?php echo htmlspecialchars($row->no_telp, ENT_QUOTES, 'UTF-8'); ?></td>
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
                                        <th>nim</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Prodi</th>
                                        <th>Tempat & Tanggal Lahir</th>
                                        <th>No Telp</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</section>
    