<?php include 'includes/menudataguru.php'; ?>

<div class="card">
    <div class="card-header">
        Data Guru
    </div>
    <div class="card-body">
    <div id="editFormGuru" style="display:none;">
            <form action="proses_edit_guru.php" method="post" enctype="multipart/form-data">
                <div class="col mb-3">
                    <label for="namaGuru">Nama Guru: </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                        <input type="text" name="nama" id="namaGuru" class="form-control" required>
                    </div>
                </div>
                <div class="col mb-3">
                    <label for="tempatLahirGuru">Tempat Lahir: </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map"></i></span>
                        <input type="text" name="tempat_lahir" id="tempatLahirGuru" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggalLahirGuru" class="form-label">Tanggal Lahir:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        <input type="date" class="form-control" id="tanggalLahirGuru" name="tanggal_lahir">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="jenisKelaminGuru" class="form-label">Jenis Kelamin:</label>
                    <select class="form-control" id="jenisKelaminGuru" name="jenis_kelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="alamatGuru">Alamat:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-clipboard-list"></i></span>
                        <textarea name="alamat" id="alamatGuru" cols="5" rows="5" placeholder="Alamat Guru...." class="form-control" required></textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="emailGuru" class="form-label">Email:</label>
                    <input type="email" name="email" id="emailGuru" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="noTeleponGuru" class="form-label">No. Telepon:</label>
                    <input type="text" name="no_telepon" id="noTeleponGuru" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="statusGuru" class="form-label">Status:</label>
                    <select class="form-control" id="statusGuru" name="status_id">
                        <!-- Options generated from database -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jabatanGuru" class="form-label">Jabatan:</label>
                    <select class="form-control" id="jabatanGuru" name="jabatan_id">
                        <!-- Options generated from database -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fotoGuru" class="form-label">Upload Foto:</label>
                    <input type="file" name="foto_guru" id="fotoGuru" class="form-control" accept="image/*" required>
                    <img id="previewGuru" src="#" alt="Preview Image" style="display: none; max-width: 100px; margin-top: 10px;">
                    <button type="button" id="removeImageGuru" class="btn btn-danger" style="display: none;">Hapus Gambar</button>
                </div><br><br><br><br>
                <div class="mb-3" align="center">
                    <button type="submit" class="btn btn-info"><i class="fas fa-pen"></i> Update</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-power-off"> Reset</i></button>
                </div>
            </form>
        </div>

        <table id="rekapDataGuru" class="display table table-bordered table-striped table-hover responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Status</th>
                    <th>Jabatan</th>
                    <th>Foto Guru</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'konekke_local.php';
                $sql = "SELECT guru.*, status_guru.nama AS status_nama, jabatan_guru.nama AS jabatan_nama 
                        FROM guru
                        LEFT JOIN status_guru ON guru.status_id = status_guru.id
                        LEFT JOIN jabatan_guru ON guru.jabatan_id = jabatan_guru.id";
                $result = $koneklocalhost->query($sql);
                // Periksa apakah kueri berhasil dijalankan
                if ($result) {
                    $nomorUrutTerakhir = 1;
                    // Periksa apakah ada data yang ditemukan
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td style='text-align:center; width: 2px; font-size: 10pt; white-space: normal;'>" . $nomorUrutTerakhir . "</td>";
                            echo "<td>" . $row['nip'] . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['tempat_lahir'] . "</td>";
                            echo "<td>" . $row['tanggal_lahir'] . "</td>";
                            echo "<td>" . $row['jenis_kelamin'] . "</td>";
                            echo "<td>" . $row['alamat'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['no_telepon'] . "</td>";
                            echo "<td>" . $row['status_nama'] . "</td>";
                            echo "<td>" . $row['jabatan_nama'] . "</td>";
                            echo "<td>";
                            if (!empty($row['foto_guru'])) {
                                $photoPath = "uploads/guru/{$row['foto_guru']}";
                                echo "<a href='{$photoPath}' data-fancybox='gallery'>";
                                echo "<img src='{$photoPath}' alt='Foto Guru' style='max-width: 100px; max-height: 100px;'>";
                                echo "</a>";
                            } else {
                                echo "Tidak ada foto";
                            }
                            echo "</td>";
                            echo "<td>
                                    <button class='btn btn-primary btn-sm btn-preview' data-toggle='modal' data-target='#previewModal' title='Preview'><i class='fas fa-eye'></i></button>
                                    <button class='btn btn-info btn-sm btn-edit' data-nip='" . $row['nip'] . "' title='Edit'><i class='fas fa-pen'></i></button>
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
                <h5 class="modal-title" id="previewModalLabel">Preview Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="previewNama">Nama Guru:</label>
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
                            <label for="previewJenisKelamin">Jenis Kelamin:</label>
                            <input type="text" class="form-control" id="previewJenisKelamin" readonly>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <label for="previewAlamat">Alamat:</label>
                        <textarea class="form-control" id="previewAlamat" rows="3" readonly></textarea>
                    </div>
                    <div class="col mb-3">
                        <label for="previewEmail">Email:</label>
                        <input type="text" class="form-control" id="previewEmail" readonly>
                    </div>
                    <div class="col mb-3">
                        <label for="previewNoTelepon">No. Telepon:</label>
                        <input type="text" class="form-control" id="previewNoTelepon" readonly>
                    </div>
                    <div class="col mb-3">
                        <label for="previewStatus">Status:</label>
                        <input type="text" class="form-control" id="previewStatus" readonly>
                    </div>
                    <div class="col mb-3">
                        <label for="previewJabatan">Jabatan:</label>
                        <input type="text" class="form-control" id="previewJabatan" readonly>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="previewFoto">Foto Guru:</label>
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

<?php include 'includes/scriptdataguru.php'; ?>
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
                        var nip = button.closest('tr').find('td:eq(1)').text();
                        var alasan = result.value;

                        $.ajax({
                            url: 'delete_guru.php',
                            method: 'post',
                            data: {
                                nip: nip,
                                alasan: alasan
                            },
                            success: function(response) {
                                var data = JSON.parse(response);
                                if (data.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Data guru telah dihapus.',
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

        var table = $('#rekapDataGuru').DataTable();

        $('#rekapDataGuru tbody').on('click', '.btn-preview', function() {
            var data = table.row($(this).closest('tr')).data();
            $('#previewNama').val(data[2]);
            $('#previewTempatLahir').val(data[3]);
            $('#previewTanggalLahir').val(data[4]);
            $('#previewJenisKelamin').val(data[5]);
            $('#previewAlamat').val(data[6]);
            $('#previewEmail').val(data[7]);
            $('#previewNoTelepon').val(data[8]);
            $('#previewStatus').val(data[9]);
            $('#previewJabatan').val(data[10]);
            $('#previewFoto').attr('src', $(data[11]).find('img').attr('src'));
        });

        $('#printPreview').click(function() {
            var printContents = $('.modal-body').html();
            var originalContents = $('body').html();

            $('body').html(printContents);
            window.print();
            $('body').html(originalContents);
            location.reload(); // Reload halaman setelah print untuk mengembalikan modal
        });

        $(".btn-edit").click(function() {
            var nip = $(this).data('nip');
            $.ajax({
                url: 'get_data_guru.php', // File PHP untuk mengambil data guru
                method: 'post',
                data: {
                    nip: nip
                },
                success: function(response) {
                    var data = JSON.parse(response);

                    // Isi form edit dengan data guru
                    $("#namaGuru").val(data.nama);
                    $("#tempatLahirGuru").val(data.tempat_lahir);
                    $("#tanggalLahirGuru").val(data.tanggal_lahir);
                    $("#jenisKelaminGuru").val(data.jenis_kelamin);
                    $("#alamatGuru").val(data.alamat);
                    $("#emailGuru").val(data.email);
                    $("#noTeleponGuru").val(data.no_telepon);
                    $("#statusGuru").val(data.status_id);
                    $("#jabatanGuru").val(data.jabatan_id);
                    $("#fotoGuru").val(data.foto_guru);

                    // Tampilkan form edit
                    $("#editFormGuru").show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Event handler untuk tombol reset pada form edit
        $("button[type='reset']").click(function() {
            $("#editFormGuru").hide();
        });
    });
</script>