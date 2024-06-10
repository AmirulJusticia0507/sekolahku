<?php
require_once('tcpdf/tcpdf.php');

// Mendapatkan data dari form preview
$namaSiswa = $_POST['nama_siswa'] ?? '';
$tempatLahir = $_POST['tempat_lahir'] ?? '';
$tanggalLahir = $_POST['tanggal_lahir'] ?? '';
$kelas = $_POST['kelas'] ?? '';
$nis = $_POST['nis'] ?? '';
$kompetensiKeahlian = $_POST['kompetensi_keahlian'] ?? [];
$alamat = $_POST['alamat'] ?? '';
$golonganDarah = $_POST['golongan_darah'] ?? '';
$namaOrtu = $_POST['nama_orangtua'] ?? '';
$alamatOrtu = $_POST['alamat_orangtua'] ?? '';
$catatanKesehatan = $_POST['catatan_kesehatan'] ?? '';

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Data Siswa');
$pdf->SetSubject('Preview Data Siswa');
$pdf->SetKeywords('TCPDF, PDF, data siswa, preview');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Set data into PDF
$html = "
    <h1>Data Siswa</h1>
    <table border='1' cellpadding='5'>
        <tr>
            <td>Nama Siswa</td>
            <td>{$namaSiswa}</td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>{$tempatLahir}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>{$tanggalLahir}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>{$kelas}</td>
        </tr>
        <tr>
            <td>NIS</td>
            <td>{$nis}</td>
        </tr>
        <tr>
            <td>Kompetensi Keahlian</td>
            <td>".implode(', ', $kompetensiKeahlian)."</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>{$alamat}</td>
        </tr>
        <tr>
            <td>Golongan Darah</td>
            <td>{$golonganDarah}</td>
        </tr>
        <tr>
            <td>Nama Orangtua/Wali</td>
            <td>{$namaOrtu}</td>
        </tr>
        <tr>
            <td>Alamat Orangtua/Wali</td>
            <td>{$alamatOrtu}</td>
        </tr>
        <tr>
            <td>Catatan Kesehatan</td>
            <td>{$catatanKesehatan}</td>
        </tr>
    </table>
";

$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('Data_Siswa.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
