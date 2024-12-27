<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Jadwal</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e('/jadwal-dokter'); ?>">Jadwal Praktek</a></li>
                            <li class="breadcrumb-item active">Tambah Jadwal</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="<?php echo e(route('add-jadwal')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambah Jadwal</h3>
                                </div>
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputNamaDokter1">Nama Dokter</label>
                                            <input type="text" style="width: 100%" id="dokter" name="dokter" value="<?php echo e($dokter->nama); ?>" disabled>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputHari1">Hari</label>
                                            <input type="text" name="hari" class="form-control"
                                                id="exampleInputHari1" placeholder="Hari Praktek">
                                            <?php $__errorArgs = ['hari'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small> <?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputJamMulai1">Jam Mulai</label>
                                            <input type="time" name="jam_mulai" class="form-control"
                                                id="exampleInputJamMulai1" placeholder="Jam Mulai Praktek">
                                            <?php $__errorArgs = ['jam_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small> <?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputJamSelesai1">Jam Selesai</label>
                                            <input type="time" name="jam_selesai" class="form-control"
                                                id="exampleInputJam Selesai1" placeholder="Jam Selesai Praktek">
                                            <?php $__errorArgs = ['jam_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <small> <?php echo e($message); ?></small>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <!--/.col (left) -->
                    </div>
                </form>

            </div>
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.dokter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\poli\resources\views\dokter\create-jadwal.blade.php ENDPATH**/ ?>