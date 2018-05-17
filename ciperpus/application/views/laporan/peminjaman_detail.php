<!--
<div class="row">
    <div class="col-lg-12"><br />
       
        <ol class="breadcrumb">
            <li><a  href="">Laporan</a></li>
            <li class="active">Detail Peminjaman</li>
        </ol>

    </div>
</div> --> <!-- /.col-lg-12 -->
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $title;?>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-3">ID Transaksi</label>
                            <div class="col-lg-5">
                                : <?php echo $pinjam['id_transaksi'];?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3">Tanggal Pinjam</label>
                            <div class="col-lg-5">
                                : <?php echo $pinjam['tanggal_pinjam'];?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3">NIS</label>
                            <div class="col-lg-5">
                                : <?php echo $pinjam['nis'];?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3">Status</label>
                            <div class="col-lg-5">
                                : <?php echo $pinjam['status_pinjam'];?>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>Kode Buku</td>
                            <td>Judul Buku</td>
                            <td>Pengarang</td>
                        </tr>
                    </thead>
                    <?php foreach($detailpinjam as $row):?>
                    <tr>
                        <td><?php echo $row->kode_buku;?></td>
                        <td><?php echo $row->judul;?></td>
                        <td><?php echo $row->pengarang;?></td>
                    </tr>
                    <?php endforeach;?>
                </table>

                <!-- <p class="text-right">
                <a href="" ><button  class="btn btn-primary"> Kembali</button></a></p> -->
            </div> <!-- end panel body -->
        
        </div><!-- end panel -->

    </div> <!-- end lg -->
</div> <!-- end row -->



<!-- jQuery -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/bootstrap/js/bootstrap.min.js"></script>



<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>template/backend/sbadmin/vendor/datatables-responsive/dataTables.responsive.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>template/backend/sbadmin/dist/js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {

    //alert('');

    //load datatable
    $('#dataTables-example').DataTable({
        responsive: true
    });


   


    
    

}); //end document
</script>



