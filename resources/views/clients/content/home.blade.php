@extends('clients.layouts.master')

@section('title', 'SPBE - Beranda')

@section('content-body')
    @include('clients.partials.hero', ['slides' => $slides])

    <main id="main">
        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Apa Itu SPBE?</h2>
                </div>
                <div class="row content">
                    <div class="col-lg-12">
                        <p>
                            Sistem Pemerintahan Berbasis Elektronik (SPBE) merupakan penyelenggaraan pemerintahan yang
                            memanfaatkan
                            teknologi informasi dan komunikasi untuk memberikan layanan kepada Pengguna SPBE. Untuk
                            memastikan
                            pelaksanaan SPBE di Instansi Pusat dan Pemerintah Daerah selaras dengan prinsip terintegrasi
                            dan terpadu,
                            maka Instansi Pusat dan Pemerintah Daerah diharapkan menerapkan unsur-unsur SPBE sesuai
                            dengan kerangka
                            kerja Tata Kelola SPBE dan Manajemen SPBE agar penerapan SPBE dapat berjalan efektif,
                            efisien, dan
                            berkesinambungan, serta dapat menghasilkan layanan SPBE yang berkualitas dan optimal. Untuk
                            mengukur
                            perkembangan penerapan SPBE di Indonesia, Kementerian Pendayagunaan Aparatur Negara dan
                            Reformasi
                            Birokrasi bersama Tim Koordinasi SPBE Nasional melaksanakan Pemantauan dan Evaluasi SPBE.
                            Pada tahun 2022,
                            telah dilaksanakan Pemantauan SPBE dengan menggunakan instrumen sebagaimana telah diatur
                            dalam Peraturan
                            Menteri PANRB Nomor 59 Tahun 2020 tentang Pemantauan dan Evaluasi SPBE. Hasil pelaksanaan
                            Pemantauan SPBE
                            yang dilakukan pada tahun 2022 sebagaimana terlampir dalam Laporan Hasil Pemantauan ini
                            diharapkan dapat
                            digunakan dalam menentukan tindak lanjut yang harus dilakukan dalam mendorong peningkatan
                            penerapan SPBE
                            secara menyeluruh pada Instansi Pusat dan Pemerintah Daerah di masa mendatang dalam rangka
                            meningkatkan
                            kualitas layanan pemerintah kepada masyarakat dan terwujudnya digitalisasi pemerintah dalam
                            kerangka
                            reformasi birokrasi nasional.
                        </p>
                    </div>
                </div>
        </section>
        <!-- End About Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Sistem Pemerintahan Berbasis Elektronik</h2>
                    <p>Dasar penyusunan SPBE dengan memperhatikan komparasi peraturan PermenPanRB Nomor 5 Tahun 2018
                        dengan
                        PermenPanRB Nomor 59 Tahun 2020</p>
                </div>
                <div class="row">
                    <!-- List Tentang SPBE -->
                    <div class="col-xl-3 col-md-6 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="{{ url('/kebijakan-spbe') }}" target="_blank">Kebijakan SPBE</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-grid-alt"></i></div>
                            <h4><a href="{{ url('/tata-kelola-spbe') }}" target="_blank">Tata Kelola SPBE</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-cog"></i></div>
                            <h4><a href="{{ url('/manajemen-spbe') }}" target="_blank">Manajemen SPBE</a></h4>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-support"></i></div>
                            <h4><a href="{{ url('/layanan-spbe') }}" target="_blank">Layanan SPBE</a></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Services Section -->

        <!-- ======= Index Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Indeks SPBE</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                        consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                        fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>
                <div class="row content">
                    <select class="form-select mb-4" id="yearSelect" aria-label="Default select example">
                        <option disabled selected hidden>Pilih Tahun Index...</option>
                        @foreach ($chartData as $year => $data)
                            <option value="{{ $year }}">Indeks SPBE Tahun {{ $year }}</option>
                        @endforeach
                    </select>
                    <h3 class="mb-4 text-center">
                        <button id="chartLabelButton" class="btn-h3" data-bs-toggle="modal" data-bs-target="#detailModal"
                            title="Tekan untuk lihat detail">
                            Indeks SPBE Tahun 2023
                        </button>
                    </h3>
                    <canvas id="radarChart" style="max-height: 400px;"></canvas>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 80vw; margin: 1.75rem auto;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel">Detail Indeks SPBE Tahun 2023</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p id="modalContent">Informasi detail mengenai Indeks SPBE Tahun 2023 akan ditampilkan di
                                    sini.</p>
                                <div id="iframeContainer">
                                    @foreach ($iframeSrc as $year => $src)
                                        <iframe id="iframe{{ $year }}" class="embed-responsive-item d-none"
                                            style="height: 70vh; width: 100%; text-align: center;"
                                            src="{{ $src }}"></iframe>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Index Section -->

        <!-- ======= History Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>History Indeks SPBE Kemenko Perekonomian</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                        consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                        fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>
                <!-- Line Chart -->
                <canvas id="barLineChart" style="max-height: 400px;"></canvas>
                <!-- End Bar-Line Chart -->
            </div>
        </section>
        <!-- End History Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container mt-5" data-aos="fade-up">
                <div class="section-title">
                    <h2>Aplikasi</h2>
                </div>
                <div class="row" data-aos="zoom-in">
                    <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="clients/assets/img/jdihn.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="clients/assets/img/kppip.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="clients/assets/img/sdm-ekon.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="clients/assets/img/siap-bantu.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="clients/assets/img/pelyta.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="clients/assets/img/satupeta.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="clients/assets/img/prakerja.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="clients/assets/img/p3ke.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>
        <!-- End Cliens Section -->

        <!-- ======= FAQ Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Frequently Asked Questions</h2>
                </div>
                <div class="faq-list">
                    <ul>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse"
                                data-bs-target="#faq-list-1">Apa yang dimaksud dengan SPBE?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-1" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Sistem Pemerintahan Berbasis Elektronik (e-Government) mengacu pada
                                    penggunaan
                                    teknologi informasi dan
                                    komunikasi (TIK) untuk meningkatkan efisiensi, transparansi, aksesibilitas,
                                    dan
                                    pelayanan dalam
                                    administrasi dan penyelenggaraan pemerintahan. e-Government berfokus pada
                                    penggunaan
                                    teknologi
                                    elektronik untuk mengelola dan menyediakan layanan pemerintahan kepada
                                    masyarakat,
                                    bisnis, dan
                                    institusi lainnya.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                data-bs-target="#faq-list-2" class="collapsed">Apakah yang dimaksud dengan
                                infrastruktur SPBE? <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Infrastruktur Sistem Pemerintahan Berbasis Elektronik merujuk pada
                                    serangkaian
                                    komponen dan fasilitas
                                    teknologi yang dibutuhkan untuk mendukung implementasi dan operasionalisasi
                                    Sistem
                                    Pemerintahan
                                    Berbasis Elektronik (e-Government). Infrastruktur ini melibatkan berbagai
                                    elemen
                                    teknis yang mendukung
                                    penggunaan teknologi informasi dan komunikasi (TIK) dalam konteks
                                    pemerintahan.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                data-bs-target="#faq-list-3" class="collapsed">Apa yang dimaksud dengan
                                Rencana Induk
                                SPBE Kementerian? <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Rencana Induk Sistem Pemerintahan Berbasis Elektronik Kementerian adalah
                                    sebuah
                                    dokumen strategis yang
                                    disusun oleh suatu kementerian dalam rangka mengatur dan mengarahkan
                                    implementasi
                                    sistem pemerintahan
                                    berbasis elektronik (e-Government) di lingkungan internal kementerian
                                    tersebut.
                                    Dokumen ini memberikan
                                    panduan dan kerangka kerja untuk pengembangan dan pengelolaan inisiatif
                                    e-Government
                                    di tingkat
                                    kementerian.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                data-bs-target="#faq-list-4" class="collapsed">Apa yang dimaksud dengan
                                Aplikasi SPBE?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Aplikasi Sistem Pemerintahan Berbasis Elektronik merujuk pada perangkat
                                    lunak atau
                                    platform yang
                                    digunakan dalam implementasi Sistem Pemerintahan Berbasis Elektronik
                                    (e-Government).
                                    Aplikasi ini
                                    dirancang khusus untuk memfasilitasi berbagai fungsi dan layanan
                                    pemerintahan yang
                                    menggunakan
                                    teknologi informasi dan komunikasi (TIK) dalam pengelolaan proses
                                    administrasi dan
                                    penyelenggaraan
                                    pemerintah.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                data-bs-target="#faq-list-5" class="collapsed">Apa yang dimaksud dengan
                                Pemantuan
                                SPBE? <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Pemantauan Sistem Pemerintahan Berbasis Elektronik merujuk pada proses
                                    pengawasan
                                    dan evaluasi yang
                                    dilakukan untuk memantau kinerja dan keberhasilan implementasi Sistem
                                    Pemerintahan
                                    Berbasis Elektronik
                                    (e-Government). Tujuannya adalah untuk memastikan bahwa sistem pemerintahan
                                    berbasis
                                    teknologi
                                    informasi dan komunikasi (TIK) berjalan dengan baik, memberikan hasil yang
                                    diharapkan, dan sesuai
                                    dengan tujuan strategis yang telah ditetapkan.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                data-bs-target="#faq-list-6" class="collapsed">Apa yang dimaksud dengan
                                penilaian
                                mandiri? <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Penilaian mandiri Sistem Pemerintahan Berbasis Elektronik merujuk pada
                                    proses
                                    evaluasi yang dilakukan
                                    oleh entitas pemerintah untuk mengevaluasi kesiapan, kemajuan, dan kualitas
                                    implementasi Sistem
                                    Pemerintahan Berbasis Elektronik (e-Government) di dalam organisasi mereka.
                                    Tujuan
                                    dari penilaian
                                    mandiri ini adalah untuk mengukur sejauh mana sistem pemerintahan berbasis
                                    elektronik telah
                                    diimplementasikan dengan efektif dan efisien, serta untuk mengidentifikasi
                                    area
                                    perbaikan yang mungkin
                                    diperlukan.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                data-bs-target="#faq-list-7" class="collapsed">Apa tujuan SPBE? <i
                                    class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Tujuan Sistem Pemerintahan Berbasis Elektronik (e-Government) adalah untuk
                                    mengubah
                                    cara pemerintahan
                                    beroperasi dan berinteraksi dengan masyarakat dengan memanfaatkan teknologi
                                    informasi dan komunikasi
                                    (TIK).
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse"
                                data-bs-target="#faq-list-8" class="collapsed">Apa yang dimaksud dengan
                                Evaluasi SPBE?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    valuasi Sistem Pemerintahan Berbasis Elektronik (e-Government Evaluation)
                                    merujuk
                                    pada proses
                                    sistematis untuk mengevaluasi implementasi dan kinerja Sistem Pemerintahan
                                    Berbasis
                                    Elektronik
                                    (e-Government) di suatu entitas pemerintah. Evaluasi ini bertujuan untuk
                                    menilai
                                    sejauh mana
                                    e-Government telah mencapai tujuan strategisnya, mengidentifikasi kekuatan
                                    dan
                                    kelemahan implementasi,
                                    serta memberikan rekomendasi untuk perbaikan dan pengembangan lebih lanjut.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End FAQ Section -->

        <!-- ======= Ask Us Section ======= -->
        <section id="ask-question" class="faq">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Tanya Kami</h2>
                </div>
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <iframe
                            src="https://docs.google.com/forms/d/e/1FAIpQLSf3G6h2cDDRBPSOVO4IqOngThnNG1YvmX9KJMeQ2bMwrx-FtQ/viewform?embedded=true"
                            width=100% height=700px frameborder="0" marginheight="0" marginwidth="0">Memuat…</iframe>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Ask Us Section -->
    </main>
    <!-- End #main -->
@endsection

@section('additional-style')
    {{-- Owl Carousel Style --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .position-relative {
            position: relative;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .position-relative:hover .card-img {
            transform: scale(1.1);
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .position-relative:hover .overlay {
            opacity: 1;
        }

        #hero {
            height: 100vh;
            /* Tinggi hero tetap 100% dari viewport height */
            position: relative;
            /* Position relative untuk carousel absolute positioning */
            overflow: hidden;
            /* Menghindari overflow konten di luar hero */
        }

        .carousel-item img {
            width: 100%;
            /* Lebar gambar 100% dari parent (carousel-item) */
            height: auto;
            /* Tinggi gambar menyesuaikan proporsional dengan lebar */
            object-fit: cover;
            /* Memastikan gambar terisi penuh tanpa distorsi */
            object-position: center;
            /* Posisi gambar di tengah */
        }

        .carousel {
            width: 100%;
            /* Lebar carousel 100% dari lebar viewport */
            max-width: 100%;
            /* Batas maksimum lebar carousel agar tidak melebihi viewport */
        }

        .btn-h3 {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            font: inherit;
            cursor: pointer;
            color: inherit;
        }
    </style>
@endsection

@section('additional-scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
        integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    {{-- Chart Indeks --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const ctx = document.querySelector('#radarChart').getContext('2d');
            const chartLabelButton = document.getElementById('chartLabelButton');
            const yearSelect = document.getElementById('yearSelect');
            const detailModalLabel = document.getElementById('detailModalLabel');
            const modalBody = document.querySelector('.modal-body p');

            const data = @json($chartData); // Akan panggil $chartData dari ClientController.php

            const chartOptions = {
                type: 'radar',
                data: {
                    labels: [
                        'Kebijakan Internal terkait Tata Kelola SPBE',
                        'Perencanaan Strategis SPBE',
                        'Teknologi Informasi dan Komunikasi',
                        'Penyelenggara SPBE',
                        'Penerapan Manajemen SPBE',
                        'Audit TIK',
                        'Layanan Administrasi Pemerintahan Berbasis Elektronik',
                        'Layanan Publik Berbasis Elektronik'
                    ],
                    datasets: [{
                        label: 'Penilaian Mandiri',
                        data: data[2023].firstDataset, // Default to 2023 data
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)'
                    }, {
                        label: 'Penilaian Akhir',
                        data: data[2023].secondDataset, // Default to 2023 data
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        pointBackgroundColor: 'rgb(54, 162, 235)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(54, 162, 235)'
                    }]
                },
                options: {
                    elements: {
                        line: {
                            borderWidth: 3
                        }
                    }
                }
            };

            let radarChart = new Chart(ctx, chartOptions);

            // Set default selection to 2023
            yearSelect.value = '2023';

            yearSelect.addEventListener('change', function() {
                const selectedYear = this.value;
                chartLabelButton.textContent = `Indeks SPBE Tahun ${selectedYear}`;
                detailModalLabel.textContent = `Detail Indeks SPBE Tahun ${selectedYear}`;
                modalBody.textContent =
                    `Informasi detail mengenai Indeks SPBE Tahun ${selectedYear} akan ditampilkan di sini.`;
                radarChart.data.datasets[0].data = data[selectedYear].firstDataset;
                radarChart.data.datasets[1].data = data[selectedYear].secondDataset;
                radarChart.update();
            });

            chartLabelButton.addEventListener('click', function() {
                const selectedYear = yearSelect.value;
                detailModalLabel.textContent = `Detail Indeks SPBE Tahun ${selectedYear}`;
                modalBody.textContent =
                    `Informasi detail mengenai Indeks SPBE Tahun ${selectedYear} akan ditampilkan di sini.`;
                $('#detailModal').modal('show');
            });

            // Initialize tooltip
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    {{-- Modal Body Chart Index --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const yearSelect = document.getElementById('yearSelect');
            const modalContent = document.getElementById('modalContent');
            const iframe2023 = document.getElementById('iframe2023');
            const iframe2022 = document.getElementById('iframe2022');
            // Add additional iframe variables for other years if needed

            yearSelect.addEventListener('change', function() {
                const selectedYear = this.value;
                modalContent.textContent =
                    `Informasi detail mengenai Indeks SPBE Tahun ${selectedYear} akan ditampilkan di sini.`;

                // Hide all iframes first
                iframe2023.classList.add('d-none');
                iframe2022.classList.add('d-none');
                // Add additional iframe classes for other years if needed

                // Show iframe based on selected year
                document.getElementById(`iframe${selectedYear}`).classList.remove('d-none');
                document.getElementById(`iframe${selectedYear}`).src = iframeSrc[selectedYear];
            });
        });
    </script>

    {{-- Chart History --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const data = @json($averageData);

            const years = Object.keys(data);
            const averageData = Object.values(data);

            const ctx = document.querySelector('#barLineChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years,
                    datasets: [{
                        label: 'Bar Chart',
                        data: averageData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Bar Chart Color
                        borderColor: 'rgba(255, 99, 132, 1)', // Bar Border Color
                        borderWidth: 1 // Bar Border Width
                    }, {
                        label: 'Line Chart',
                        data: averageData,
                        type: 'line', // Line Chart Data
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
