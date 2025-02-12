<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use App\Models\Indicator;
use App\Models\Slide; //masukan model slide
use App\Models\Article; //masukan model article
use App\Models\Material; //masukan model article
use App\Models\Regulation; //masukan model article
use App\Models\DomainKebijakan; //masukan model domain kebijakan
use App\Models\DomainLayanan; //masukan model domain layanan
use App\Models\DomainTatakelola; //masukan model domain tatakelola
use App\Models\DomainManajemen; //masukan model domain manajemen
use App\Models\Application; //masukan model application
use Illuminate\Http\Request;
use App\Models\SelfAssessment;
use App\Models\FinalAssessment;
use App\Models\DashboardAssessment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $years = DashboardAssessment::select('year')->distinct()->get();
        return view('admin.content.home', compact('years'));
    }

    public function getAssessmentData($year)
    {
        $selfAssessment = SelfAssessment::where('year', $year)->first();
        $finalAssessment = FinalAssessment::where('year', $year)->first();
        $dashboardAssessment = DashboardAssessment::where('year', $year)->first();

        return response()->json([
            'selfAssessment' => $selfAssessment,
            'finalAssessment' => $finalAssessment,
            'dashboardAssessment' => $dashboardAssessment,
        ]);
    }

    public function assessment()
    {
        $dashboardAssessments = DashboardAssessment::all();
        return view('admin.content.assessment', compact('dashboardAssessments'));
    }

    public function getAssessmentDetails($id)
    {
        $dashboardAssessment = DashboardAssessment::find($id);
        $finalAssessment = FinalAssessment::where('year', $dashboardAssessment->year)->first();
        $selfAssessment = SelfAssessment::where('year', $dashboardAssessment->year)->first();
        $aspects = Aspect::with('indicators')->get();
        $indicators = Indicator::whereIn('aspect_id', $aspects->pluck('id'))->get();

        return response()->json([
            'dashboardAssessment' => $dashboardAssessment,
            'finalAssessment' => $finalAssessment,
            'selfAssessment' => $selfAssessment,
            'aspects' => $aspects,
            'indicators' => $indicators,
        ]);
    }

    public function updateAssessment(Request $request, $id)
    {
        $dashboardAssessment = DashboardAssessment::find($id);
        $dashboardAssessment->update($request->all());

        return response()->json([
            'message' => 'Assessment updated successfully',
        ]);
    }

    public function createAssessment()
    {
        return view('admin.content.create_assessment');
    }

    // Menampilkan halaman home yang berisi daftar slide
    public function clientsHome()
    {
        $slides = Slide::all(); // Ambil semua slide
        return view('admin.content.clientsHome', compact('slides'));
    }

   // Menampilkan form untuk menambah slide
    public function createHomeContent()
    {
        return view('admin.content.createSlide');
    }

    // Menyimpan slide baru ke database
    public function storeHomeContent(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
        ]);

        // Menyimpan slide baru
        $slide = new Slide();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slides', 'public');
            $slide->image = $imagePath;
        }
        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->link = $request->link;
        $slide->save();

        return redirect()->route('admin.clientsHome')->with('success', 'Slide created successfully.');
    }

    // Menampilkan form untuk mengedit slide
    public function editHomeContent(Slide $slide)
    {
        return view('admin.content.editSlide', compact('slide'));
    }

    // Memperbarui data slide
    public function updateHomeContent(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);

        if ($request->input('action') == 'update') {
            // Handle Update
            $slide->title = $request->input('title');
            $slide->description = $request->input('description');

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                Storage::delete($slide->image);
                // Simpan gambar baru
                $path = $request->file('image')->store('public');
                $slide->image = str_replace('public/', '', $path);
            }

            $slide->save();

            return redirect()->back()->with('success', 'Konten berhasil diperbarui!');
        } elseif ($request->input('action') == 'delete') {
            // Handle Delete
            Storage::delete($slide->image); // Hapus gambar dari storage
            $slide->delete(); // Hapus data dari database

            return redirect()->back()->with('success', 'Konten berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Aksi tidak valid.');
    }

    public function clientsDomain()
    {
        return view('admin.content.clientsDomain');
    }
    public function clientsDomainKebijakan()
    {
        $domains = DomainKebijakan::all();
        return view('admin.content.clientsDomainKebijakan', compact('domains'));
    }
    public function storeDomainKebijakan(Request $request)
    {
        // Validasi input
        $request->validate([
            'aspect_name' => 'required|string|max:255', // Tambahkan panjang maksimum
            'indicators' => 'required|array|min:1', // Memastikan ada minimal satu indikator
            'indicators.*' => 'string|max:255', // Validasi panjang indikator
        ]);

        // Menyimpan Domain Kebijakan
        $domain = new DomainKebijakan();
        $domain->aspect_name = $request->input('aspect_name');
        $domain->indicators = json_encode($request->input('indicators')); // Menyimpan indikator sebagai JSON
        $domain->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.domain.kebijakan')->with('success', 'Domain Kebijakan berhasil disimpan.');
    }
    public function updateDomainKebijakan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'aspect_name' => 'required|string|max:255', // Validasi panjang maksimal
            'indicators' => 'required|array|min:1', // Memastikan ada minimal satu indikator
            'indicators.*' => 'string|max:255', // Validasi panjang indikator
        ]);

        try {
            // Menemukan data domain berdasarkan ID
            $domain = DomainKebijakan::findOrFail($id);

            // Memperbarui data domain kebijakan
            $domain->aspect_name = $request->input('aspect_name');
            $domain->indicators = json_encode($request->input('indicators')); // Menyimpan indikator sebagai JSON
            $domain->save();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.domain.kebijakan')->with('success', 'Domain Kebijakan berhasil diperbarui.');
        } catch (\Exception $e) {
            // Menangani jika ID tidak ditemukan atau terjadi kesalahan
            return redirect()->route('admin.domain.kebijakan')->with('error', 'Terjadi kesalahan saat memperbarui domain kebijakan.');
        }
    }
    public function deleteDomainKebijakan($id)
    {
        try {
            // Menemukan domain kebijakan berdasarkan ID dan menghapusnya
            $domain = DomainKebijakan::findOrFail($id);
            $domain->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.domain.kebijakan')->with('success', 'Domain Kebijakan berhasil dihapus.');
        } catch (\Exception $e) {
            // Menangani jika ID tidak ditemukan atau terjadi kesalahan
            return redirect()->route('admin.domain.kebijakan')->with('error', 'Terjadi kesalahan saat menghapus domain kebijakan.');
        }
    }




    public function clientsDomainTatakelola()
    {
        $domains = DomainTatakelola::all();
        return view('admin.content.clientsDomainTatakelola', compact('domains'));
    }
    public function storeDomainTatakelola(Request $request)
    {
        // Validasi input
        $request->validate([
            'aspect_name' => 'required|string|max:255', // Tambahkan panjang maksimum
            'indicators' => 'required|array|min:1', // Memastikan ada minimal satu indikator
            'indicators.*' => 'string|max:255', // Validasi panjang indikator
        ]);

        // Menyimpan Domain Tatakelola
        $domain = new DomainTatakelola();
        $domain->aspect_name = $request->input('aspect_name');
        $domain->indicators = json_encode($request->input('indicators')); // Menyimpan indikator sebagai JSON
        $domain->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.domain.tatakelola')->with('success', 'Domain Tatakelola berhasil disimpan.');
    }
    public function updateDomainTatakelola(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'aspect_name' => 'required|string|max:255', // Validasi panjang maksimal
            'indicators' => 'required|array|min:1', // Memastikan ada minimal satu indikator
            'indicators.*' => 'string|max:255', // Validasi panjang indikator
        ]);

        try {
            // Menemukan data domain berdasarkan ID
            $domain = DomainTatakelola::findOrFail($id);

            // Memperbarui data domain tatakelola
            $domain->aspect_name = $request->input('aspect_name');
            $domain->indicators = json_encode($request->input('indicators')); // Menyimpan indikator sebagai JSON
            $domain->save();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.domain.tatakelola')->with('success', 'Domain Tatakelola berhasil diperbarui.');
        } catch (\Exception $e) {
            // Menangani jika ID tidak ditemukan atau terjadi kesalahan
            return redirect()->route('admin.domain.tatakelola')->with('error', 'Terjadi kesalahan saat memperbarui domain tatakelola.');
        }
    }
    public function deleteDomainTatakelola($id)
    {
        try {
            // Menemukan domain tatakelola berdasarkan ID dan menghapusnya
            $domain = DomainTatakelola::findOrFail($id);
            $domain->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.domain.tatakelola')->with('success', 'Domain Tatakelola berhasil dihapus.');
        } catch (\Exception $e) {
            // Menangani jika ID tidak ditemukan atau terjadi kesalahan
            return redirect()->route('admin.domain.tatakelola')->with('error', 'Terjadi kesalahan saat menghapus domain tatakelola.');
        }
    }

    public function clientsDomainManajemen()
    {
        $domains = DomainManajemen::all();
        return view('admin.content.clientsDomainManajemen', compact('domains'));
    }

    public function storeDomainManajemen(Request $request)
    {
        // Validasi input
        $request->validate([
            'aspect_name' => 'required|string|max:255', // Tambahkan panjang maksimum
            'indicators' => 'required|array|min:1', // Memastikan ada minimal satu indikator
            'indicators.*' => 'string|max:255', // Validasi panjang indikator
        ]);

        // Menyimpan Domain Manajemen
        $domain = new DomainManajemen();
        $domain->aspect_name = $request->input('aspect_name');
        $domain->indicators = json_encode($request->input('indicators')); // Menyimpan indikator sebagai JSON
        $domain->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.domain.manajemen')->with('success', 'Domain Manajemen berhasil disimpan.');
    }
    public function updateDomainManajemen(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'aspect_name' => 'required|string|max:255', // Validasi panjang maksimal
            'indicators' => 'required|array|min:1', // Memastikan ada minimal satu indikator
            'indicators.*' => 'string|max:255', // Validasi panjang indikator
        ]);

        try {
            // Menemukan data domain berdasarkan ID
            $domain = DomainManajemen::findOrFail($id);

            // Memperbarui data domain manajemen
            $domain->aspect_name = $request->input('aspect_name');
            $domain->indicators = json_encode($request->input('indicators')); // Menyimpan indikator sebagai JSON
            $domain->save();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.domain.manajemen')->with('success', 'Domain Manajemen berhasil diperbarui.');
        } catch (\Exception $e) {
            // Menangani jika ID tidak ditemukan atau terjadi kesalahan
            return redirect()->route('admin.domain.manajemen')->with('error', 'Terjadi kesalahan saat memperbarui domain manajemen.');
        }
    }
    public function deleteDomainManajemen($id)
    {
        try {
            // Menemukan domain manajemen berdasarkan ID dan menghapusnya
            $domain = DomainManajemen::findOrFail($id);
            $domain->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.domain.manajemen')->with('success', 'Domain Manajemen berhasil dihapus.');
        } catch (\Exception $e) {
            // Menangani jika ID tidak ditemukan atau terjadi kesalahan
            return redirect()->route('admin.domain.manajemen')->with('error', 'Terjadi kesalahan saat menghapus domain manajemen.');
        }
    }

    public function clientsDomainLayanan()
    {
        $domains = DomainLayanan::all();
        return view('admin.content.clientsDomainLayanan', compact('domains'));
    } 

    public function storeDomainLayanan(Request $request)
    {
        // Validasi input
        $request->validate([
            'aspect_name' => 'required|string|max:255', // Tambahkan panjang maksimum
            'indicators' => 'required|array|min:1', // Memastikan ada minimal satu indikator
            'indicators.*' => 'string|max:255', // Validasi panjang indikator
        ]);

        // Menyimpan Domain Layanan
        $domain = new DomainLayanan();
        $domain->aspect_name = $request->input('aspect_name');
        $domain->indicators = json_encode($request->input('indicators')); // Menyimpan indikator sebagai JSON
        $domain->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.domain.layanan')->with('success', 'Domain Layanan berhasil disimpan.');
    }
    public function updateDomainLayanan(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'aspect_name' => 'required|string|max:255', // Validasi panjang maksimal
            'indicators' => 'required|array|min:1', // Memastikan ada minimal satu indikator
            'indicators.*' => 'string|max:255', // Validasi panjang indikator
        ]);

        try {
            // Menemukan data domain berdasarkan ID
            $domain = DomainLayanan::findOrFail($id);

            // Memperbarui data domain layanan
            $domain->aspect_name = $request->input('aspect_name');
            $domain->indicators = json_encode($request->input('indicators')); // Menyimpan indikator sebagai JSON
            $domain->save();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.domain.layanan')->with('success', 'Domain Layanan berhasil diperbarui.');
        } catch (\Exception $e) {
            // Menangani jika ID tidak ditemukan atau terjadi kesalahan
            return redirect()->route('admin.domain.layanan')->with('error', 'Terjadi kesalahan saat memperbarui domain layanan.');
        }
    }
    public function deleteDomainLayanan($id)
    {
        try {
            // Menemukan domain layanan berdasarkan ID dan menghapusnya
            $domain = DomainLayanan::findOrFail($id);
            $domain->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('admin.domain.layanan')->with('success', 'Domain Layanan berhasil dihapus.');
        } catch (\Exception $e) {
            // Menangani jika ID tidak ditemukan atau terjadi kesalahan
            return redirect()->route('admin.domain.layanan')->with('error', 'Terjadi kesalahan saat menghapus domain layanan.');
        }
    }

    // Menampilkan halaman artikel
    public function clientsArticle()
    {
        $articles = Article::all(); // Ambil semua artikel
        return view('admin.content.clientsArticle', compact('articles'));
    }

    // Menyimpan artikel baru
    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:1024',
            'image_source' => 'nullable|string|max:255',
            
        ]);
    
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles','public');
        }
    
        Article::create($validated);
    
        return redirect()->back()->with('success','Artikel Berhasil Ditambahkan!');
    }
    


    // Mengupdate artikel
    public function updateArticle(Request $request, $id)
    {
        // Menemukan artikel berdasarkan ID
        $article = Article::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024',
            'image_source' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        // Update data artikel
        $article->title = $validated['title'];
        $article->category = $validated['category'];
        $article->content = $validated['content'];
        $article->image_source = $validated['image_source'];

        // Jika ada gambar baru yang diunggah, hapus gambar lama & simpan yang baru
        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image); // Hapus gambar lama
            }
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }

        $article->save();

        return redirect()->route('clients.article')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Menghapus artikel
    public function deleteArticle($id)
    {
        // Menemukan artikel berdasarkan ID
        $article = Article::findOrFail($id);

        // Hapus gambar jika ada
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        // Hapus artikel dari database
        $article->delete();

        return redirect()->route('clients.article')->with('success', 'Artikel berhasil dihapus!');
    }

     // Menampilkan halaman clientsAbout dengan data Material & Regulation
    public function clientsAbout()
    {
        return view('admin.content.clientsAbout');
    }
     // ===========================
     // CRUD UNTUK MATERIAL
     // ===========================

    public function material() {
        $materials = Material::all();
        return view('admin.content.clientsAboutMaterial', compact('materials'));
    }

    // Menyimpan materi baru
    public function storeMaterial(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan file ke storage/public/materials dan dapatkan path-nya
        $filePath = $request->file('file')->store('materials', 'public');

        // Simpan data ke database
        Material::create([
            'name' => $request->name, // Menyimpan nama materi
            'download_link' => $filePath, // Menyimpan path file
        ]);

    return redirect()->back()->with('success', 'Materi berhasil diunggah!');
    }

    // Memperbarui materi yang ada
    public function updateMaterial(Request $request, $id)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $material = Material::findOrFail($id);

    // Jika ada file baru, hapus yang lama dan simpan yang baru
    if ($request->hasFile('file')) {
        Storage::disk('public')->delete($material->download_link);
        $filePath = $request->file('file')->store('materials', 'public');
        $material->download_link = $filePath;
        }

        $material->name = $request->name;
        $material->updated_at = now();
        $material->save();

    return redirect()->back()->with('success', 'Materi berhasil diperbarui!');
    }

    // Menghapus materi
    public function destroyMaterial($id)
    {
        $material = Material::findOrFail($id);
        // Hapus file dari storage
        Storage::disk('public')->delete($material->download_link);
        
        // Hapus data dari database
        $material->delete();

    return redirect()->back()->with('success', 'Materi berhasil dihapus!');
    } 

     // ===========================
     // CRUD UNTUK REGULATION
     // ===========================

    // Fungsi untuk menampilkan halaman regulasi
public function regulasi()
{
    $regulations = Regulation::all(); // Ambil semua data regulasi
    return view('admin.content.clientsAboutRegulasi', compact('regulations'));
}

// Fungsi untuk menyimpan regulasi baru
public function storeRegulation(Request $request)
{
    $request->validate([
        'category' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'file' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    // Simpan file ke storage dan dapatkan path-nya
    $filePath = $request->file('file')->store('regulations', 'public');

    // Simpan data ke database
    Regulation::create([
        'title' => $request->title,
        'category' => $request->category,
        'file_path' => $filePath,
    ]);

    return redirect()->route('admin.regulasi')->with('success', 'Regulasi berhasil ditambahkan');
}

// Fungsi untuk memperbarui regulasi
public function updateRegulation(Request $request, $id)
{
    $regulation = Regulation::findOrFail($id);

    $request->validate([
        'category' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
    ]);

    // Jika ada file baru, simpan dan update path
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('regulations', 'public');
        $regulation->file_path = $filePath;
    }

    $regulation->title = $request->title;
    $regulation->category = $request->category;
    $regulation->save();

    return redirect()->route('admin.regulasi')->with('success', 'Regulasi berhasil diperbarui');
}

// Fungsi untuk menghapus regulasi
public function deleteRegulation($id)
{
    $regulation = Regulation::findOrFail($id);

    // Hapus file dari storage jika ada
    if ($regulation->file_path) {
        Storage::disk('public')->delete($regulation->file_path);
    }

    // Hapus data dari database
    $regulation->delete();

    return redirect()->route('admin.regulasi')->with('success', 'Regulasi berhasil dihapus');
}




protected $skpdOptions = [
    '1' => 'Test 1',
    '2' => 'Test 2',
    '3' => 'Test 3',
];

protected $serviceOptions = [
    '1' => 'Pelayanan',
    '2' => 'Administrasi',
];

/**
 * Menampilkan halaman aplikasi
 */
public function application()
{
    $aplikasi = Application::all(); // Ambil semua data aplikasi

    return view('admin.content.application', [
        'skpdOptions'    => $this->skpdOptions,
        'serviceOptions' => $this->serviceOptions,
        'aplikasi'       => $aplikasi // Kirim data ke view
    ]);
}

/**
 * Menyimpan aplikasi baru ke database
 */
public function storeApplication(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_aplikasi' => 'required|string|max:255',
        'skpd_pemilik' => 'required|string|max:255',
        'jenis_layanan' => 'required|string|max:255',
        'spesifikasi_layanan' => 'nullable|string|max:255',
        'alamat_website' => 'nullable|string|max:255',
        'nama_pic' => 'required|string|max:255',
        'kontak_wa' => 'required|string|max:20',
    ]);

    // Simpan ke database
    Application::create([
        'nama_aplikasi' => $request->input('nama_aplikasi'),
        'skpd_pemilik' => $request->input('skpd_pemilik'),
        'jenis_layanan' => $request->input('jenis_layanan'),
        'spesifikasi_layanan' => $request->input('spesifikasi_layanan'),
        'alamat_website' => $request->input('alamat_website'),
        'nama_pic' => $request->input('nama_pic'),
        'kontak_wa' => $request->input('kontak_wa'),
    ]);

    // Redirect kembali ke halaman dengan pesan sukses
    return redirect()->route('applications.index')->with('success', 'Aplikasi berhasil ditambahkan');
}

/**
 * Mengupdate data aplikasi berdasarkan ID
 */
public function updateApplication(Request $request, $id)
{
    $request->validate([
        'nama_aplikasi' => 'required|string|max:255',
        'skpd_pemilik' => 'required|string|max:255',
        'jenis_layanan' => 'required|string|max:255',
        'spesifikasi_layanan' => 'nullable|string|max:255',
        'alamat_website' => 'nullable|string|max:255',
        'nama_pic' => 'required|string|max:255',
        'kontak_wa' => 'required|string|max:20',
    ]);

    $application = Application::findOrFail($id);
    $application->update($request->all());

    return redirect()->route('applications.index')->with('success', 'Aplikasi berhasil diperbarui');
}

/**
 * Menghapus aplikasi berdasarkan ID
 */
public function deleteApplication($id)
{
    $application = Application::findOrFail($id);
    $application->delete();

    return redirect()->route('applications.index')->with('success', 'Aplikasi berhasil dihapus');
}

    public function profile()
    {
        return view('admin.content.profile');
    }

    public function login()
    {
        return view('admin.content.login');
    }

    public function signup()
    {
        return view('admin.content.signup');
    }
}
