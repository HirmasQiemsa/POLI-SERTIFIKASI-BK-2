<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kelola Obat</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('admindashboard')); ?>">Admin</a></li>
                            <li class="breadcrumb-item active">Kelola Obat</li>
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
                    <a href="<?php echo e(route('adminobat.create')); ?>" class="btn btn-primary mb-3">Tambahkan Data</a>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Obat Terdaftar Saat Ini</h3>

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
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Jenis Kemasan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($d->nama_obat); ?></td>
                                                <td><?php echo e($d->kemasan); ?></td>
                                                <td><?php echo e($d->harga); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('adminobat.edit', ['id' => $d->id])); ?>"
                                                        class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a>
                                                    <a data-toggle="modal" data-target="#modal-default<?php echo e($d->id); ?>"
                                                        class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="modal-default<?php echo e($d->id); ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Konfirmasi Penghapusan Obat</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Kamu Yakin Ingin Menghapus<b> <?php echo e($d->nama_obat); ?></b>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer ">
                                                            <form action="<?php echo e(route('adminobat.delete', ['id' => $d->id])); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="button" class="btn btn-default"
                                                                    data-dismiss="modal">Kembali</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
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

<?php echo $__env->make('components.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\poli\resources\views\pasien\obat.blade.php ENDPATH**/ ?>