<?php include 'includes/menuinputsiswa.php'; ?>

<div class="card">
    <div class="card-header">
        Form Input Siswa
    </div>
    <div class="card-body">
        <form action="simpansiswa.php" method="post" enctype="multipart/form-data">
            <div class="col mb-3">
                <label for="namasiswa">Nama Siswa: </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                    <input type="text" name="namasiswa" id="namasiswa" class="form-control" required>
                </div>
            </div>
            <div class="col mb-3">
                <label for="tempatlahir">Tempat Lahir: </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map"></i></span>
                    <input type="text" name="tempatlahir" id="tempatlahir" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal Lahir:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label for="kelas">Kelas: </label>
                    <select name="kelas" id="kelas" class="form-control" style="width: 100%;">
                        <option value="">Pilih kelas</option>
                        <?php
                        for ($i = 1; $i <= 6; $i++) {
                            echo "<option value=\"$i\">Kelas $i</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="nis">Nomor Induk Siswa (NIS) :</label>
                    <input type="number" name="nis" id="nis" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian:</label>
                <select class="form-control select2" id="kompetensi_keahlian" name="kompetensi_keahlian[]" multiple="multiple" style="width: 100%;">
                    <!-- Optionnya bisa di-generate dari database atau statis -->
                    <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                    <option value="Teknik Otomotif">Teknik Otomotif</option>
                    <option value="Teknik Elektronika Industri">Teknik Elektronika Industri</option>
                    <!-- Option lainnya -->
                </select>
            </div>
            <div class="col mb-3">
                <label for="alamat">Alamat Siswa:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-clipboard-list"></i></span>
                    <textarea name="alamat" id="alamat" cols="5" rows="5" placeholder="Alamat Siswa...." class="form-control" required></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label for="golongan_darah">Golongan Darah: </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-tint"></i></span>
                    <select name="golongan_darah" id="golongan_darah" class="form-control">
                        <option value="">Pilih Golongan Darah</option>
                        <?php
                        $golongan_darah = ['A', 'B', 'AB', 'O'];
                        foreach ($golongan_darah as $golongan) {
                            echo "<option value=\"$golongan\">$golongan</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="nama_orangtua" class="form-label">Nama Orangtua/Wali:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                    <input type="text" name="nama_orangtua" id="nama_orangtua" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat_orangtua" class="form-label">Alamat Orangtua/Wali:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                    <textarea name="alamat_orangtua" id="alamat_orangtua" class="form-control" rows="3" required></textarea>
                </div>
            </div>

            <div class="mb-3">
                <label for="catatan_kesehatan" class="form-label">Catatan Kesehatan:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-notes-medical"></i></span>
                    <textarea name="catatan_kesehatan" id="catatan_kesehatan" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="mb-3">
                <label for="foto_siswa" class="form-label">Upload Foto:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                    <input type="file" name="foto_siswa" id="foto_siswa" class="form-control" accept="image/*" required>
                </div>
                <img id="preview" src="#" alt="Preview Image" style="display: none; max-width: 200px; margin-top: 10px;"><br><br>
                <button type="button" id="removeImage" class="btn btn-danger" style="display: none;">Hapus Gambar</button>
            </div><br><br><br><br>
            <div class="mb-3" align="center">
                <button type="submit" class="btn btn-info"><i class="fas fa-paper-plane"></i> Submit</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-power-off"> Reset</i></button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/scriptmenusiswa.php'; ?>
<script>
document.getElementById('foto_siswa').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('preview').src = URL.createObjectURL(file);
        document.getElementById('preview').style.display = 'block';
        document.getElementById('removeImage').style.display = 'block';
    }
};

document.getElementById('removeImage').onclick = function () {
    document.getElementById('foto_siswa').value = '';
    document.getElementById('preview').src = '#';
    document.getElementById('preview').style.display = 'none';
    document.getElementById('removeImage').style.display = 'none';
};

$(document).ready(function() {
    $('.select2').select2();
});

</script>
