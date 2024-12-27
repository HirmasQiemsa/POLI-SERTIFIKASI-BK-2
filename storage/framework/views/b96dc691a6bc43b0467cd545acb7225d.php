<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Jadwal Praktek</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard-dokter')); ?>">Dokter</a></li>
                            <li class="breadcrumb-item active">Jadwal Praktek</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.List History Poli -->
                <div class="row">
                    <a href="<?php echo e(route('create-jadwal')); ?>" class="btn btn-primary mb-3 ml-3">Tambahkan Jadwal</a>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Jadwal Praktek</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-boredered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokter</th>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($j->dokter->nama); ?></td>
                                                <td><?php echo e($j->hari); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($j->jam_mulai)->format('H:i')); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($j->jam_selesai)->format('H:i')); ?></td>
                                                <td>
                                                    <form action="<?php echo e(route('toggle-jadwal', $j->id)); ?>" method="POST"
                                                        style="display:inline;"> <?php echo csrf_field(); ?>
                                                        <div
                                                            class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input"
                                                                id="customSwitch<?php echo e($j->id); ?>" name="aktif"
                                                                onchange="this.form.submit()"
                                                                <?php echo e($j->trashed() ? '' : 'checked'); ?>>
                                                                <label
                                                                class="custom-control-label"
                                                                for="customSwitch<?php echo e($j->id); ?>">
                                                            </label>
                                                                <span><?php echo e($j->trashed() ? 'Tidak Aktif' : 'Aktif'); ?></span>
                                                        </div>
                                                    </form>
                                                </td>
                                                
                                            </tr>
                                            <!-- /.modal -->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.dokter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\poli\resources\views/dokter/jadwal.blade.php ENDPATH**/ ?>