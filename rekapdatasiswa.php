<?php include 'includes/menudatasiswa.php'; ?>

<div class="card">
    <div class="card-header">
        Data Siswa
    </div>
    <div class="card-body">
        <!-- Form Edit -->
        <div id="editForm" style="display:none;">
            <!-- Form edit -->
            <form action="proses_edit_siswa.php" method="post" enctype="multipart/form-data">
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
                <div class="col mb-3">
                    <label for="kompetensi_keahlian">Kompetensi Keahlian: </label>
                    <select name="kompetensi_keahlian[]" id="kompetensi_keahlian" class="form-control select2" multiple="multiple" style="width: 100%;">
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
                <div class="mb-3">
                    <label for="nama_orangtua" class="form-label">Nama Orangtua/Wali:</label>
                    <input type="text" name="nama_orangtua" id="nama_orangtua" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="alamat_orangtua" class="form-label">Alamat Orangtua/Wali:</label>
                    <textarea name="alamat_orangtua" id="alamat_orangtua" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="catatan_kesehatan" class="form-label">Catatan Kesehatan:</label>
                    <textarea name="catatan_kesehatan" id="catatan_kesehatan" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_siswa" class="form-label">Upload Foto:</label>
                    <input type="file" name="foto_siswa" id="foto_siswa" class="form-control" accept="image/*" required>
                    <img id="preview" src="#" alt="Preview Image" style="display: none; max-width: 100px; margin-top: 10px;">
                    <button type="button" id="removeImage" class="btn btn-danger" style="display: none;">Hapus Gambar</button>
                </div><br><br><br><br>
                <div class="mb-3" align="center">
                    <button type="submit" class="btn btn-info"><i class="fas fa-pen"></i> Update</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-power-off"> Reset</i></button>
                </div>
            </form>
        </div>
        
        <table id="rekapDataSiswa" class="display table table-bordered table-striped table-hover responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Kelas</th>
                    <th>Kompetensi Keahlian</th>
                    <th>Alamat</th>
                    <th>Golongan Darah</th>
                    <th>Nama Orangtua/Wali</th>
                    <th>Alamat Orangtua/Wali</th>
                    <th>Catatan Kesehatan</th>
                    <th>Foto Siswa</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'konekke_local.php';
                $sql = "SELECT * FROM siswa";
                $result = $koneklocalhost->query($sql);
                // Periksa apakah kueri berhasil dijalankan
                if ($result) {
                    $nomorUrutTerakhir = 1;
                    // Periksa apakah ada data yang ditemukan
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style='text-align:center; width: 2px; font-size: 10pt; white-space: normal;'>" . $nomorUrutTerakhir . "</td>";
                            echo "<td>" . $row['nis'] . "</td>";
                            echo "<td>" . $row['namasiswa'] . "</td>";
                            echo "<td>" . $row['tempatlahir'] . "</td>";
                            echo "<td>" . $row['tanggal'] . "</td>";
                            echo "<td>" . $row['kelas'] . "</td>";
                            echo "<td>" . $row['kompetensi_keahlian'] . "</td>";
                            echo "<td>" . $row['alamat'] . "</td>";
                            echo "<td>" . $row['golongan_darah'] . "</td>";
                            echo "<td>" . $row['nama_orangtua'] . "</td>";
                            echo "<td>" . $row['alamat_orangtua'] . "</td>";
                            echo "<td>" . $row['catatan_kesehatan'] . "</td>";
                            echo "<td>";
                            if (!empty($row['foto_siswa'])) {
                                $photoPath = "uploads/siswa/{$row['foto_siswa']}";
                                echo "<a href='{$photoPath}' data-fancybox='gallery'>";
                                echo "<img src='{$photoPath}' alt='Foto Siswa' style='max-width: 100px; max-height: 100px;'>";
                                echo "</a>";
                            } else {
                                echo "Tidak ada foto";
                            }
                            echo "</td>";
                            echo "<td>
                                    <button class='btn btn-primary btn-sm btn-preview' data-toggle='modal' data-target='#previewModal' title='Preview'><i class='fas fa-eye'></i></button>
                                    <button class='btn btn-info btn-sm btn-edit' data-nis='" . $row['nis'] . "' title='Edit'><i class='fas fa-pen'></i></button>
                                    <button class='btn btn-danger btn-sm btn-delete' title='Delete'><i class='fas fa-trash'></i></button>
                                </td>";
                            echo "</tr>";
                            $nomorUrutTerakhir++;
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="previewNama">Nama Siswa:</label>
                            <input type="text" class="form-control" id="previewNama" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="previewTempatLahir">Tempat:</label>
                            <input type="text" class="form-control" id="previewTempatLahir" readonly>
                        </div>,
                        <div class="col mb-3">
                            <label for="previewTanggalLahir">Tanggal Lahir:</label>
                            <input type="text" class="form-control" id="previewTanggalLahir" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="previewKelas">Kelas:</label>
                            <input type="text" class="form-control" id="previewKelas" readonly>
                        </div>/
                        <div class="col mb-3">
                            <label for="previewNIS">NIS:</label>
                            <input type="text" class="form-control" id="previewNIS" readonly>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <label for="previewKompetensi">Kompetensi Keahlian:</label>
                        <ul id="previewKompetensi" class="list-group" style="max-height: 150px; overflow-y: auto;"></ul>
                    </div>

                    <div class="col mb-3">
                        <label for="previewAlamat">Alamat:</label>
                        <textarea class="form-control" id="previewAlamat" rows="3" readonly></textarea>
                    </div>
                    <div class="col mb-3">
                        <label for="previewGolDarah">Golongan Darah:</label>
                        <input type="text" class="form-control" id="previewGolDarah" readonly>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="previewNamaOrtu">Nama Orangtua/Wali:</label>
                            <input type="text" class="form-control" id="previewNamaOrtu" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="previewAlamatOrtu">Alamat Orangtua/Wali:</label>
                            <textarea class="form-control" id="previewAlamatOrtu" rows="3" readonly></textarea>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <label for="previewCatatanKesehatan">Catatan Kesehatan:</label>
                        <textarea class="form-control" id="previewCatatanKesehatan" rows="3" readonly></textarea>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="previewFoto">Foto Siswa:</label>
                            <img id="previewFoto" src="#" alt="Preview Foto" style="max-width: 100px;" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printPreview">Print</button>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/scriptdatasiswa.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Tombol show edit form
        $("#showEditForm").click(function() {
            $("#editForm").toggle();
        });

        $(document).ready(function() {
            // SweetAlert 2 untuk tombol delete
            $(".btn-delete").click(function() {
                var button = $(this);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    input: 'textarea',
                    inputPlaceholder: 'Alasan penghapusan...',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Anda perlu menulis alasan penghapusan!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var nis = button.closest('tr').find('td:eq(1)').text();
                        var alasan = result.value;

                        $.ajax({
                            url: 'delete_siswa.php',
                            method: 'post',
                            data: {
                                nis: nis,
                                alasan: alasan
                            },
                            success: function(response) {
                                var data = JSON.parse(response);
                                if (data.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Data siswa telah dihapus.',
                                        'success'
                                    );
                                    button.closest('tr').remove();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            });
        });

        // Ketika tombol edit diklik
        $(".btn-edit").click(function() {
            // Ambil NIS siswa dari atribut data-nis
            var nis = $(this).data('nis');
            // Kirim permintaan AJAX untuk mengambil data siswa berdasarkan NIS
            $.ajax({
                url: 'get_data_siswa.php', // Ubah sesuai dengan file yang menangani permintaan
                method: 'post',
                data: {
                    nis: nis
                },
                dataType: 'json',
                success: function(response) {
                    // Isi nilai input form edit dengan data siswa yang diterima
                    $('#namasiswa').val(response.namasiswa);
                    $('#tempatlahir').val(response.tempatlahir);
                    $('#tanggal').val(response.tanggal);
                    $('#kelas').val(response.kelas);
                    $('#nis').val(response.nis);
                    $('#alamat').val(response.alamat);
                    $('#golongan_darah').val(response.golongan_darah);
                    $('#nama_orangtua').val(response.nama_orangtua);
                    $('#alamat_orangtua').val(response.alamat_orangtua);
                    $('#catatan_kesehatan').val(response.catatan_kesehatan);
                    // Tampilkan form edit
                    $("#editForm").show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Ketika tombol preview diklik
        $(".btn-preview").click(function() {
            // Ambil data siswa dari baris yang diklik
            var row = $(this).closest('tr');
            var namaSiswa = row.find('td:eq(2)').text();
            var tempatLahir = row.find('td:eq(3)').text();
            var tanggalLahir = row.find('td:eq(4)').text();
            var kelas = row.find('td:eq(5)').text();
            var nis = row.find('td:eq(1)').text();
            var alamat = row.find('td:eq(6)').text();
            var golonganDarah = row.find('td:eq(7)').text();
            var namaOrangtua = row.find('td:eq(8)').text();
            var alamatOrangtua = row.find('td:eq(9)').text();
            var catatanKesehatan = row.find('td:eq(10)').text();
            var fotoSiswa = row.find('td:eq(11) img').attr('src');

            // Isi modal preview dengan data siswa
            $('#previewNama').val(namaSiswa);
            $('#previewTempatLahir').val(tempatLahir);
            $('#previewTanggalLahir').val(tanggalLahir);
            $('#previewKelas').val(kelas);
            $('#previewNIS').val(nis);
            $('#previewAlamat').val(alamat);
            $('#previewGolDarah').val(golonganDarah);
            $('#previewNamaOrtu').val(namaOrangtua);
            $('#previewAlamatOrtu').val(alamatOrangtua);
            $('#previewCatatanKesehatan').val(catatanKesehatan);
            $('#previewFoto').attr('src', fotoSiswa);

            // Ambil kompetensi keahlian dari data siswa
            var kompetensiKeahlian = row.find('td:eq(6)').text().split(', ');
            $('#previewKompetensi').empty(); // Kosongkan daftar sebelum mengisi ulang
            kompetensiKeahlian.forEach(function(kompetensi) {
                $('#previewKompetensi').append('<li class="list-group-item">' + kompetensi + '</li>');
            });

            // Tampilkan modal preview
            $('#previewModal').modal('show');
        });

    });
</script>