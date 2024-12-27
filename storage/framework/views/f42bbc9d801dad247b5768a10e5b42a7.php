<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hasil Pemeriksaan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard-pasien')); ?>">Pasien</a></li>
                            <li class="breadcrumb-item active">Hasil Pemeriksaan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- /.List History Obat -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Riwayat Hasil Pemeriksaan</h3>
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
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Poli</th>
                                            <th>Dokter</th>
                                            <th>Hari Pratek</th>
                                            <th>Antrian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($d->jadwalPeriksa->dokter->ruangPoli->nama_poli); ?></td>
                                                <td><?php echo e($d->jadwalPeriksa->dokter->nama); ?></td>
                                                <td><?php echo e($d->jadwalPeriksa->hari); ?></td>
                                                <td><?php echo e($d->no_antrian); ?></td>
                                                <td>
                                                    <?php
                                                        $showEdit = $d->periksa
                                                            ->pluck('detailPeriksa')
                                                            ->flatten()
                                                            ->isNotEmpty();
                                                    ?>

                                                    <?php if($showEdit): ?>
                                                        <a href="#" class="btn btn-success">
                                                            <i class="fas fa-tags"></i> Riwayat
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="#" class="badge bg-warning">
                                                            Belum Diperiksa
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
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

<?php echo $__env->make('components.pasien', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\poli\resources\views\pasien\hasil-periksa.blade.php ENDPATH**/ ?>