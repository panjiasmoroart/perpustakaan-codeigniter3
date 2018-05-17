<?php if($hasil_search->num_rows() > 0) { ?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>No.</td>
            <td>ID Transaksi</td>
            <td>Tanggal Pengembalian</td>
            <td>Denda</td>
            <td>Nominal</td>
            <td>ID Petugas</td>
        </tr>
    </thead>
    <?php $no=0; foreach($hasil_search->result() as $data): $no++;?>
    <tr>
        <td><?php echo $no;?></td>
        <td><a href="#" class="show-kembali" kode="<?php echo $data->id_transaksi; ?>"><?php echo $data->id_transaksi;?></a></td>
        <td><?php echo $data->tgl_pengembalian;?></td>
        <td><?php echo $data->denda;?></td>
        <td><?php echo $data->nominal; ?></td>
        <td><?php echo $data->full_name;?></td>
    </tr>
    <?php endforeach;?>
</table>

<?php }else{ ?>
<p class="text-center"><strong> ~ Maaf Data Belum Tersedia ~ </strong></p>
<?php } ?>