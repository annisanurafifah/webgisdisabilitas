<!DOCTYPE html>
<html>
<?php
  $title="Sarana Prasarana";
  $judul=$title;
  $url='sarpras-transportasi';
  if ($session->get('level')!='admin'){
	header("Location: http://localhost/webgis/?halaman=beranda");
  }
  //var_dump($_POST);
if(isset($_POST['simpan'])){
var_dump($_POST);
	if($_POST['id_sarpras_transportasi']==""){
		$data['nama_sarpras_transportasi']=$_POST['nama_sarpras_transportasi'];
        $data['alamat_sarpras_transportasi']=$_POST['alamat_sarpras_transportasi'];
		$data['latitude_sarpras_transportasi']=$_POST['latitude_sarpras_transportasi'];
        $data['longitude_sarpras_transportasi']=$_POST['longitude_sarpras_transportasi'];
		$db->insert('sarpras_transportasi',$data);
		?>
		<script type="text/javascript">
			window.alert('sukses disimpan');
			window.location.href="<?=url('sarpras-transportasi')?>";
		</script>
		<?php
	}
	else{
		$data['nama_sarpras_transportasi']=$_POST['nama_sarpras_transportasi'];
        $data['alamat_sarpras_transportasi']=$_POST['alamat_sarpras_transportasi'];
		$data['latitude_sarpras_transportasi']=$_POST['latitude_sarpras_transportasi'];
        $data['longitude_sarpras_transportasi']=$_POST['longitude_sarpras_transportasi'];
		$db->where('id_sarpras_transportasi',$_POST['id_sarpras_transportasi']);
		$db->update('sarpras_transportasi',$data);
		?>
		<script type="text/javascript">
			window.alert('sukses diubah');
			window.location.href="<?=url('sarpras-transportasi')?>";
		</script>
		<?php
	}
} 

if(isset($_GET['hapus'])){
	$db->where("id_sarpras_transportasi",$_GET['id']);
	$db->delete("sarpras_transportasi");
	?>
	<script type="text/javascript">
			window.alert('sukses dihapus');
			window.location.href="<?=url('sarpras-transportasi')?>";
		</script>
		<?php
}

if(isset($_GET['tambah']) OR isset($_GET['ubah'])){
  $id_sarpras_transportasi="";
  $nama_sarpras_transportasi="";
  $alamat_sarpras_transportasi="";
  $latitude_sarpras_transportasi="";
  $longitude_sarpras_transportasi="";
  if(isset($_GET['ubah']) AND isset($_GET['id'])){
	$id=$_GET['id'];
	$db->where('id_sarpras_transportasi',$id);  
	$row=$db->ObjectBuilder()->getOne('sarpras_transportasi');
	if($db->count>0){
		$id_sarpras_transportasi=$row->id_sarpras_transportasi;
        $nama_sarpras_transportasi=$row->nama_sarpras_transportasi;
		$alamat_sarpras_transportasi=$row->alamat_sarpras_transportasi;
        $latitude_sarpras_transportasi=$row->latitude_sarpras_transportasi;
		$longitude_sarpras_transportasi=$row->longitude_sarpras_transportasi;
	}
  }
?>
<?=content_open('Form Sarana Prasarana (transportasi)')?>
	<form method="post">
		<?=input_hidden('id_sarpras_transportasi',$id_sarpras_transportasi)?>
		<div class="form-group">
			<label>Nama SarPras</label>
			<?=input_text('nama_sarpras_transportasi',$nama_sarpras_transportasi)?>
		</div>
        <div class="form-group">
			<label>Alamat SarPras</label>
			<?=input_text('alamat_sarpras_transportasi',$alamat_sarpras_transportasi)?>
		</div>
		<div class="form-group">
			<label>Latitude SarPras</label>
			<?=input_text('latitude_sarpras_transportasi',$latitude_sarpras_transportasi)?>
		</div>
        <div class="form-group">
			<label>Longitude SarPras</label>
			<?=input_text('longitude_sarpras_transportasi',$longitude_sarpras_transportasi)?>
		</div>
		<div class="form-group">
			<button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			<a href="<?=url($url)?>" class="btn btn-danger"><i class="fa fa-reply"></i> Kembali</a>
		</div>
	</form>
<?=content_close()?>

<?php } else { ?>

<?=content_open('Data Sarana Prasarana Transportasi')?>

<a href="<?=url($url.'&tambah')?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
<hr>

<link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="//cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" />

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>

<script src="//cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" defer></script>
<script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js" defer></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" defer></script>
<script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js" defer></script>

<table id="example" class="display">
    <thead>
        <tr>
            <th style="text-align:center;">No</th>
            <th style="text-align:center;">Nama SarPras</th>
            <th style="text-align:center;">Alamat</th>
			<th style="width:200px; text-align:center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no=1;
            $getdata=$db->ObjectBuilder()->get('sarpras_transportasi');
            foreach ($getdata as $row) {
                ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=$row->nama_sarpras_transportasi?></td>
                        <td><?=$row->alamat_sarpras_transportasi?></td>
                        <td>
							<a href="<?=url($url.'&ubah&id='.$row->id_sarpras_transportasi)?>" class="btn btn-info"><i class="fa fa-edit"></i> Ubah</a>
							<a href="<?=url($url.'&hapus&id='.$row->id_sarpras_transportasi)?>" class="btn btn-danger" onclick="return confirm('Hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
						</td>
                    </tr>
                <?php
                $no++;
            }
        ?>
    </tbody>
</table>
<script>
$(document).ready( function () {
    $('table#example').DataTable({
		dom: 'Bfrtip',
		"paging": true,
		"order": [[ 0, "asc" ]],
		"ordering": true,
		"columnDefs": [{
			"targets": [3], /* column index */
			"orderable": false
		},
		{
			"targets": [ 1 ],
			"visible": true,
			"searchable": true
		}],
		buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
	});
});
</script>
<?=content_close()?>
<?php } ?>
</html>