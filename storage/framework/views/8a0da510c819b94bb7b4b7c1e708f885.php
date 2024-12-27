<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Periksa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e('/periksa-pasien'); ?>">Pemeriksaan Pasien</a></li>
                            <li class="breadcrumb-item active">Periksa</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="<?php echo e(route('add-periksa')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Pasien </h3>
                                </div>
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <input type="hidden" name="no_antrian" value="<?php echo e($periksa->no_antrian); ?>">
                                        <div class="form-group">
                                            <label for="exampleInputNama">Nama Pasien</label>
                                            <input type="text" name="nama" class="form-control" id="exampleInputNama"
                                                placeholder="Nama Pasien" disabled value="<?php echo e($periksa->pasien->nama); ?>">
                                            <?php $__errorArgs = ['nama'];
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
                                            <label for="exampleInputTglPeriksa1">Tanggal Periksa</label>
                                            <input type="date" name="tgl_periksa" class="form-control"
                                                id="exampleInputTglPeriksa1" placeholder="Tanggal Periksa">
                                            <?php $__errorArgs = ['tgl_periksa'];
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
                                            <label for="exampleInputCatatan">Catatan</label>
                                            <textarea type="text" name="catatan" class="form-control" id="exampleInputCatatan" placeholder="Catatan untuk Pasien"
                                                required></textarea>
                                            <?php $__errorArgs = ['catatan'];
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
                                            <label for="exampleInputRuangPoli">Obat</label>
                                            <select id="exampleInputRuangPoli" name="obat_ids[]" style="width: 100%;" multiple>
                                                <?php $__currentLoopData = $obat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($o->id); ?>" data-harga="<?php echo e($o->harga); ?>"><?php echo e($o->nama_obat); ?> || <?php echo e($o->kemasan); ?> || Rp.<?php echo e($o->harga); ?>,00</option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['id_poli'];
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
                                        <div id="selectedObat" class="form-group">
                                            <label>Obat yang Dipilih: </label>
                                            <div id="obatList"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTotalHarga">Total Harga</label>
                                            <input type="text" name="biaya_periksa" class="form-control" id="exampleInputTotalHarga" placeholder="Total Harga Berobat" value="Rp.<?php echo e(number_format($periksa->biaya_periksa, 0, ',', '.')); ?>,00" disabled>
                                            <input type="hidden" name="biaya_periksa" id="hiddenBiayaPeriksa" value="<?php echo e($periksa->biaya_periksa); ?>">
                                            <?php $__errorArgs = ['biaya_periksa'];
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
    
    <script>
        document.getElementById('exampleInputRuangPoli').addEventListener('change', function() {
            var selectedObat = Array.from(this.selectedOptions);
            var obatList = selectedObat.map(option => option.text).join('<br>');
            document.getElementById('obatList').innerHTML = obatList;

            var totalHarga = 150000; // Harga dasar
            selectedObat.forEach(option => {
                var harga = parseInt(option.getAttribute('data-harga'));
                if (!isNaN(harga)) {
                    totalHarga += harga;
                }
            });
            document.getElementById('exampleInputTotalHarga').value = 'Rp.' + totalHarga + ',00';
            document.getElementById('hiddenBiayaPeriksa').value = totalHarga;
        });
        </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.dokter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\poli\resources\views\dokter\create-periksa.blade.php ENDPATH**/ ?>