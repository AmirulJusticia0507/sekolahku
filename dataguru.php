<?php include 'includes/menuinputguru.php'; ?>


<div class="card">
    <div class="card-header">
        Form Input Guru
    </div>
    <div class="card-body">
        <form action="simpanguru.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nip">NIP/NIK:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    <input type="number" class="form-control" id="nip" name="nip" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="nama">Nama Guru:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir">Tempat Lahir:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                </div>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir">Tanggal Lahir:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                </div>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat">Alamat:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                </div>
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="mb-3">
                <label for="no_telepon">Nomor Telepon:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                </div>
            </div>
            <div class="mb-3">
                <label for="status_id" class="form-label">Status Guru:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                    <select class="form-control" id="status_id" name="status_id">
                        <?php
                        // Query untuk mengambil semua status guru dari tabel status_guru
                        $query_status = "SELECT * FROM status_guru";
                        $result_status = $koneklocalhost->query($query_status);

                        // Periksa apakah query berhasil dijalankan
                        if ($result_status->num_rows > 0) {
                            // Tampilkan opsi status guru
                            while ($row_status = $result_status->fetch_assoc()) {
                                echo "<option value='" . $row_status['id'] . "'>" . $row_status['nama'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="jabatan_id" class="form-label">Jabatan Guru:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                    <select class="form-control" id="jabatan_id" name="jabatan_id">
                        <?php
                        // Query untuk mengambil semua jabatan guru dari tabel jabatan_guru
                        $query_jabatan = "SELECT * FROM jabatan_guru";
                        $result_jabatan = $koneklocalhost->query($query_jabatan);

                        // Periksa apakah query berhasil dijalankan
                        if ($result_jabatan->num_rows > 0) {
                            // Tampilkan opsi jabatan guru
                            while ($row_jabatan = $result_jabatan->fetch_assoc()) {
                                echo "<option value='" . $row_jabatan['id'] . "'>" . $row_jabatan['nama'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- <div class="mb-3">
                <label for="jabatan_id" class="form-label">Jabatan Guru:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                    <input type="text" class="form-control" id="autocomplete-jabatan" name="jabatan_id" autocomplete="off">
                </div>
            </div> -->
            <div class="mb-3">
                <label for="foto_guru" class="form-label">Upload Foto:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                    <input type="file" name="foto_guru" id="foto_guru" class="form-control" accept="image/*" required max_file_size="1048576">
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

<?php include 'includes/scriptmenuguru.php'; ?>
<script>
    document.getElementById('foto_guru').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('preview').src = URL.createObjectURL(file);
        document.getElementById('preview').style.display = 'block';
        document.getElementById('removeImage').style.display = 'block';
    }
};

document.getElementById('removeImage').onclick = function () {
    document.getElementById('foto_guru').value = '';
    document.getElementById('preview').src = '#';
    document.getElementById('preview').style.display = 'none';
    document.getElementById('removeImage').style.display = 'none';
};
</script>
<script>
    // Aktifkan autocomplete pada input field
    $(document).ready(function(){
        $('#autocomplete-jabatan').autocomplete({
            source: function(request, response){
                $.ajax({
                    url: 'autocomplete_jabatan.php',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data){
                        response(data);
                    }
                });
            },
            minLength: 1
        });
    });
</script>
