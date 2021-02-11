<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login - Balai Teknik Penerbangan</title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-reboot.min.css') ?>">

    <!-- Font -->
    <link href="<?= base_url('assets/font/fontsgoogleapis.css') ?>" rel="stylesheet">

    <!-- <script src="<?= base_url('assets/js/jquery-3.2.1.slim.min.js') ?>"></script> -->

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

    <!-- FontAwesome -->
    <script src="<?= base_url('assets/font/fontawesome.js') ?>"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom.css')  ?>">
</head>
<body class="login-page">

    <div class="container">
        <div class="row">
            <div class="col-md-4 d-block m-auto card-login">
                <img src="<?= base_url('assets/images/logo-balai2.png') ?>" width="250px" class="d-block m-auto">
                <hr>
                <div class="text-center">
                    <h6 class="font-weight-medium">LOGIN <br> PORTAL SUKU CADANG <br> BALAI TEKNIK PENERBANGAN</h6>
                    
                </div>

                <?php

                if ($this->session->flashdata('error_message')) {
                    echo $this->session->flashdata('error_message');
                }

                ?>

                <form id="login" class="mt-5" method="post" action="<?= base_url('auth/Validate_login') ?>">
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-fingerprint"></i></div>
                        </div>
                        <input type="number" name="nip" class="form-control nip-input" id="inlineFormInputGroup" placeholder="NIP" value="<?= set_value('nip')?>">
                        <div class="invalid-feedback">
                            <?= form_error('nip'); ?>
                        </div>
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <div class="input-group-text"><i class="fas fa-key"></i></div>
                        </div>
                        <input type="password" name="password" class="form-control" id="inlineFormInputGroup" placeholder="Password">
                        <div class="invalid-feedback">
                            <?= form_error('password'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm btn-block">Login</button>
                </form>
                <div class="text-right mt-2">
                    <a data-toggle="modal" data-target="#forgotPassword" class="forgot-password"> Lupa Password?</a>
                </div>
                <div class="d-block text-sm-center mt-2">
                    <p style="font-size: 12px;">Direktorat Jendral Perhubungan Udara <br> Kementerian Perhubungan RI</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="exampleModalLabel">Lupa Password</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form action="<?= base_url("auth/forgotPassword") ?>" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">NIP</label>
                            <input type="text" id="nip" name="nip" class="form-control">
                            <div id="error-msg"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email Anda</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" required="required">
                        </div>

                        <button type="submit" id="forgotpass" class="btn btn-block btn-success btn-sm mt-4" disabled >Kirim Password Baru</button>
                   </form>
               </div>
           </div>
       </div>
   </div>

    <!-- JS Bootstrap -->
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>

    <script type="text/javascript">
        $('.alert').fadeIn(400).delay(3000).fadeOut(400);

        $(document).ready(function(){
            $("#nip").change(function () {
                var nip = $(this).val();
                    $.ajax({
                        url : "<?= base_url('auth/cek_pegawai/'); ?>"+nip,
                        method : "POST",
                        data : {nip: nip},
                        dataType: "json",
                        success: function(data){
                            if (data.data.status === "true") {
                                var html = `
                                <span class="font-weight-bold" style="font-size:10px; color:green;">
                                NIP Valid
                                </span>`;
                                $('#error-msg').html(html);

                                $('#forgotpass').prop("disabled", false);
                            }else{
                                var html = `
                                <span class="font-weight-bold" style="font-size:10px; color:red;">
                                NIP Tidak Terdaftar
                                </span>`;

                                $('#error-msg').html(html);

                                $('#forgotpass').prop("disabled", true);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(status);
                        }
                    });
            });

        }); 
    </script>

</body>
</html>