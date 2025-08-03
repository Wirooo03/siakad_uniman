<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Mahasiswa;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Health check endpoint
Route::get('/health', function () {
    try {
        $dbStatus = DB::connection()->getPdo() ? 'connected' : 'disconnected';
        $mahasiswaCount = Mahasiswa::count();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Backend is running',
            'database' => $dbStatus,
            'mahasiswa_count' => $mahasiswaCount,
            'timestamp' => now()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Database connection failed',
            'error' => $e->getMessage(),
            'timestamp' => now()
        ], 500);
    }
});

// Test route untuk memastikan API berjalan
Route::get('/test', function () {
    try {
        // Test database connection
        $connection = DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        
        return response()->json([
            'message' => 'API is working!',
            'timestamp' => now(),
            'status' => 'success',
            'database' => [
                'type' => 'MySQL',
                'connection' => config('database.default'),
                'database' => $dbName,
                'host' => config('database.connections.mysql.host'),
                'connected' => $connection ? true : false
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Database connection failed',
            'error' => $e->getMessage(),
            'status' => 'error'
        ], 500);
    }
});

// Routes untuk mahasiswa (menggunakan database real)
Route::prefix('mahasiswa')->group(function () {
    // Debug endpoint
    Route::get('/debug', function () {
        try {
            $mahasiswaCount = Mahasiswa::count();
            $sampleData = Mahasiswa::first();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Debug mahasiswa endpoint',
                'data' => [
                    'total_mahasiswa' => $mahasiswaCount,
                    'sample_data' => $sampleData,
                    'table_exists' => Schema::hasTable('mahasiswa')
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Debug failed',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    });

    // Get all mahasiswa with pagination and search
    Route::get('/', function (Request $request) {
        try {
            // Get pagination parameters from request
            $perPage = $request->get('per_page', 10); // Default 10 jika tidak ada
            $page = $request->get('page', 1); // Default page 1
            $search = $request->get('search', ''); // Search parameter
            $jenjang = $request->get('jenjang', ''); // Jenjang filter
            
            // Validate per_page parameter
            $perPage = min(max(1, (int)$perPage), 100); // Min 1, Max 100
            
            // Build query with search functionality
            $query = Mahasiswa::query();
            
            // Apply search filter if provided
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('nama', 'ILIKE', '%' . $search . '%')
                      ->orWhere('nim', 'ILIKE', '%' . $search . '%')
                      ->orWhere('jurusan', 'ILIKE', '%' . $search . '%')
                      ->orWhere('email', 'ILIKE', '%' . $search . '%');
                });
            }
            
            // Apply jenjang filter if provided (though we don't have jenjang in DB yet)
            if (!empty($jenjang) && $jenjang !== '-- Semua --') {
                // For now, we'll ignore this since jenjang is not in our DB
                // You can add this when you have a jenjang column
            }
            
            $mahasiswa = $query->paginate($perPage);
            
            // Transform data to match frontend format
            $transformedData = $mahasiswa->getCollection()->map(function($item) {
                return [
                    'id' => $item->id,
                    'nim' => $item->nim,
                    'nama' => strtoupper($item->nama),
                    'jenjang' => 'S1', // Default since not in DB
                    'programStudi' => 'PROGRAM STUDI S1 ' . strtoupper($item->jurusan),
                    'masuk' => date('Y') . 'I', // Default format
                    'status' => $item->status === 'aktif' ? 'A' : 'C',
                    'smt' => $item->semester,
                    'sks' => 0, // Default since not in DB
                    'ipk' => '0.00', // Default since not in DB
                    'email' => $item->email,
                    'alamat' => $item->alamat,
                    'telepon' => $item->telepon,
                    'tanggal_masuk' => $item->tanggal_masuk
                ];
            });
            
            return response()->json([
                'data' => $transformedData,
                'debug' => [
                    'search_term' => $search,
                    'jenjang_filter' => $jenjang,
                    'per_page' => $perPage,
                    'current_page' => $page
                ],
                'meta' => [
                    'current_page' => $mahasiswa->currentPage(),
                    'last_page' => $mahasiswa->lastPage(),
                    'per_page' => $mahasiswa->perPage(),
                    'total' => $mahasiswa->total(),
                    'from' => $mahasiswa->firstItem(),
                    'to' => $mahasiswa->lastItem()
                ],
                'message' => 'Data mahasiswa berhasil diambil',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil data mahasiswa',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => basename($e->getFile()),
                'status' => 'error'
            ], 500);
        }
    });

    // POST - Add new mahasiswa
    Route::post('/', function (Request $request) {
        try {
            // Validasi input dasar
            $request->validate([
                'nim' => 'required|string|unique:mahasiswa,nim',
                'nama' => 'required|string|max:255',
                'jurusan' => 'required|string|max:255',
                'email' => 'nullable|email',
                'telepon' => 'nullable|string',
                'alamat' => 'nullable|string',
                // Field tambahan (opsional)
                'program_studi' => 'nullable|string',
                'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
                'tempat_lahir' => 'nullable|string',
                'tanggal_lahir' => 'nullable|date',
                'agama' => 'nullable|string',
                'email_kampus' => 'nullable|email',
                'email_pribadi' => 'nullable|email',
                'no_hp' => 'nullable|string'
            ]);

            // Create new mahasiswa dengan field extended
            $mahasiswa = new Mahasiswa();
            $mahasiswa->nim = $request->input('nim');
            $mahasiswa->nama = $request->input('nama');
            $mahasiswa->jurusan = $request->input('jurusan');
            $mahasiswa->email = $request->input('email');
            $mahasiswa->telepon = $request->input('telepon');
            $mahasiswa->alamat = $request->input('alamat');
            $mahasiswa->status = 'aktif'; // Default status
            $mahasiswa->semester = 1; // Default semester
            $mahasiswa->tanggal_masuk = now();
            
            // Field tambahan jika ada
            if ($request->has('program_studi')) {
                $mahasiswa->program_studi = $request->input('program_studi');
            }
            if ($request->has('jenis_kelamin')) {
                $mahasiswa->jenis_kelamin = $request->input('jenis_kelamin');
            }
            if ($request->has('tempat_lahir')) {
                $mahasiswa->tempat_lahir = $request->input('tempat_lahir');
            }
            if ($request->has('tanggal_lahir')) {
                $mahasiswa->tanggal_lahir = $request->input('tanggal_lahir');
            }
            if ($request->has('agama')) {
                $mahasiswa->agama = $request->input('agama');
            }
            if ($request->has('email_kampus')) {
                $mahasiswa->email_kampus = $request->input('email_kampus');
            }
            if ($request->has('email_pribadi')) {
                $mahasiswa->email_pribadi = $request->input('email_pribadi');
            }
            if ($request->has('no_hp')) {
                $mahasiswa->no_hp = $request->input('no_hp');
            }
            
            $mahasiswa->save();

            // Transform response
            $transformedData = [
                'id' => $mahasiswa->id,
                'nim' => $mahasiswa->nim,
                'nama' => strtoupper($mahasiswa->nama),
                'jenjang' => 'S1',
                'programStudi' => 'PROGRAM STUDI S1 ' . strtoupper($mahasiswa->jurusan),
                'masuk' => date('Y') . 'I',
                'status' => $mahasiswa->status === 'aktif' ? 'A' : 'C',
                'smt' => $mahasiswa->semester,
                'sks' => 0,
                'ipk' => '0.00',
                'email' => $mahasiswa->email,
                'alamat' => $mahasiswa->alamat,
                'telepon' => $mahasiswa->telepon,
                'tanggal_masuk' => $mahasiswa->tanggal_masuk,
                'jurusan' => $mahasiswa->jurusan,
                'semester' => $mahasiswa->semester
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil ditambahkan',
                'data' => $transformedData
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan mahasiswa',
                'error' => $e->getMessage()
            ], 500);
        }
    });
    
    // Get mahasiswa by ID
    Route::get('/{id}', function ($id) {
        try {
            $mahasiswa = Mahasiswa::with(['domisili', 'orangTua', 'wali', 'perguruanTinggiAsal'])->find($id);
            
            if (!$mahasiswa) {
                return response()->json([
                    'message' => 'Mahasiswa tidak ditemukan',
                    'status' => 'error'
                ], 404);
            }

            // Transform data to match frontend format with all new fields
            $transformedData = [
                'id' => $mahasiswa->id,
                'nim' => $mahasiswa->nim,
                'nama' => strtoupper($mahasiswa->nama),
                'jenjang' => 'S1', // Default since not in DB
                'programStudi' => $mahasiswa->program_studi ?: 'PROGRAM STUDI S1 ' . strtoupper($mahasiswa->jurusan),
                'masuk' => $mahasiswa->periode_masuk ?: (date('Y') . 'I'),
                'status' => $mahasiswa->status === 'aktif' ? 'A' : 'C',
                'smt' => $mahasiswa->semester,
                'sks' => $mahasiswa->sks_total ?: 0,
                'ipk' => number_format($mahasiswa->ipk ?: 0, 2),
                'email' => $mahasiswa->email,
                'alamat' => $mahasiswa->alamat,
                'telepon' => $mahasiswa->telepon,
                'tanggal_masuk' => $mahasiswa->tanggal_masuk,
                'jurusan' => $mahasiswa->jurusan,
                'semester' => $mahasiswa->semester,
                
                // Informasi Pendaftaran Extended
                'konsentrasi' => $mahasiswa->konsentrasi,
                'periode_masuk' => $mahasiswa->periode_masuk,
                'tahun_kurikulum' => $mahasiswa->tahun_kurikulum,
                'sistem_kuliah' => $mahasiswa->sistem_kuliah,
                'kelas_kelompok' => $mahasiswa->kelas_kelompok,
                'jenis_pendaftaran' => $mahasiswa->jenis_pendaftaran,
                'jalur_pendaftaran' => $mahasiswa->jalur_pendaftaran,
                'gelombang' => $mahasiswa->gelombang,
                'kebutuhan_khusus' => $mahasiswa->kebutuhan_khusus,
                'biodata_valid' => $mahasiswa->biodata_valid,
                'kampus' => $mahasiswa->kampus,
                
                // Informasi Umum
                'jenis_kelamin' => $mahasiswa->jenis_kelamin,
                'tempat_lahir' => $mahasiswa->tempat_lahir,
                'tanggal_lahir' => $mahasiswa->tanggal_lahir,
                'agama' => $mahasiswa->agama,
                'suku' => $mahasiswa->suku,
                'berat_badan' => $mahasiswa->berat_badan,
                'tinggi_badan' => $mahasiswa->tinggi_badan,
                'golongan_darah' => $mahasiswa->golongan_darah,
                'transportasi' => $mahasiswa->transportasi,
                
                // Administrasi
                'kewarganegaraan' => $mahasiswa->kewarganegaraan,
                'nik' => $mahasiswa->nik,
                'paspor' => $mahasiswa->paspor,
                'no_kk' => $mahasiswa->no_kk,
                'no_kps' => $mahasiswa->no_kps,
                'status_nikah' => $mahasiswa->status_nikah,
                'ukuran_jas' => $mahasiswa->ukuran_jas,
                'file_akta' => $mahasiswa->file_akta,
                
                // Kontak
                'no_hp' => $mahasiswa->no_hp,
                'kepemilikan_hp' => $mahasiswa->kepemilikan_hp,
                'email_kampus' => $mahasiswa->email_kampus,
                'email_pribadi' => $mahasiswa->email_pribadi,
                
                // Pekerjaan
                'pekerjaan' => $mahasiswa->pekerjaan,
                'instansi_pekerjaan' => $mahasiswa->instansi_pekerjaan,
                'penghasilan' => $mahasiswa->penghasilan,
                
                // Bank
                'no_rekening' => $mahasiswa->no_rekening,
                'nama_rekening' => $mahasiswa->nama_rekening,
                'nama_bank' => $mahasiswa->nama_bank,
                
                // Relasi data (jika ada)
                'domisili' => $mahasiswa->domisili,
                'orang_tua' => $mahasiswa->orangTua,
                'wali' => $mahasiswa->wali,
                'perguruan_tinggi_asal' => $mahasiswa->perguruanTinggiAsal
            ];

            return response()->json([
                'data' => $transformedData,
                'message' => 'Detail mahasiswa berhasil diambil',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil detail mahasiswa',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    });

    // DELETE - Delete mahasiswa by ID
    Route::delete('/{id}', function ($id) {
        try {
            $mahasiswa = Mahasiswa::find($id);
            
            if (!$mahasiswa) {
                return response()->json([
                    'message' => 'Mahasiswa tidak ditemukan',
                    'status' => 'error'
                ], 404);
            }

            // Store data for response before deletion
            $deletedData = [
                'id' => $mahasiswa->id,
                'nim' => $mahasiswa->nim,
                'nama' => $mahasiswa->nama,
                'jurusan' => $mahasiswa->jurusan
            ];

            // Delete the mahasiswa
            $mahasiswa->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil dihapus',
                'deleted_data' => $deletedData
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus mahasiswa',
                'error' => $e->getMessage()
            ], 500);
        }
    });

    // PUT - Update mahasiswa by ID
    Route::put('/{id}', function (Request $request, $id) {
        try {
            $mahasiswa = Mahasiswa::find($id);
            
            if (!$mahasiswa) {
                return response()->json([
                    'message' => 'Mahasiswa tidak ditemukan',
                    'status' => 'error'
                ], 404);
            }

            // Validasi input dasar
            $request->validate([
                'nim' => 'sometimes|required|string|unique:mahasiswa,nim,' . $id,
                'nama' => 'sometimes|required|string|max:255',
                'jurusan' => 'sometimes|required|string|max:255',
                'email' => 'nullable|email',
                'telepon' => 'nullable|string',
                'alamat' => 'nullable|string',
                
                // Extended fields
                'program_studi' => 'nullable|string',
                'konsentrasi' => 'nullable|string',
                'periode_masuk' => 'nullable|string',
                'tahun_kurikulum' => 'nullable|string',
                'sistem_kuliah' => 'nullable|string',
                'kelas_kelompok' => 'nullable|string',
                'jenis_pendaftaran' => 'nullable|string',
                'jalur_pendaftaran' => 'nullable|string',
                'gelombang' => 'nullable|string',
                'kebutuhan_khusus' => 'nullable|string',
                'biodata_valid' => 'nullable|boolean',
                'kampus' => 'nullable|string',
                'tanggal_masuk' => 'nullable|string',
                'status' => 'nullable|string',
                
                // Informasi Umum
                'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
                'tempat_lahir' => 'nullable|string',
                'tanggal_lahir' => 'nullable|date',
                'agama' => 'nullable|string',
                'suku' => 'nullable|string',
                'berat_badan' => 'nullable|integer',
                'tinggi_badan' => 'nullable|integer',
                'golongan_darah' => 'nullable|string',
                'transportasi' => 'nullable|string',
                
                // Administrasi
                'kewarganegaraan' => 'nullable|string',
                'nik' => 'nullable|string',
                'paspor' => 'nullable|string',
                'no_kk' => 'nullable|string',
                'no_kps' => 'nullable|string',
                'status_nikah' => 'nullable|string',
                'ukuran_jas' => 'nullable|string',
                'file_akta' => 'nullable|string',
                
                // Kontak
                'no_hp' => 'nullable|string',
                'kepemilikan_hp' => 'nullable|string',
                'email_kampus' => 'nullable|email',
                'email_pribadi' => 'nullable|email',
                
                // Pekerjaan
                'pekerjaan' => 'nullable|string',
                'instansi_pekerjaan' => 'nullable|string',
                'penghasilan' => 'nullable|string',
                
                // Bank
                'no_rekening' => 'nullable|string',
                'nama_rekening' => 'nullable|string',
                'nama_bank' => 'nullable|string'
            ]);

            // Update basic fields
            if ($request->has('nim')) $mahasiswa->nim = $request->input('nim');
            if ($request->has('nama')) $mahasiswa->nama = $request->input('nama');
            if ($request->has('jurusan')) $mahasiswa->jurusan = $request->input('jurusan');
            if ($request->has('email')) $mahasiswa->email = $request->input('email');
            if ($request->has('telepon')) $mahasiswa->telepon = $request->input('telepon');
            if ($request->has('alamat')) $mahasiswa->alamat = $request->input('alamat');
            if ($request->has('status')) $mahasiswa->status = $request->input('status');
            
            // Update extended fields
            if ($request->has('program_studi')) $mahasiswa->program_studi = $request->input('program_studi');
            if ($request->has('konsentrasi')) $mahasiswa->konsentrasi = $request->input('konsentrasi');
            if ($request->has('periode_masuk')) $mahasiswa->periode_masuk = $request->input('periode_masuk');
            if ($request->has('tahun_kurikulum')) $mahasiswa->tahun_kurikulum = $request->input('tahun_kurikulum');
            if ($request->has('sistem_kuliah')) $mahasiswa->sistem_kuliah = $request->input('sistem_kuliah');
            if ($request->has('kelas_kelompok')) $mahasiswa->kelas_kelompok = $request->input('kelas_kelompok');
            if ($request->has('jenis_pendaftaran')) $mahasiswa->jenis_pendaftaran = $request->input('jenis_pendaftaran');
            if ($request->has('jalur_pendaftaran')) $mahasiswa->jalur_pendaftaran = $request->input('jalur_pendaftaran');
            if ($request->has('gelombang')) $mahasiswa->gelombang = $request->input('gelombang');
            if ($request->has('kebutuhan_khusus')) $mahasiswa->kebutuhan_khusus = $request->input('kebutuhan_khusus');
            if ($request->has('biodata_valid')) $mahasiswa->biodata_valid = $request->input('biodata_valid');
            if ($request->has('kampus')) $mahasiswa->kampus = $request->input('kampus');
            if ($request->has('tanggal_masuk')) $mahasiswa->tanggal_masuk = $request->input('tanggal_masuk');
            
            // Update informasi umum
            if ($request->has('jenis_kelamin')) $mahasiswa->jenis_kelamin = $request->input('jenis_kelamin');
            if ($request->has('tempat_lahir')) $mahasiswa->tempat_lahir = $request->input('tempat_lahir');
            if ($request->has('tanggal_lahir')) $mahasiswa->tanggal_lahir = $request->input('tanggal_lahir');
            if ($request->has('agama')) $mahasiswa->agama = $request->input('agama');
            if ($request->has('suku')) $mahasiswa->suku = $request->input('suku');
            if ($request->has('berat_badan')) $mahasiswa->berat_badan = $request->input('berat_badan');
            if ($request->has('tinggi_badan')) $mahasiswa->tinggi_badan = $request->input('tinggi_badan');
            if ($request->has('golongan_darah')) $mahasiswa->golongan_darah = $request->input('golongan_darah');
            if ($request->has('transportasi')) $mahasiswa->transportasi = $request->input('transportasi');
            
            // Update administrasi
            if ($request->has('kewarganegaraan')) $mahasiswa->kewarganegaraan = $request->input('kewarganegaraan');
            if ($request->has('nik')) $mahasiswa->nik = $request->input('nik');
            if ($request->has('paspor')) $mahasiswa->paspor = $request->input('paspor');
            if ($request->has('no_kk')) $mahasiswa->no_kk = $request->input('no_kk');
            if ($request->has('no_kps')) $mahasiswa->no_kps = $request->input('no_kps');
            if ($request->has('status_nikah')) $mahasiswa->status_nikah = $request->input('status_nikah');
            if ($request->has('ukuran_jas')) $mahasiswa->ukuran_jas = $request->input('ukuran_jas');
            if ($request->has('file_akta')) $mahasiswa->file_akta = $request->input('file_akta');
            
            // Update kontak
            if ($request->has('no_hp')) $mahasiswa->no_hp = $request->input('no_hp');
            if ($request->has('kepemilikan_hp')) $mahasiswa->kepemilikan_hp = $request->input('kepemilikan_hp');
            if ($request->has('email_kampus')) $mahasiswa->email_kampus = $request->input('email_kampus');
            if ($request->has('email_pribadi')) $mahasiswa->email_pribadi = $request->input('email_pribadi');
            
            // Update pekerjaan
            if ($request->has('pekerjaan')) $mahasiswa->pekerjaan = $request->input('pekerjaan');
            if ($request->has('instansi_pekerjaan')) $mahasiswa->instansi_pekerjaan = $request->input('instansi_pekerjaan');
            if ($request->has('penghasilan')) $mahasiswa->penghasilan = $request->input('penghasilan');
            
            // Update bank
            if ($request->has('no_rekening')) $mahasiswa->no_rekening = $request->input('no_rekening');
            if ($request->has('nama_rekening')) $mahasiswa->nama_rekening = $request->input('nama_rekening');
            if ($request->has('nama_bank')) $mahasiswa->nama_bank = $request->input('nama_bank');
            
            $mahasiswa->save();

            // Transform response
            $transformedData = [
                'id' => $mahasiswa->id,
                'nim' => $mahasiswa->nim,
                'nama' => strtoupper($mahasiswa->nama),
                'jenjang' => 'S1',
                'programStudi' => 'PROGRAM STUDI S1 ' . strtoupper($mahasiswa->jurusan),
                'masuk' => date('Y') . 'I',
                'status' => $mahasiswa->status === 'aktif' ? 'A' : 'C',
                'smt' => $mahasiswa->semester,
                'sks' => 0,
                'ipk' => '0.00',
                'email' => $mahasiswa->email,
                'alamat' => $mahasiswa->alamat,
                'telepon' => $mahasiswa->telepon,
                'tanggal_masuk' => $mahasiswa->tanggal_masuk,
                'jurusan' => $mahasiswa->jurusan,
                'semester' => $mahasiswa->semester
            ];

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil diupdate',
                'data' => $transformedData
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengupdate mahasiswa',
                'error' => $e->getMessage()
            ], 500);
        }
    });

    // Get mahasiswa by jurusan
    Route::get('/jurusan/{jurusan}', function ($jurusan) {
        try {
            $mahasiswa = Mahasiswa::jurusan($jurusan)->get();
            return response()->json([
                'data' => $mahasiswa,
                'total' => $mahasiswa->count(),
                'jurusan' => $jurusan,
                'message' => 'Data mahasiswa berdasarkan jurusan berhasil diambil',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil data mahasiswa berdasarkan jurusan',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    });

    // Get mahasiswa aktif saja
    Route::get('/status/aktif', function () {
        try {
            $mahasiswa = Mahasiswa::aktif()->get();
            return response()->json([
                'data' => $mahasiswa,
                'total' => $mahasiswa->count(),
                'message' => 'Data mahasiswa aktif berhasil diambil',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengambil data mahasiswa aktif',
                'error' => $e->getMessage(),
                'status' => 'error'
            ], 500);
        }
    });
});
