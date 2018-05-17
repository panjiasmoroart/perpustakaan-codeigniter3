<div class="row">
    <div class="col-lg-12"><br />
       
        <ol class="breadcrumb">
            <li><a  href="<?php echo base_url('peminjaman'); ?>">Transaksi</a></li>
            <li class="active">Peminjaman</li>
        </ol>

        <?php
            
            if(!empty($message)) {
                echo $message;
            }
        ?>

    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        
    <!-- <legend>Transaksi</legend> -->
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" action="<?php echo site_url('peminjaman/simpan');?>" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-lg-4 ">No. Transaksi</label>
                            <div class="col-lg-7">
                                <input type="text" id="no_transaksi" name="no_transaksi" class="form-control" value="<?php echo $autonumber ?>" readonly="readonly">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-4 ">Tgl Pinjam</label>
                            <div class="col-lg-7">
                                <input type="text" id="tgl_pinjam" name="tgl_pinjam" class="form-control" value="<?php 
                                echo $tglpinjam; ?>" readonly="readonly">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-4 ">Tgl Kembali</label>
                            <div class="col-lg-7">
                                <input type="text" id="tgl_kembali" name="tgl_kembali" class="form-control" value="<?php echo $tglkembali; ?>" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-lg-4 ">Nis</label>
                            <div class="col-lg-7">
                                <select name="nis" class="form-control" id="nis">
                                    <option> </option>
                                    <?php foreach($anggota as $da): ?> 
                                    <option  value="<?php echo $da->nis ?>"><?php echo $da->nis ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-4 ">Nama Siswa</label>
                            <div class="col-lg-7">
                                <input type="text" name="nama" id="nama" class="form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- data buku -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Data Buku</strong>
            </div>
            
            <div class="panel-body">
                <div class="form-inline">
                    <div class="form-group">
                        <label>Kode Buku</label>
                        <input type="text" class="form-control"  id="kode_buku" >
                    </div>
                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input type="text" class="form-control"  id="judul" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label >Pengarang</label>
                        <input type="text" class="form-control"  id="pengarang" readonly="readonly">
                    </div>
                    <div class="form-group ">
                        <label class="sr-only">Pengarang</label>
                        <button id="tambah_buku" class="btn btn-primary"> Add Book <i class="glyphicon glyphicon-plus"></i></button>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Pengarang</label>
                        <button id="cari" class="btn btn-success"> Search Book <i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
                <br /><br />

                <!-- buat tampil tabel tmp     -->
                <div id="tampil"></div>
            </div>
            
            
            
            <div class="panel-footer">
                <button id="simpan" class="btn btn-primary"><i class="glyphicon glyphicon-hdd"></i> Simpan</button>
            </div>
        </div>
        <!-- end data buku -->

        
    </div>
    <!-- /.col-lg-12 -->

</div>
<!-- /.end row -->

 

<!-- Modal Cari Buku -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><strong>Search Book</strong></h4>
        </div>
        <div class="modal-body"><br />
            <!--<label class="col-lg-4 control-label">Cari Nama Nasabah</label>-->
            <input type="text" name="caribuku" id="caribuku" class="form-control" placeholder="please search book code">

            <div id="tampilbuku"></div>

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

    $('#dataTables-example').DataTable({
        responsive: true
    });


    //load data tmp 
    function loadData()
    {
        $("#tampil").load("<?php echo site_url('peminjaman/tampil_tmp') ?>");
    }
    loadData();

    //function buat mengkosong form data buku setelah di tambah ke tmp
    function EmptyData()
    {
        $("#kode_buku").val("");
        $("#judul").val("");
        $("#pengarang").val("");
    }

    //ambil data anggota berdasarkan nis
    // $("#nis").click(function(){
    $("#nis").change(function(){    
        var nis = $("#nis").val();
        
        $.ajax({
            url:"<?php echo site_url('peminjaman/cari_anggota');?>",
            type:"POST",
            data:"nis="+nis,
            cache:false,
            success:function(html){
                $("#nama").val(html);
                // document.write(html)
            }
        })
        
    });

    //show modal search buku
    $("#cari").click(function(){
        $("#myModal2").modal("show");
        //return false;  biar gk langsung ilang
    })

    //search buku
    $("#caribuku").keyup(function(){
        var caribuku = $('#caribuku').val();

         $.ajax({
            url:"<?php echo site_url('peminjaman/cari_buku');?>",
            type:"POST",
            data:"caribuku="+caribuku,
            cache:false,
            success:function(hasil){
                $("#tampilbuku").html(hasil);
                
            }
        })
        
    })


    //tambah buku dari modal ke form
    
    // $(".tambah").live("click", function(){
    $('body').on('click', '.tambah', function(){
        
        var kode_buku = $(this).attr("kode");
        var judul     = $(this).attr("judul");
        var pengarang = $(this).attr("pengarang");
        
        $("#kode_buku").val(kode_buku);
        $("#judul").val(judul);
        $("#pengarang").val(pengarang);

        $("#myModal2").modal("hide");
        //console.log(kode_buku);
       
    });


    //event keypress cari kode
    $("#kode_buku").keypress(function(){
        
        //13 adalah kode asci buat enter
        if(event.which == 13) {
            var kode_buku = $("#kode_buku").val();

            $.ajax({
                url:"<?php echo site_url('peminjaman/cari_kode_buku');?>",
                type:"POST",
                data:"kode_buku="+kode_buku,
                cache:false,
                success:function(hasil){
                //split digunakan untuk memecah string    
                   data = hasil.split("|");
                   if(data==0) {
                       alert("Buku " + kode_buku + " Book Not Found");
                       $("#judul").val("");
                       $("#pengarang").val("");
                   }
                   else{
                       $("#judul").val(data[0]);
                       $("#pengarang").val(data[1]);
                       $("#tambah_buku").focus();
                   }

                   //console.log(data);
                }
            })
            
        } 

    }) //end event keypress

    //tambah_buku ke tmp
    $("#tambah_buku").click(function(){
        
        var kode_buku = $("#kode_buku").val();
        var judul     = $("#judul").val();
        var pengarang = $("#pengarang").val();

        if(kode_buku == "") {
            alert("Kode " + kode_buku + " Masih Kosong ");
            $("#kode_buku").focus();
            return false;
        }
        else if(judul == ""){
            alert("Judul " + judul + " Masih Kosong ");
            return false;
        }
        else{
            $.ajax({
                url:"<?php echo site_url('peminjaman/save_tmp');?>",
                type:"POST",
                data:"kode_buku="+kode_buku+"&judul="+judul+"&pengarang="+pengarang,
                cache:false,
                success:function(hasil){
                    loadData();
                    EmptyData();
                    //alert(hasil);
                   //console.log(data);
                }
            })
        }

    }) //end tambahbuku 

    // //delete tabel tmp
    $('body').on('click', '.hapus', function(){
        
        //ambil dulu atribute kodenya
        var kode_buku = $(this).attr('kode');
        $.ajax({
            url:"<?php echo site_url('peminjaman/hapus_tmp');?>",
            type:"POST",
            data:"kode_buku="+kode_buku,
            cache:false,
            success:function(hasil){
                // alert(hasil);
                loadData();
            }
        })
        

    }); //end delete table tmp

    //simpan transaksi 
    //$("#simpan").click(function(){
    $('body').on('click', '#simpan', function(){    
        
        //tampung data dari form buat dikirim 
        var no_transaksi = $("#no_transaksi").val();
        var tgl_pinjam   = $("#tgl_pinjam").val();
        var tgl_kembali  = $("#tgl_kembali").val();
        var nis          = $("#nis").val();

        var jumlah_tmp   = parseInt($("#jumlahTmp").val(), 10);

        //cek nis jika kosong 
        if(nis == "") {
            alert("Pilih Nis Siswa");
            $("#nis").focus();
            return false;
        }
        else if(jumlah_tmp == 0){
            alert("Pilih Buku yang di pinjam");
            return false;
        }
        else{
            $.ajax({
                url:"<?php echo site_url('peminjaman/simpan_transaksi');?>",
                type:"POST",
                data:"no_transaksi="+no_transaksi+"&tgl_pinjam="+tgl_pinjam+"&tgl_kembali="+tgl_kembali+
                "&nis="+nis+"&jumlah_tmp="+jumlah_tmp,
                cache:false,
                success:function(hasil){
                  //console.log(hasil);
                 
                  alert("Transaksi Peminjaman Berhasil");
                  
                  location.reload();
                }
            })
        }
        
    })


  

});
</script>



