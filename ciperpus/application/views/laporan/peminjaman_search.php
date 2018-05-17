<?php if($hasil_search->num_rows() > 0) { ?>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>No.</td>
            <td>ID Transaksi</td>
            <td>Tanggal Pinjam</td>
            <td>Tanggal Kembali</td>
            <td>Status</td>
            <td>Nis</td>
        </tr>
    </thead>
    <?php $no=0; foreach($hasil_search->result() as $row): $no++;?>
    <tr>
        <td><?php echo $no;?></td>
        <td><a class="show-modal" kode="<?php echo $row->id_transaksi ?>" href="#"><?php echo $row->id_transaksi;?></a></td>
        <td><?php echo $row->tanggal_pinjam;?></td>
        <td><?php echo $row->tanggal_kembali;?></td>
        <td><?php echo $row->status_pinjam; ?></td>
        <td><?php echo $row->nis;?></td>
    </tr>
    <?php endforeach;?>
</table>

<?php }else{ ?>
<p class="text-center"><strong> ~ Maaf Data Belum Tersedia ~ </strong></p>
<?php } ?>