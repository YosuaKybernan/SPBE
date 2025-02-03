<?php

namespace App\Http\Controllers;

use App\Models\Aspect;
use App\Models\Indicator;
use App\Models\Slide; //masukan model slide
use App\Models\Article; //masukan model article
use App\Models\Material; //masukan model article
use App\Models\Regulation; //masukan model article
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
        $materials = Material::all();
        $regulations = Regulation::all();

        return view('admin.content.clientsAbout', compact('materials', 'regulations'));
    }

     // ===========================
     // CRUD UNTUK MATERIAL
     // ===========================

     public function storeClientsAbout(Request $request)
     {
         $request->validate([
             'type' => 'required|in:material,regulation',
             'material_name' => 'nullable|required_if:type,material|max:255',
             'material_file' => 'nullable|required_if:type,material|file|mimes:pdf,doc,docx|max:2048',
             'regulation_category' => 'nullable|required_if:type,regulation|max:255',
             'regulation_title' => 'nullable|required_if:type,regulation|max:255',
             'regulation_file' => 'nullable|required_if:type,regulation|file|mimes:pdf,doc,docx|max:2048',
         ]);
     
         if ($request->type === 'material') {
             // Simpan Material
             $filePath = $request->file('material_file')->store('materials', 'public');
     
             Material::create([
                 'name' => $request->material_name,
                 'download_link' => $filePath,
             ]);
     
             return redirect()->back()->with('success', 'Material berhasil ditambahkan!');
         } elseif ($request->type === 'regulation') {
             // Simpan Regulation
             $filePath = $request->file('regulation_file')->store('regulations', 'public');
     
             Regulation::create([
                 'category' => $request->regulation_category,
                 'title' => $request->regulation_title,
                 'file_path' => $filePath,
             ]);
     
             return redirect()->back()->with('success', 'Regulasi berhasil ditambahkan!');
         }
     
         return redirect()->back()->with('error', 'Terjadi kesalahan.');
     }
     
     // Menyimpan Material baru
    public function storeMaterial(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = $request->file('file')->store('materials', 'public');

        Material::create([
            'name' => $request->name,
            'download_link' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Material berhasil ditambahkan!');
    }

     // Mengupdate Material
    public function updateMaterial(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $material = Material::findOrFail($id);
        $material->name = $request->name;

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($material->download_link);
            $filePath = $request->file('file')->store('materials', 'public');
            $material->download_link = $filePath;
        }

        $material->save();

        return redirect()->back()->with('success', 'Material berhasil diperbarui!');
    }

     // Menghapus Material
    public function destroyMaterial($id)
    {
        $material = Material::findOrFail($id);
        Storage::disk('public')->delete($material->download_link);
        $material->delete();

        return redirect()->back()->with('success', 'Material berhasil dihapus!');
    }

     // ===========================
     // CRUD UNTUK REGULATION
     // ===========================

     // Menyimpan Regulation baru
    public function storeRegulation(Request $request)
    {
        $request->validate([
            'category' => 'required|max:255',
            'title' => 'required|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = $request->file('file')->store('regulations', 'public');

        Regulation::create([
            'category' => $request->category,
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Regulasi berhasil ditambahkan!');
    }

     // Mengupdate Regulation
    public function updateRegulation(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|max:255',
            'title' => 'required|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $regulation = Regulation::findOrFail($id);
        $regulation->category = $request->category;
        $regulation->title = $request->title;

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($regulation->file_path);
            $filePath = $request->file('file')->store('regulations', 'public');
            $regulation->file_path = $filePath;
        }

        $regulation->save();

        return redirect()->back()->with('success', 'Regulasi berhasil diperbarui!');
    }

     // Menghapus Regulation
    public function destroyRegulation($id)
    {
        $regulation = Regulation::findOrFail($id);
        Storage::disk('public')->delete($regulation->file_path);
        $regulation->delete();

        return redirect()->back()->with('success', 'Regulasi berhasil dihapus!');
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

    public function application()
    {
        return view('admin.content.application', [
            'skpdOptions' => $this->skpdOptions,
            'serviceOptions' => $this->serviceOptions
        ]);
    }

    public function storeApplication(Request $request)
    {
        $appName = $request->input('appName');
        $skpdValue = $request->input('skpdValue');
        $newSKPDInput = $request->input('newSKPDInput');
        $serviceValue = $request->input('serviceValue');
        $newServiceInput = $request->input('newServiceInput');

        if ($skpdValue === 'new' && !empty($newSKPDInput)) {
            $newKey = count($this->skpdOptions) + 1;
            $this->skpdOptions[$newKey] = $newSKPDInput;
        }

        if ($serviceValue === 'new' && !empty($newServiceInput)) {
            $newKey = count($this->serviceOptions) + 1;
            $this->serviceOptions[$newKey] = $newServiceInput;
        }

        // Save the new application details
        // $appName, $skpdValue (or $newSKPDInput if new), and $serviceValue (or $newServiceInput if new) can be stored in the database

        return response()->json(['status' => 'success', 'message' => 'Application saved successfully']);
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
