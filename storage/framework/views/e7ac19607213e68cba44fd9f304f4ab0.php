<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Dokter - Poli</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('lte/dist/css/adminlte.min.css')); ?>">
</head>

<body class="hold-transition login-page">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?php echo e(asset('img/logo_udinus_circle.png')); ?>" alt="AdminLTELogo"
            height="120" width="120">
    </div>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo e(url('/')); ?>" class="h1"><b>LOGIN Dokter</b></a>
            </div>
            <div class="card-body">
                <h2 class="login-box-msg">UDINUS Poli Klinik</h2>

                <form action="<?php echo e(route('login-proses-dokter')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mt-3">
                        <input type="text" name="nama" class="form-control" placeholder="Username Dokter">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <div class="input-group mt-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <div class="row mt-3">
                        <button type="submit" class="btn btn-primary btn-block" style="width: 100%">Login</button>

                        <!-- /.col -->
                        
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo e(asset('lte/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('lte/dist/js/adminlte.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('lte/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if($message = Session::get('succes')): ?>
        <script>
            Swal.fire('<?php echo e($message); ?>');
        </script>
    <?php endif; ?>
    <?php if($message = Session::get('failed')): ?>
        <script>
            Swal.fire('<?php echo e($message); ?>');
        </script>
    <?php endif; ?>
</body>

</html>
<?php /**PATH C:\laragon\www\poli\resources\views\dokter\login.blade.php ENDPATH**/ ?>