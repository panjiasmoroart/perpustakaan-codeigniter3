<div class="row">
    <div class="col-lg-12"><br />
       
        <ol class="breadcrumb">
            <li><a  href="<?php echo base_url('pengembalian'); ?>">Transaksi</a></li>
            <li class="active">Pengembalian</li>
        </ol>

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $title;?>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-lg-3 ">No. Transaksi</label>
                            <div class="col-lg-5">
                                <input type="text" name="no_transaksi" id="no_transaksi" class="form-control">
                                <span class="text-danger">*) tekan enter</span>
                            </div>
                            
                            <div class="col-lg-2">
                                <a href="#" class="btn btn-success" id="cari_nis"> Search &nbsp;<i class="glyphicon glyphicon-search"></i>&nbsp;</a>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 ">Tgl. Pinjam</label>
                            <div class="col-lg-8">
                                <input type="text" name="tgl_pinjam" id="tgl_pinjam" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-3 ">Tgl. Kembali</label>
                            <div class="col-lg-8">
                                <input type="text" name="tgl_kembali" id="tgl_kembali" class="form-control" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-lg-4 ">Nis</label>
                            <div class="col-lg-8">
                                <input type="text" name="nis" id="nis" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-4 ">Nama</label>
                            <div class="col-lg-8">
                                <input type="text" name="nama" id="nama" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-4 ">Denda</label>
                            <div class="col-lg-8">
                                <select name="denda" id="denda" class="form-control">
                                    <option></option>
                                    <option value="Y">Y</option>
                                    <option value="N">N</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-4 ">Nominal</label>
                            <div class="col-lg-8">
                                <input type="text" name="nominal" id="nominal" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>

            <!-- tampil buku -->
            <div id="tampilbuku"></div>
            <!-- end tampil buku -->
            
            </div>
            
            
            
            <div class="panel-footer">
                <button id="simpan_transaksi" class="btn btn-primary"><i class="glyphicon glyphicon-saved"></i> Simpan</button>
            </div>
        </div><!-- end panel -->

    </div> <!-- end lg -->
</div> <!-- end row -->



 

<!-- Modal Cari Buku -->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><strong>Transaksi Pengembalian</strong></h4>
        </div>
        <div class="modal-body"><br />
            <!--<label class="col-lg-4 control-label">Cari Nama Nasabah</label>-->
            <input type="text" name="carinis" id="carinis" class="form-control" placeholder="please search nis member">

            <div id="tampilnis"></div>

        </div>

        <br /><br />
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary" id="konfirmasi">Hapus</button>-->
        </div>
    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End Modal Cari Buku -->





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

    //show modal nis
    $("#cari_nis").click(function(){
        $("#myModal3").modal("show");
    });

    //cari by nis
    $("#carinis").keyup(function(){
        var nis = $("#carinis").val();
        
        $.ajax({
            url:"<?php echo site_url('pengembalian/cari_nis');?>",
            type:"POST",
            data:"nis="+nis,
            cache:false,
            success:function(hasil){
                // console.log(hasil);
                $("#tampilnis").html(hasil);
            }
        })
    })


    //tambahkan data dari modal ke form berdasarkan id_transaksi
    $('body').on('click', '.tambahkan', function(){

        var id_transaksi = $(this).attr("no_transaksi");
        // console.log(id_transaksi);
        $("#no_transaksi").val(id_transaksi);
        $("#myModal3").modal("hide");
        $("#no_transaksi").focus();

    });
    

    

    //keypress no_transaksi
    $("#no_transaksi").keypress(function(){

        if(event.which == 13) {

            var no_transaksi = $("#no_transaksi").val();
            
            $.ajax({
                url:"<?php echo site_url('pengembalian/cari_transaksi');?>",
                type:"POST",
                data:"no_transaksi="+no_transaksi,
                cache:false,
                success:function(hasil){
                //split digunakan untuk memecah string    
                  
                   if(hasil=="") {
                       alert("Data tidak ditemukan");
                   }
                   else{
                    //    console.log(hasil);
                       data = hasil.split("|");
                       $("#nis").val(data[0]);  
                       $("#tgl_pinjam").val(data[1]);
                       $("#tgl_kembali").val(data[2]);
                       $("#nama").val(data[3]); 

                       $("#denda").attr("disabled", false);
                       $("#denda").focus();

                       $("#tampilbuku").load("<?php echo site_url('pengembalian/tampil_buku') ?>",
                       "no_transaksi="+no_transaksi);
                   }

                   //console.log(data);
                }
            }) //end ajax

        } //end event

    }) //end keypress

    //buat disable denda dan nominal sebagai nilai default
    $("#nominal").attr("disabled",true);
    $("#denda").attr("disabled",true);

    //disable enabled combobox
    $("#denda").click(function(){
        var denda = $("#denda").val();
        if(denda == "Y") {
            $("#nominal").attr("disabled", false);
           
        }
        else{
            $("#nominal").attr("disabled", true);
            
        }

    });

    $("#simpan_transaksi").click(function(){

        var no_transaksi = $("#no_transaksi").val();
        var nis          = $("#nis").val();  
        var denda        = $("#denda").val();
        var nominal      = parseInt($("#nominal").val());
        var nominal2     = $("#nominal").val();

        if(no_transaksi == "" || nis == ""){
            alert("Pilih ID Transaksi");
            $("#no_transaksi").focus();
            return false;
        }
        else if(denda == ""){
            alert("Pilih Denda");
            $("#denda").focus();
            return false;
        }
        else if(denda == "Y"){
            
            if(nominal2 == "") {
                alert("Masukan nominal denda");
                $("#nominal").focus();
                return false;
            }   
            //kalau sudah lengkap lakukan insert ke database 
            else{
                $.ajax({
                    url:"<?php echo site_url('pengembalian/simpan_transaksi');?>",
                    type:"POST",
                    data:"no_transaksi="+no_transaksi+"&denda="+denda+"&nominal="+nominal,
                    cache:false,
                    success:function(){
                        alert("Transaksi berhasil disimpan");
                        location.reload();
                    }
                })//end ajax
            }
        }
        else {
            $.ajax({
                url:"<?php echo site_url('pengembalian/simpan_transaksi');?>",
                type:"POST",
                data:"no_transaksi="+no_transaksi+"&denda="+denda+"&nominal="+nominal,
                cache:false,
                success:function(){
                    alert("Transaksi berhasil disimpan");
                    location.reload();
                }
            })//end ajax
        }
       
     

    }) //end simpan_transaksai

    

    
   


  

});
</script>



