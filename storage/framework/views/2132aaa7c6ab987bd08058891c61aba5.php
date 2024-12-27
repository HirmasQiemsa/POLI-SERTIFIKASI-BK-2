<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Poli</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e('/daftar/poli'); ?>">Menu Pasien</a></li>
                            <li class="breadcrumb-item active">Daftar Poli</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="<?php echo e(route('add-daftar-poli')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Poli</h3>
                                </div>
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputNoRM1">No. Rekam Medis</label>
                                            <input type="text" name="no_rm" class="form-control" id="exampleInputNoRM1"
                                                placeholder="No. Rekam Medis" disabled value="<?php echo e($pasien->no_rm); ?>">
                                            <?php $__errorArgs = ['no_rm'];
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
                                            <label for="exampleInputRuangPoli">Ruang Poli</label>
                                            <select id="exampleInputRuangPoli" name="id_poli" style="width: 100%;" required>
                                                <?php $__currentLoopData = $jadwal->unique('dokter.ruangPoli.id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($p->dokter && $p->dokter->ruangPoli): ?>
                                                        <option value="<?php echo e($p->dokter->ruangPoli->id); ?>">
                                                            <?php echo e($p->dokter->ruangPoli->nama_poli); ?>

                                                        </option>
                                                    <?php else: ?>
                                                        <option value="">Dokter atau Ruang Poli tidak ditemukan
                                                        </option>
                                                    <?php endif; ?>
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
                                        <div class="form-group">
                                            <label for="exampleInputPilihJadwal">Pilih Jadwal</label>
                                            <select id="exampleInputPilihJadwal" name="id_jadwal" style="width: 100%;"
                                                required>
                                                <?php $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($j->dokter): ?>
                                                        <option value="<?php echo e($j->id); ?>"
                                                            data-poli-id="<?php echo e($j->dokter->ruangPoli->id); ?>">
                                                            Dokter <?php echo e($j->dokter->nama); ?> | Hari <?php echo e($j->hari); ?> |
                                                            <?php echo e(\Carbon\Carbon::parse($j->jam_mulai)->format('H:i')); ?> -
                                                            <?php echo e(\Carbon\Carbon::parse($j->jam_selesai)->format('H:i')); ?> WIB
                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['id_jadwal'];
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
                                            <label for="exampleInputKeluhan1">Keluhan</label>
                                            <textarea type="text" name="keluhan" class="form-control" id="exampleInputKeluhan1"
                                                placeholder="Keluhan Yang Dirasakan"></textarea>
                                            <?php $__errorArgs = ['keluhan'];
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

        
        <script>
            document.getElementById('exampleInputRuangPoli').addEventListener('change', function() {
                var poliId = this.value;
                var jadwalSelect = document.getElementById('exampleInputPilihJadwal');
                var jadwalOptions = jadwalSelect.getElementsByTagName('option');

                jadwalSelect.value = ''; // Reset pilihan jadwal

                for (var i = 0; i < jadwalOptions.length; i++) {
                    var option = jadwalOptions[i];
                    option.style.display = option.getAttribute('data-poli-id') == poliId ? '' : 'none';
                }

                for (var i = 0; i < jadwalOptions.length; i++) {
                    if (jadwalOptions[i].style.display !== 'none') {
                        jadwalOptions[i].selected = true;
                        break;
                    }
                }
            });

            // **Perubahan baru: Penanganan opsi awal saat halaman pertama kali dimuat**
            window.addEventListener('load', function() { var initialPoliId = document.getElementById('exampleInputRuangPoli').value; var jadwalSelect = document.getElementById('exampleInputPilihJadwal'); var jadwalOptions = jadwalSelect.getElementsByTagName('option'); for (var i = 0; i < jadwalOptions.length; i++) { var option = jadwalOptions[i]; if (option.getAttribute('data-poli-id') == initialPoliId) { option.style.display = ''; option.disabled = false; } else { option.style.display = 'none'; option.disabled = true; } } });
            window.addEventListener('load', function() {
                var initialPoliId = document.getElementById('exampleInputRuangPoli').value;
                var jadwalSelect = document.getElementById('exampleInputPilihJadwal');
                var jadwalOptions = jadwalSelect.getElementsByTagName('option');

                for (var i = 0; i < jadwalOptions.length; i++) {
                    var option = jadwalOptions[i];
                    option.style.display = option.getAttribute('data-poli-id') == initialPoliId ? '' : 'none';
                }
                // **Perubahan baru: Aktifkan kembali select jika ada opsi yang relevan**
                for (var i = 0; i < jadwalOptions.length; i++) {
                    if (jadwalOptions[i].style.display !== 'none') {
                        jadwalOptions[i].selected = true;
                        break;
                    }
                }
            });
        </script>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('components.pasien', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\poli\resources\views/pasien/daftar-poli.blade.php ENDPATH**/ ?>