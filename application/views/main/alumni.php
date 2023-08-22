<div class="container">    
	<a class="line"><h4 class="margin h1" data-aos="zoom-out" data-aos-duration="500">Pencarian Data Alumni</h4></a>
		<br/>
		<br/>
		<?php echo form_open('main/lulusan'); ?>
		<?php echo

            form_input('keyword', '', 'placeholder = "Masukkan NIM" class = "form-control" data-aos="zoom-out" data-aos-duration="500" autocomplete="off"');
            
			
		?>
          
		<center>
			<?php echo form_submit('Cari', 'cari', array('class' => 'btn btn-default waves-effect', 'data-aos' => 'zoom-out', 'data-aos-duration' => '500')); ?>
		</center>
		
		<?php echo form_close(); ?>
		<br/>
		<br/>
		<div id="">
		<?php if (isset($message)):
         echo  '<p data-aos="zoom-out" data-aos-duration="500">'.$message.'</p>';
        else:
            echo '
				<div class="table-responsive-vertical shadow-z-1">
				<table id="table" class="table table-hover table-mc-light-blue" data-aos="zoom-out" data-aos-duration="500">					
						
				<thead>
				<tr>
					<th>No</th>
					<th>Foto</th>
					<th>Nama</th>
					<th>NIM</th>
					<th>Jenis Kelamin</th>
					<th>Prodi</th>	
					<th>No. Ijazah</th>
					<th>IPK</th>
					<th>Tanggal Yudisium</th>
					<th>Sk Yudidium</th>
				</tr>
				</thead>
				<tbody>
							
						';
                $i = 1;
                foreach ($_get_keyword as $key) {
                    echo '
					
					<tr>
						<td>'.$i++.'</td>
						<td><img src="' . base_url('assets/backend/avatar/' . $key->picture) . '" alt="" height="100" width="100"></td>
						<td>'.$key->first_name.' '.$key->last_name.'</td>
						<td>'.$key->nim.'</td>
						<td>'.$key->jenis_kelamin.'</td>
						<td>'.$key->prodi.'</td>
						<td>'.$key->no_ijazah.'</td>
						<td>'.$key->ipk.'</td>
						<td>'.$key->th_yudisium.'</td>
						<td>'.$key->sk_yudisium.'</td>
						
					</tr>				
					
					';
                }
                echo '</tbody>
				</table>
				</div>
				';
        endif; ?>
		
		</div>
		
</div>
