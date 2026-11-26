<?php

namespace App\Http\Controllers;

use App\Models\Varan;
use App\Models\User;
use App\Models\MatrimonyMasterOption;
use App\Support\MatrimonyConstants;
use App\Services\BiodataParserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class VaranController extends Controller
{
    /**
     * Show dedicated Matrimony Login Page
     */
    public function showLogin()
    {
        // If coming with an error or invalid login attempt, guarantee unauthenticated state
        if (session()->has('error')) {
            session()->forget(['matrimony_auth', 'matrimony_user']);
        } elseif (session('matrimony_auth') && !empty(session('matrimony_user'))) {
            return redirect()->route('matrimony.portal');
        }

        $savedUser = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_username')->first();
        $savedPass = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_password')->first();
        $savedRawPass = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_raw_password')->first();
        $hasCustomCredentials = ($savedUser !== null || $savedPass !== null);
        $currentUsername = ($savedUser && !empty(trim($savedUser->name_en))) ? trim($savedUser->name_en) : 'admin';
        $currentPassword = ($savedRawPass && !empty($savedRawPass->name_en)) ? $savedRawPass->name_en : 'password';

        return view('varans.login', compact('hasCustomCredentials', 'currentUsername', 'currentPassword'));
    }

    /**
     * Handle Login
     */
    public function doLogin(Request $request)
    {
        // Immediately wipe any lingering auth session on any login attempt
        session()->forget(['matrimony_auth', 'matrimony_user']);

        $id = trim((string)$request->input('username'));
        $pwd = (string)$request->input('password');

        if ($id === '' || $pwd === '') {
            return redirect()->route('matrimony.login')->with('error', 'தயவுசெய்து ID மற்றும் கடவுச்சொல்லை உள்ளிடவும்! (Please enter ID and Password)');
        }

        // 1. Fetch custom configured credentials from database
        $savedUser = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_username')->first();
        $savedPass = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_password')->first();
        $savedRawPass = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_raw_password')->first();
        $savedEmail = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_email')->first();

        $configuredUsername = ($savedUser && !empty(trim($savedUser->name_en))) ? trim($savedUser->name_en) : 'admin';
        $configuredEmail = ($savedEmail && !empty(trim($savedEmail->name_en))) ? trim($savedEmail->name_en) : null;
        $configuredPassword = ($savedPass && !empty($savedPass->name_en)) ? $savedPass->name_en : null;
        $configuredRawPassword = ($savedRawPass && !empty($savedRawPass->name_en)) ? $savedRawPass->name_en : null;

        $hasCustomCredentials = ($savedUser !== null || $savedPass !== null || $savedRawPass !== null);

        $isAuthenticated = false;

        // Check if entered ID matches configured admin username or registered recovery email (case-insensitive for username/email)
        $isUsernameMatch = (strcasecmp($id, $configuredUsername) === 0);
        if (!$isUsernameMatch && $configuredEmail && strcasecmp($id, $configuredEmail) === 0) {
            $isUsernameMatch = true;
        }

        if ($isUsernameMatch) {
            if ($configuredRawPassword !== null && $configuredRawPassword !== '') {
                // When raw password is set, require STRICT EXACT CASE-SENSITIVE match
                if ($pwd === $configuredRawPassword) {
                    $isAuthenticated = true;
                }
            } elseif ($configuredPassword) {
                // Otherwise verify against bcrypt hash (strictly case-sensitive)
                if (Hash::check($pwd, $configuredPassword) || password_verify($pwd, $configuredPassword)) {
                    $isAuthenticated = true;
                }
            } else {
                // Only if NO custom password has ever been configured (default: 'password')
                if ($pwd === 'password') {
                    $isAuthenticated = true;
                }
            }
        }

        // Check standard Laravel User table ONLY if no custom admin_auth credentials exist in database
        if (!$isAuthenticated && !$hasCustomCredentials && $isUsernameMatch) {
            $userRecord = User::where(function($q) use ($configuredUsername, $configuredEmail) {
                $q->where('name', $configuredUsername);
                if ($configuredEmail) {
                    $q->orWhere('email', $configuredEmail);
                }
            })->first();

            if ($userRecord && !empty($userRecord->password)) {
                if (Hash::check($pwd, $userRecord->password)) {
                    $isAuthenticated = true;
                }
            }
        }

        // If authenticated, register fresh session and redirect
        if ($isAuthenticated) {
            session(['matrimony_auth' => true, 'matrimony_user' => $configuredUsername]);
            return redirect()->route('matrimony.portal');
        }

        // Strictly reject ANY invalid ID or wrong password
        session()->forget(['matrimony_auth', 'matrimony_user']);
        return redirect()->route('matrimony.login')->with('error', 'தவறான ID அல்லது கடவுச்சொல்! (Invalid ID or Password)');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        session()->forget(['matrimony_auth', 'matrimony_user']);
        session()->flush();
        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('matrimony.login');
    }

    /**
     * Dedicated Single Matrimony Dashboard & Form
     */
    public function portal(Request $request)
    {
        if (!session('matrimony_auth')) {
            return redirect()->route('matrimony.login');
        }

        $rasisTa = MatrimonyConstants::rasis('ta');
        $rasisEn = MatrimonyConstants::rasis('en');
        $starsTa = MatrimonyConstants::natchathirams('ta');
        $starsEn = MatrimonyConstants::natchathirams('en');
        $lagnamsTa = MatrimonyConstants::lagnams('ta');
        $lagnamsEn = MatrimonyConstants::lagnams('en');
        $dbCommunities = MatrimonyMasterOption::getOptionsForCategory('community', 'ta');
        $communitiesTa = !empty($dbCommunities) ? $dbCommunities : MatrimonyConstants::communities('ta');
        $communitiesEn = MatrimonyConstants::communities('en');

        $dbEducations = MatrimonyMasterOption::getOptionsForCategory('education', 'ta');
        $educationsTa = !empty($dbEducations) ? $dbEducations : MatrimonyConstants::educations('ta');
        $educationsEn = MatrimonyConstants::educations('en');

        $dbJobs = MatrimonyMasterOption::getOptionsForCategory('job', 'ta');
        $jobsTa = !empty($dbJobs) ? $dbJobs : MatrimonyConstants::jobs('ta');
        $jobsEn = MatrimonyConstants::jobs('en');
        $planetsTa = MatrimonyConstants::planets('ta');
        $planetsEn = MatrimonyConstants::planets('en');
        $complexionsTa = MatrimonyConstants::complexions('ta');
        $complexionsEn = MatrimonyConstants::complexions('en');
        $doshamsTa = MatrimonyConstants::doshams('ta');
        $doshamsEn = MatrimonyConstants::doshams('en');
        $bloodGroups = MatrimonyConstants::bloodGroups();

        // Stats
        $totalCount = Varan::count();
        $femaleCount = Varan::where('varan_type', 'penn')->count();
        $maleCount = Varan::where('varan_type', 'aan')->count();

        // Profiles List
        $varans = Varan::orderBy('id', 'desc')->get();

        // Reg No Settings & Preview
        $regNoConfig = Varan::getRegNoConfig();
        $nextRegId = (Varan::max('id') ?? 0) + 1;
        $regNoPreview = Varan::formatRegNoWithConfig($nextRegId, $regNoConfig);
        $savedPrintStyles = $this->loadSavedPrintStyles();

        // Admin Auth Credentials
        $savedUser = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_username')->first();
        $savedRawPass = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_raw_password')->first();
        $savedEmail = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_email')->first();
        $currentAdminUsername = ($savedUser && !empty(trim($savedUser->name_en))) ? trim($savedUser->name_en) : 'admin';
        $currentAdminPassword = ($savedRawPass && !empty($savedRawPass->name_en)) ? $savedRawPass->name_en : 'password';
        $currentAdminEmail = ($savedEmail && !empty(trim($savedEmail->name_en))) ? trim($savedEmail->name_en) : 'anithar.12@gmail.com';

        return view('varans.portal', compact(
            'rasisTa',
            'rasisEn',
            'starsTa',
            'starsEn',
            'lagnamsTa',
            'lagnamsEn',
            'communitiesTa',
            'communitiesEn',
            'educationsTa',
            'educationsEn',
            'jobsTa',
            'jobsEn',
            'planetsTa',
            'planetsEn',
            'complexionsTa',
            'complexionsEn',
            'doshamsTa',
            'doshamsEn',
            'bloodGroups',
            'varans',
            'totalCount',
            'femaleCount',
            'maleCount',
            'regNoConfig',
            'regNoPreview',
            'savedPrintStyles',
            'currentAdminUsername',
            'currentAdminPassword',
            'currentAdminEmail'
        ));
    }

    /**
     * Store new profile or Update existing profile
     */
    public function store(Request $request)
    {
        if (!session('matrimony_auth')) {
            return redirect()->route('matrimony.login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'varan_type' => 'required|in:aan,penn',
            'photo' => 'nullable|image|max:5120',
        ]);

        $data = $request->except(['photo', 'photo_base64', '_token', 'varan_id']);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $dest = public_path('uploads/varan-photos');
            if (!file_exists($dest)) {
                @mkdir($dest, 0755, true);
            }
            $photo->move($dest, $filename);

            // Mirror to root uploads/varan-photos if running directly from project root on cPanel
            $rootDest = base_path('uploads/varan-photos');
            if ($rootDest !== $dest) {
                if (!file_exists($rootDest)) @mkdir($rootDest, 0755, true);
                @copy($dest . '/' . $filename, $rootDest . '/' . $filename);
            }

            $data['photo_path'] = 'uploads/varan-photos/' . $filename;
        } elseif ($request->filled('photo_base64') && preg_match('/^data:image\/(\w+);base64,/', $request->input('photo_base64'), $b64Match)) {
            $ext = strtolower($b64Match[1]);
            if ($ext === 'jpeg') $ext = 'jpg';
            $rawB64 = substr($request->input('photo_base64'), strpos($request->input('photo_base64'), ',') + 1);
            $decoded = base64_decode($rawB64);
            if ($decoded !== false && strlen($decoded) > 100) {
                $filename = time() . '_' . uniqid() . '.' . $ext;
                $dest = public_path('uploads/varan-photos');
                if (!file_exists($dest)) {
                    @mkdir($dest, 0755, true);
                }
                file_put_contents($dest . '/' . $filename, $decoded);

                // Mirror to root uploads/varan-photos if running directly from project root on cPanel
                $rootDest = base_path('uploads/varan-photos');
                if ($rootDest !== $dest) {
                    if (!file_exists($rootDest)) @mkdir($rootDest, 0755, true);
                    @copy($dest . '/' . $filename, $rootDest . '/' . $filename);
                }

                $data['photo_path'] = 'uploads/varan-photos/' . $filename;
            }
        }

        // Clean & ensure reg_no and reg_date
        if ($request->filled('reg_no')) {
            $data['reg_no'] = trim($request->input('reg_no'));
        }
        if ($request->filled('reg_date')) {
            $data['reg_date'] = trim($request->input('reg_date'));
        }
        if ($request->filled('dob')) {
            $rawDob = trim($request->input('dob'));
            if (preg_match('/^(19\d\d|20[0-2]\d)-(\d{1,2})-(\d{1,2})$/', $rawDob, $dm)) {
                $y = (int)$dm[1]; $m = (int)$dm[2]; $d = (int)$dm[3];
                if (checkdate($m, $d, $y)) {
                    $data['dob'] = sprintf('%04d-%02d-%02d', $y, $m, $d);
                } else {
                    $data['dob'] = null;
                }
            } else {
                $data['dob'] = null;
            }
        } else {
            $data['dob'] = null;
        }

        if (!empty($data['birth_place'])) {
            $data['birth_place'] = trim(preg_replace('/[0-9\x{0BE6}-\x{0BEF}]+/u', '', $data['birth_place']));
        }

        // Clean & ensure valid 10-digit format for phone numbers and Email
        if (!empty($data['father_mobile'])) {
            $fClean = preg_replace('/\D/', '', $data['father_mobile']);
            if (strlen($fClean) === 12 && str_starts_with($fClean, '91')) $fClean = substr($fClean, 2);
            if (strlen($fClean) === 11 && str_starts_with($fClean, '0')) $fClean = substr($fClean, 1);
            $data['father_mobile'] = substr($fClean, 0, 10);
        }
        if (!empty($data['mother_mobile'])) {
            $mClean = preg_replace('/\D/', '', $data['mother_mobile']);
            if (strlen($mClean) === 12 && str_starts_with($mClean, '91')) $mClean = substr($mClean, 2);
            if (strlen($mClean) === 11 && str_starts_with($mClean, '0')) $mClean = substr($mClean, 1);
            $data['mother_mobile'] = substr($mClean, 0, 10);
        }
        if (!empty($data['email'])) {
            $data['email'] = preg_replace('/\s+/', '', $data['email']);
        }

        // Merge tamil_month_name and tamil_month_date into tamil_month if needed
        if (empty($data['tamil_month'])) {
            $tName = trim($request->input('tamil_month_name', ''));
            $tDate = trim($request->input('tamil_month_date', ''));
            if ($tName) {
                $data['tamil_month'] = $tName . ($tDate !== '' ? ' ' . $tDate : '');
            }
        }
        if (!empty($data['tamil_year'])) {
            $data['tamil_year'] = trim(preg_replace('/^\d+[\.\s\-]+/', '', $data['tamil_year']));
        }

        $data['rasi_chart'] = $this->sanitizeChart($request->input('rasi_chart', []));
        $data['navamsam_chart'] = $this->sanitizeChart($request->input('navamsam_chart', []));

        if (empty($data['marriage_type'])) {
            $data['marriage_type'] = 'mudhal_manama';
        }

        $showPhoto = $request->input('show_photo_on_print', '1');
        $photoVal = ($showPhoto === '0' || $showPhoto === 0) ? 0 : 1;
        $photoQuery = ['show_photo' => $photoVal];

        try {
            MatrimonyMasterOption::updateOrCreate(
                ['category' => 'setting', 'name_ta' => 'show_photo'],
                ['name_en' => (string)$photoVal, 'sort_order' => 1]
            );
        } catch (\Throwable $e) {}

        // Auto-migrate missing columns if running on older MySQL database without running migrations
        try {
            if (!Schema::hasColumn('varans', 'brothers')) {
                Schema::table('varans', function ($table) {
                    if (!Schema::hasColumn('varans', 'brothers')) $table->string('brothers')->nullable()->after('siblings_details');
                    if (!Schema::hasColumn('varans', 'sisters')) $table->string('sisters')->nullable()->after('brothers');
                    if (!Schema::hasColumn('varans', 'tamil_month')) $table->string('tamil_month')->nullable()->after('dosham');
                    if (!Schema::hasColumn('varans', 'tamil_year')) $table->string('tamil_year')->nullable()->after('tamil_month');
                });
            }
            if (config('database.default') !== 'sqlite') {
                \Illuminate\Support\Facades\DB::statement("ALTER TABLE varans MODIFY COLUMN address TEXT NULL");
                \Illuminate\Support\Facades\DB::statement("ALTER TABLE varans MODIFY COLUMN family_wealth TEXT NULL");
                \Illuminate\Support\Facades\DB::statement("ALTER TABLE varans MODIFY COLUMN siblings_details TEXT NULL");
            }
        } catch (\Throwable $e) {}

        // Defensive column filtering: only insert columns that physically exist in the database table
        try {
            $existingCols = Schema::getColumnListing('varans');
            if (!empty($existingCols)) {
                $data = array_intersect_key($data, array_flip($existingCols));
            }
        } catch (\Throwable $e) {}

        $langQuery = $request->filled('lang') ? ['lang' => $request->input('lang')] : [];

        $editId = $request->input('varan_id');
        $isAjax = $request->ajax() || $request->wantsJson() || ($request->header('X-Requested-With') === 'XMLHttpRequest') || ($request->input('ajax_save') == '1');
        if ($editId && ($existing = Varan::find($editId))) {
            if (!empty($data['photo_path']) && !empty($existing->photo_path) && $existing->photo_path !== $data['photo_path']) {
                $oldFile = public_path($existing->photo_path);
                if (file_exists($oldFile)) @unlink($oldFile);
                $oldRoot = base_path($existing->photo_path);
                if (file_exists($oldRoot)) @unlink($oldRoot);
            }
            $existing->update($data);
            if ($isAjax) {
                return response()->json([
                    'success' => true,
                    'id' => $existing->id,
                    'name' => $existing->name,
                    'message' => 'Profile updated successfully!'
                ]);
            }
            return redirect()->route('varans.print', array_merge(['varan' => $existing->id], $photoQuery, $langQuery))->with('success', 'Profile updated successfully!');
        }

        $varan = Varan::create($data);

        if ($isAjax) {
            return response()->json([
                'success' => true,
                'id' => $varan->id,
                'name' => $varan->name,
                'message' => 'Profile saved successfully!'
            ]);
        }

        return redirect()->route('varans.print', array_merge(['varan' => $varan->id], $photoQuery, $langQuery))->with('success', 'Profile saved successfully!');
    }

    /**
     * Delete Profile
     */
    public function destroy(Varan $varan)
    {
        if (!session('matrimony_auth')) {
            return redirect()->route('matrimony.login');
        }

        if ($varan->photo_path) {
            $pub = public_path($varan->photo_path);
            if (file_exists($pub)) @unlink($pub);
            $rootF = base_path($varan->photo_path);
            if (file_exists($rootF)) @unlink($rootF);
            $stor = storage_path('app/public/' . $varan->photo_path);
            if (file_exists($stor)) @unlink($stor);
        }

        $varan->delete();
        return redirect()->route('matrimony.portal')->with('success', 'Profile removed successfully');
    }

    /**
     * Bulk Delete Profiles (Requirement 3)
     */
    public function bulkDestroy(Request $request)
    {
        if (!session('matrimony_auth')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No profiles selected'], 400);
        }

        $varans = Varan::whereIn('id', $ids)->get();
        $count = 0;
        foreach ($varans as $varan) {
            if ($varan->photo_path) {
                $pub = public_path($varan->photo_path);
                if (file_exists($pub)) @unlink($pub);
                $rootF = base_path($varan->photo_path);
                if (file_exists($rootF)) @unlink($rootF);
                $stor = storage_path('app/public/' . $varan->photo_path);
                if (file_exists($stor)) @unlink($stor);
            }
            $varan->delete();
            $count++;
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "{$count} profiles deleted successfully",
                'count' => $count
            ]);
        }

        return redirect()->route('matrimony.portal')->with('success', "{$count} profiles deleted successfully");
    }

    /**
     * Show Yellow A4 Biodata Print View
     */
    public function print(Varan $varan, ?Request $request = null)
    {
        $request = $request ?: request();
        $lang = $request->query('lang', 'ta');

        $dbPref = MatrimonyMasterOption::where('category', 'setting')->where('name_ta', 'show_photo')->value('name_en');
        if ($request->has('show_photo')) {
            $showPhoto = ($request->query('show_photo') == '1');
        } elseif ($dbPref !== null) {
            $showPhoto = ($dbPref === '1');
        } else {
            $showPhoto = true;
        }

        $savedPrintStyles = $this->loadSavedPrintStyles();
        return view('varans.print-yellow', compact('varan', 'lang', 'showPhoto', 'savedPrintStyles'));
    }

    /**
     * Show Blank A4 Biodata Print View for manual printing/filling
     */
    public function printBlank(Request $request)
    {
        $gender = strtolower(trim($request->query('gender', 'aan')));
        $lang = $request->query('lang', 'ta');
        $isRemarriage = str_contains($gender, 'marumanam')
                     || str_contains($gender, 'remarriage')
                     || in_array($gender, ['marumanam', 'remarriage', 're_marriage']) 
                     || ($request->query('type') === 'marumanam');

        $isPenn = ($gender === 'penn' || str_contains($gender, 'penn') || str_contains($gender, 'female') || str_contains($gender, 'bride'));

        $varan = new \App\Models\Varan();
        $varan->id = 0;
        $varan->varan_type = $isPenn ? 'penn' : 'aan';
        $varan->marriage_type = $isRemarriage ? 'marumanam' : 'mudhal_manam';
        $varan->reg_no = '';
        $varan->name = '';
        $varan->dob = null;
        $varan->birth_time = '';
        $varan->birth_place = '';
        $varan->education = '';
        $varan->job_title = '';
        $varan->company_details = '';
        $varan->monthly_income = '';
        $varan->height = '';
        $varan->weight = '';
        $varan->complexion = '';
        $varan->kuladeivam = '';
        $varan->gothram = '';
        $varan->kootam = '';
        $varan->father_name = '';
        $varan->father_mobile = '';
        $varan->father_job = '';
        $varan->father_native = '';
        $varan->mother_name = '';
        $varan->mother_mobile = '';
        $varan->mother_job = '';
        $varan->mother_native = '';
        $varan->address = '';
        $varan->family_wealth = '';
        $varan->siblings_details = '';
        $varan->rasi = '';
        $varan->natchathiram = '';
        $varan->lagnam = '';
        $varan->dosham = '';
        $varan->thisai_iruppu = '';
        $varan->expectations = '';
        $varan->rasi_chart = [];
        $varan->navamsam_chart = [];
        $showPhoto = false;
        $isBlank = true;
        $savedPrintStyles = $this->loadSavedPrintStyles();

        return view('varans.print-yellow', compact('varan', 'lang', 'showPhoto', 'isBlank', 'isRemarriage', 'savedPrintStyles'));
    }

    /**
     * Parse uploaded document (PDF, TXT, or pasted text) into form fields
     */
    public function parseDocument(Request $request)
    {
        $text = $request->input('biodata_text', '');

        if ($request->hasFile('biodata_file')) {
            $file = $request->file('biodata_file');
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext === 'txt') {
                $text = file_get_contents($file->getRealPath());
            } elseif ($ext === 'pdf') {
                $filePath = $file->getRealPath();
                $extractedPdfText = '';
                $photoBase64 = null;
                $detectedGender = null;
                $detectedMarriage = null;
                $extractedRasiChart = null;
                $extractedNavamsamChart = null;

                // 0. Check for Embedded Varan JSON Payload in raw PDF stream (0.01s Instant Digital Restore)
                $rawPdfContent = @file_get_contents($filePath);
                if ($rawPdfContent && str_contains($rawPdfContent, '###VARAN_EMBED_START###')) {
                    if (preg_match('/###VARAN_EMBED_START###([\s\S]*?)###VARAN_EMBED_END###/', $rawPdfContent, $embedMatches)) {
                        $cleanB64 = preg_replace('/\s+/', '', $embedMatches[1]);
                        $decodedData = json_decode(base64_decode($cleanB64), true);
                        if (is_array($decodedData) && (!empty($decodedData['name']) || !empty($decodedData['reg_no']))) {
                            return response()->json([
                                'success' => true,
                                'data' => $decodedData,
                                'photo_base64' => $decodedData['photo_base64'] ?? null,
                                'message' => 'Project biodata digitally restored instantly'
                            ]);
                        }
                    }
                }

                // 100% Pure PHP PDF Parser with Smalot (Zero Python Dependency)
                try {
                    if (!class_exists('\\Smalot\\PdfParser\\Parser')) {
                        $smalotAutoload = base_path('vendor/smalot/pdfparser/src/Smalot/PdfParser/Parser.php');
                        if (file_exists($smalotAutoload)) {
                            spl_autoload_register(function ($class) {
                                $prefix = 'Smalot\\PdfParser\\';
                                $base_dir = base_path('vendor/smalot/pdfparser/src/Smalot/PdfParser/');
                                $len = strlen($prefix);
                                if (strncmp($prefix, $class, $len) !== 0) return;
                                $relative_class = substr($class, $len);
                                $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
                                if (file_exists($file)) require_once $file;
                            });
                        }
                    }
                    if (class_exists('\\Smalot\\PdfParser\\Parser')) {
                        $smalotParser = new \Smalot\PdfParser\Parser();
                        $parsedPdf = $smalotParser->parseFile($filePath);
                        $rawSmalotText = $parsedPdf->getText();
                        $cleanSmalotText = preg_replace('/[\x00-\x08\x0b\x0c\x0e-\x1f]/', '', (string)$rawSmalotText);
                        $cleanSmalotText = @iconv("UTF-8", "UTF-8//IGNORE", $cleanSmalotText);
                        if (!empty(trim($cleanSmalotText))) {
                            $extractedPdfText = $cleanSmalotText;
                        }
                        // Passport Photo XObject Extraction:
                        try {
                            $objects = $parsedPdf->getObjectsByType('XObject');
                            foreach ($objects as $obj) {
                                $h = $obj->getHeader();
                                if ((string)$h->get('Subtype') === 'Image') {
                                    $w = intval((string)$h->get('Width'));
                                    $ht = intval((string)$h->get('Height'));
                                    // Candidate portrait passport photo filter (aspect ratio >= 1.02, not tiny icons and not full page scans)
                                    if ($w >= 140 && $ht >= 180 && $ht >= ($w * 1.02) && $w < 1200 && $ht < 1600) {
                                        $rawImg = $obj->getContent();
                                        if (substr($rawImg, 0, 2) === "\xFF\xD8") {
                                            $photoBase64 = 'data:image/jpeg;base64,' . base64_encode($rawImg);
                                            break;
                                        }
                                    }
                                }
                            }
                        } catch (\Throwable $imgErr) {}
                    }
                } catch (\Throwable $smalotErr) {}

                if (!empty(trim($extractedPdfText))) {
                    $text = $extractedPdfText;
                }
            } elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                if (empty($photoBase64)) {
                    $imgContent = file_get_contents($file->getRealPath());
                    $mime = ($ext === 'png') ? 'image/png' : 'image/jpeg';
                    $photoBase64 = 'data:' . $mime . ';base64,' . base64_encode($imgContent);
                }
            }
        }

        if (empty(trim($text))) {
            return response()->json([
                'success' => false,
                'needs_ocr' => true,
                'photo_base64' => $photoBase64,
                'message' => 'Scanned document detected. Processing with client-side OCR...'
            ], 200);
        }

        $extracted = BiodataParserService::parseText($text);

        if ($request->filled('client_gender') && in_array($request->input('client_gender'), ['aan', 'penn'])) {
            $extracted['varan_type'] = $request->input('client_gender');
            $detectedGender = $extracted['varan_type'];
        } elseif (!empty($detectedGender)) {
            $extracted['varan_type'] = $detectedGender;
        } elseif (!empty($extracted['varan_type'])) {
            $detectedGender = $extracted['varan_type'];
        }
        if (!empty($detectedMarriage)) {
            if (empty($extracted['marriage_type']) || $detectedMarriage === 'mudhal_manama' || $extracted['marriage_type'] !== 'mudhal_manama') {
                $extracted['marriage_type'] = $detectedMarriage;
            }
        }

        if (!empty($photoBase64)) {
            $extracted['photo_base64'] = $photoBase64;
        }
        if (!empty($extractedRasiChart)) {
            $extracted['rasi_chart'] = $this->sanitizeChart($extractedRasiChart);
        } elseif (!empty($extracted['rasi_chart'])) {
            $extracted['rasi_chart'] = $this->sanitizeChart($extracted['rasi_chart']);
        }
        if (!empty($extracted['rasi_chart'])) {
            $houseToRasi = [
                1 => 'மேஷம்', 2 => 'ரிஷபம்', 3 => 'மிதுனம்', 4 => 'கடகம்',
                5 => 'சிம்மம்', 6 => 'கன்னி', 7 => 'துலாம்', 8 => 'விருச்சிகம்',
                9 => 'தனுசு', 10 => 'மகரம்', 11 => 'கும்பம்', 12 => 'மீனம்'
            ];
            $chartLagnam = null;
            foreach ($extracted['rasi_chart'] as $h => $planets) {
                if (is_array($planets) && in_array('லக்', $planets)) {
                    $chartLagnam = $houseToRasi[intval($h)] ?? null;
                    break;
                }
            }
            if ($chartLagnam) {
                $extracted['chart_lagnam'] = $chartLagnam;
                $currentLagnam = $extracted['lagnam'] ?? null;
                $matchedCurrent = $currentLagnam ? BiodataParserService::matchRasi($currentLagnam) : null;
                if (empty($matchedCurrent)) {
                    $extracted['lagnam'] = $chartLagnam;
                }
            }
        }
        if (!empty($extractedNavamsamChart)) {
            $extracted['navamsam_chart'] = $this->sanitizeChart($extractedNavamsamChart);
        } elseif (!empty($extracted['navamsam_chart'])) {
            $extracted['navamsam_chart'] = $this->sanitizeChart($extracted['navamsam_chart']);
        }

        return response()->json([
            'success' => true,
            'fields_count' => count($extracted),
            'photo_base64' => $photoBase64,
            'data' => $extracted
        ]);
    }

    /**
     * Fetch sample biodata for quick testing
     */
    public function getSampleBiodata(string $type)
    {
        $isGroom = ($type === 'aan' || $type === 'groom');
        $filename = $isGroom ? 'sample_biodata_groom_saravanakumar.txt' : 'sample_biodata_bride_amirthavadivu.txt';

        $possiblePaths = [
            public_path('samples/' . $filename),
            base_path('public/samples/' . $filename),
            base_path('public_html/samples/' . $filename),
            dirname(public_path()) . '/public_html/samples/' . $filename,
            (isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] . '/samples/' . $filename : null),
        ];

        $text = null;
        foreach (array_filter($possiblePaths) as $path) {
            if (file_exists($path)) {
                $text = @file_get_contents($path);
                if (!empty($text)) break;
            }
        }

        // Reliable fallback if filesystem path differs on live server
        if (empty($text)) {
            if ($isGroom) {
                $text = "மாஸ்டர் மணமாலை (Master Matrimony)\nமணமகன் விபரங்கள் (Groom Biodata)\nபெயர்: KARTHIK R\nபாலினம்: ஆண் (Groom)\nஇனம் / சமூகம்: முதலியார்\nபிறந்த தேதி: 20/05/1998\nபிறந்த நேரம்: 07:15 AM\nபிறந்த ஊர்: சென்னை\nபடிப்பு: M.E / M.Tech\nவேலை / தொழில்: Software Architect\nநிறுவனம் & ஊர்: TCS, Chennai\nமாத வருமானம்: 1,25,000\nஉயரம்: 175 cm\nஎடை: 68 kg\nநிறம்: மாநிறம்\nகுலதெய்வம்: ஸ்ரீ முருகன் கோவில், பழனி\nகோத்திரம்: சிவ கோத்திரம்\nகூட்டம்: முத்துராசர் கூட்டம்\nதந்தை பெயர்: Rajendran K\nதந்தை தொழில்: Business\nதந்தை மொபைல்: 9000000001\nதந்தை பூர்வீகம்: சென்னை\nதாய் பெயர்: Lakshmi R\nதாய் தொழில்: இல்லத்தரசி (Home Maker)\nதாய் மொபைல்: 9000000002\nதாய் பூர்வீகம்: சென்னை\nமுழு முகவரி: 12, அண்ணா நகர், சென்னை - 600040\nகுடும்ப வருமானம் / வசதிகள்: சொந்த வீடு மற்றும் தோட்டம்\nஉடன் பிறந்தோர்: 1 தம்பி, B.E முடித்து பணியில் உள்ளார்\nராசி: மேஷம்\nநட்சத்திரம்: அஸ்வினி\nலக்னம்: ரிஷபம்\nதோஷம்: சுத்தம்\nதிசை இருப்பு: கேது திசை 2 வருடம்\nஎதிர்பார்ப்புகள்: பட்டதாரி, குடும்ப பாங்கான மணமகள் தேவை\nரத்த வகை: O+\nமின்னஞ்சல்: karthik.demo@mastermatrimony.example";
            } else {
                $text = "மாஸ்டர் மணமாலை (Master Matrimony)\nமணமகள் விபரங்கள் (Bride Biodata)\nபெயர்: DIVYA S\nபாலினம்: பெண் (Bride)\nஇனம் / சமூகம்: முதலியார்\nபிறந்த தேதி: 15/07/1999\nபிறந்த நேரம்: 10:30 AM\nபிறந்த ஊர்: மதுரை\nபடிப்பு: B.E (Computer Science)\nவேலை / தொழில்: மென்பொருள் பொறியாளர் (Software Engineer)\nநிறுவனம் & ஊர்: Infosys, Bangalore\nமாத வருமானம்: 85,000\nஉயரம்: 162 cm\nஎடை: 54 kg\nநிறம்: சிவப்பு\nகுலதெய்வம்: ஸ்ரீ மீனாட்சி அம்மன், மதுரை\nகோத்திரம்: சிவ கோத்திரம்\nகூட்டம்: காடை கூட்டம்\nதந்தை பெயர்: Sundaram S\nதந்தை தொழில்: Teacher (Govt School)\nதந்தை மொபைல்: 9000000003\nதந்தை பூர்வீகம்: மதுரை\nதாய் பெயர்: Kavitha S\nதாய் தொழில்: இல்லத்தரசி (Home Maker)\nதாய் மொபைல்: 9000000004\nதாய் பூர்வீகம்: மதுரை\nமுழு முகவரி: 45, கே.கே. நகர், மதுரை - 625020\nகுடும்ப வருமானம் / வசதிகள்: சொந்த வீடு, 5 ஏக்கர் விவசாய நிலம்\nஉடன் பிறந்தோர்: 1 தம்பி - B.Tech படித்து வருகிறார்\nராசி: சிம்மம்\nநட்சத்திரம்: மகம்\nலக்னம்: கன்னி\nதோஷம்: சுத்தம்\nதிசை இருப்பு: சுக்கிரன் திசை\nஎதிர்பார்ப்புகள்: நன்கு படித்த, நல்ல குணமுள்ள, IT அல்லது பிற துறையில் பணிபுரியும் மணமகன்\nரத்த வகை: A1B+\nமின்னஞ்சல்: divya.demo@mastermatrimony.example";
            }
        }

        $data = BiodataParserService::parseText($text);

        return response()->json([
            'success' => true,
            'type' => $type,
            'raw_text' => $text,
            'fields_count' => count($data),
            'data' => $data
        ]);
    }

    /**
     * Master Options API: List options
     */
    public function getMasterOptions(Request $request)
    {
        $category = $request->query('category');
        $query = MatrimonyMasterOption::query()->orderBy('sort_order')->orderBy('id');
        if ($category) {
            $query->where('category', $category);
        }
        $options = $query->get();

        return response()->json([
            'success' => true,
            'options' => $options
        ]);
    }

    /**
     * Master Options API: Create option
     */
    public function storeMasterOption(Request $request)
    {
        $request->validate([
            'category' => 'required|string|in:community,education,job',
            'name_ta' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
        ]);

        $maxSort = MatrimonyMasterOption::where('category', $request->category)->max('sort_order') ?? 0;

        $option = MatrimonyMasterOption::create([
            'category' => $request->category,
            'name_ta' => trim($request->name_ta),
            'name_en' => trim($request->name_en ?: $request->name_ta),
            'sort_order' => $maxSort + 1,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Option added successfully',
            'option' => $option
        ]);
    }

    /**
     * Master Options API: Update option
     */
    public function updateMasterOption(Request $request, $id)
    {
        $request->validate([
            'name_ta' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
        ]);

        $option = MatrimonyMasterOption::findOrFail($id);
        $option->update([
            'name_ta' => trim($request->name_ta),
            'name_en' => trim($request->name_en ?: $request->name_ta),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Option updated successfully',
            'option' => $option
        ]);
    }

    /**
     * Master Options API: Delete option
     */
    public function destroyMasterOption($id)
    {
        $option = MatrimonyMasterOption::findOrFail($id);
        $option->delete();

        return response()->json([
            'success' => true,
            'message' => 'Option deleted successfully'
        ]);
    }

    /**
     * Reg No Setting API: Get current config and sample preview
     */
    public function getRegNoSetting()
    {
        $config = Varan::getRegNoConfig();
        $nextId = (Varan::max('id') ?? 0) + 1;
        $preview = Varan::formatRegNoWithConfig($nextId, $config);

        return response()->json([
            'success' => true,
            'config' => $config,
            'preview' => $preview,
        ]);
    }

    /**
     * Reg No Setting API: Save/Update config
     */
    public function updateRegNoSetting(Request $request)
    {
        $config = [
            'prefix' => trim((string)$request->input('prefix', 'SAM')),
            'separator' => (string)$request->input('separator', '-'),
            'middle' => trim((string)$request->input('middle', '{YEAR}')),
            'digits' => (int)$request->input('digits', 4),
            'suffix' => trim((string)$request->input('suffix', '')),
        ];

        // If prefix is left blank, default to SAM
        if ($config['prefix'] === '') {
            $config['prefix'] = 'SAM';
        }

        $setting = MatrimonyMasterOption::firstOrNew(['category' => 'reg_no_setting']);
        $setting->name_ta = 'பதிவு எண் அமைப்பு';
        $setting->name_en = json_encode($config);
        $setting->sort_order = 1;
        $setting->save();

        $nextId = (Varan::max('id') ?? 0) + 1;
        $preview = Varan::formatRegNoWithConfig($nextId, $config);

        return response()->json([
            'success' => true,
            'message' => 'பதிவு எண் அமைப்பு வெற்றிகரமாக சேமிக்கப்பட்டது!',
            'config' => $config,
            'preview' => $preview,
        ]);
    }

    /**
     * Photo Print Setting API: Get current preference
     */
    public function getPhotoSetting()
    {
        $setting = MatrimonyMasterOption::where('category', 'setting')->where('name_ta', 'show_photo')->first();
        $showPhoto = $setting ? ($setting->name_en === '1' ? '1' : '0') : '1';
        return response()->json(['success' => true, 'show_photo' => $showPhoto]);
    }

    /**
     * Photo Print Setting API: Update preference
     */
    public function updatePhotoSetting(Request $request)
    {
        $val = $request->input('show_photo', '1');
        $showPhoto = ($val === '0' || $val === 0 || $val === false) ? '0' : '1';

        $setting = MatrimonyMasterOption::firstOrNew(['category' => 'setting', 'name_ta' => 'show_photo']);
        $setting->name_en = $showPhoto;
        $setting->sort_order = 1;
        $setting->save();

        return response()->json(['success' => true, 'show_photo' => $showPhoto]);
    }

    private function sanitizeChart($chart)
    {
        if (!is_array($chart)) return $chart;
        foreach ($chart as $k => $v) {
            if (is_array($v)) {
                $chart[$k] = array_slice($v, 0, 9);
            } elseif (is_string($v) && trim($v) !== '') {
                $parts = preg_split('/[,\\s]+/', $v, -1, PREG_SPLIT_NO_EMPTY);
                if (count($parts) > 9) {
                    $chart[$k] = implode(',', array_slice($parts, 0, 9));
                }
            }
        }
        return $chart;
    }

    /**
     * Get saved print styles configuration (Cross-Device Sync)
     */
    public function getPrintStyleSetting()
    {
        return response()->json([
            'success' => true,
            'styles' => $this->loadSavedPrintStyles()
        ]);
    }

    /**
     * Save print styles configuration to database (Cross-Device Sync)
     */
    public function updatePrintStyleSetting(Request $request)
    {
        $inputStyles = $request->input('styles');
        if (empty($inputStyles)) {
            $inputStyles = $request->all();
        }
        if (isset($inputStyles['styles']) && is_array($inputStyles['styles'])) {
            $inputStyles = $inputStyles['styles'];
        }
        if (is_array($inputStyles)) {
            unset($inputStyles['_token']);
        }
        if (is_string($inputStyles)) {
            $inputStyles = json_decode($inputStyles, true) ?: [];
        }

        if (is_array($inputStyles) && !empty($inputStyles)) {
            // 1. Save full JSON to storage/app/print_styles.json as fast cross-process cache
            try {
                @file_put_contents(storage_path('app/print_styles.json'), json_encode($inputStyles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            } catch (\Throwable $e) {}

            // 2. Save individual keys in matrimony_master_options table for database persistence
            foreach ($inputStyles as $key => $val) {
                if ($key === 'highlights') {
                    if (is_array($val)) {
                        try {
                            MatrimonyMasterOption::where('category', 'print_style_highlight')->delete();
                            foreach ($val as $hField => $hConf) {
                                MatrimonyMasterOption::create([
                                    'category' => 'print_style_highlight',
                                    'name_ta' => (string)$hField,
                                    'name_en' => is_array($hConf) ? json_encode($hConf, JSON_UNESCAPED_UNICODE) : (string)$hConf,
                                    'sort_order' => 0,
                                ]);
                            }
                        } catch (\Throwable $e) {}
                    }
                    $strVal = is_array($val) ? json_encode($val, JSON_UNESCAPED_UNICODE) : (string)$val;
                    $option = MatrimonyMasterOption::firstOrNew([
                        'category' => 'print_style',
                        'name_ta' => 'highlights',
                    ]);
                    $option->name_en = substr($strVal, 0, 255);
                    $option->sort_order = 0;
                    $option->save();
                } else {
                    $strVal = is_array($val) ? json_encode($val, JSON_UNESCAPED_UNICODE) : (string)$val;
                    $option = MatrimonyMasterOption::firstOrNew([
                        'category' => 'print_style',
                        'name_ta' => $key,
                    ]);
                    $option->name_en = substr($strVal, 0, 255);
                    $option->sort_order = 0;
                    $option->save();
                }
            }
        }

        return response()->json([
            'success' => true,
            'styles' => $this->loadSavedPrintStyles()
        ]);
    }

    /**
     * Helper to load saved print styles from database / storage
     */
    public function loadSavedPrintStyles(): array
    {
        $styles = [];

        // 1. Try loading from storage/app/print_styles.json
        $filePath = storage_path('app/print_styles.json');
        if (file_exists($filePath)) {
            $content = @file_get_contents($filePath);
            if ($content) {
                $parsed = json_decode($content, true);
                if (is_array($parsed)) {
                    $styles = $parsed;
                }
            }
        }

        // 2. Try loading from matrimony_master_options table
        try {
            $options = MatrimonyMasterOption::where('category', 'print_style')->get();
            foreach ($options as $opt) {
                $val = $opt->name_en;
                if ($opt->name_ta === 'highlights') {
                    $parsedHighlights = json_decode($val, true);
                    if (is_array($parsedHighlights)) {
                        $styles['highlights'] = $parsedHighlights;
                    }
                } else {
                    $styles[$opt->name_ta] = $val;
                }
            }

            // Also load individual highlight records to ensure no 255-char truncation loss
            $hlRecords = MatrimonyMasterOption::where('category', 'print_style_highlight')->get();
            if ($hlRecords->isNotEmpty()) {
                if (!isset($styles['highlights']) || !is_array($styles['highlights'])) {
                    $styles['highlights'] = [];
                }
                foreach ($hlRecords as $hl) {
                    $parsedHl = json_decode($hl->name_en, true);
                    $styles['highlights'][$hl->name_ta] = is_array($parsedHl) ? $parsedHl : $hl->name_en;
                }
            }
        } catch (\Throwable $e) {}

        return $styles;
    }

    /**
     * Admin Auth Setting API: Get current admin username/ID
     */
    public function getAdminAuthSetting()
    {
        $savedUser = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_username')->first();
        $savedEmail = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_email')->first();
        $savedPass = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_password')->first();
        $savedRawPass = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_raw_password')->first();

        $username = ($savedUser && !empty(trim($savedUser->name_en))) ? trim($savedUser->name_en) : 'admin';
        $email = ($savedEmail && !empty(trim($savedEmail->name_en))) ? trim($savedEmail->name_en) : 'anithar.12@gmail.com';
        $hasCustomPassword = ($savedPass !== null);
        $currentPassword = ($savedRawPass && !empty($savedRawPass->name_en)) ? $savedRawPass->name_en : 'password';

        return response()->json([
            'success' => true,
            'username' => $username,
            'email' => $email,
            'has_custom_password' => $hasCustomPassword,
            'current_password' => $currentPassword,
        ]);
    }

    /**
     * Admin Auth Setting API: Update admin ID, email, and/or password
     */
    public function updateAdminAuthSetting(Request $request)
    {
        $username = trim((string)$request->input('username', ''));
        $email = trim((string)$request->input('email', ''));
        $password = (string)$request->input('password', '');
        $passwordConfirmation = (string)$request->input('password_confirmation', '');

        if (empty($username)) {
            return response()->json([
                'success' => false,
                'message' => 'பயனர் ID / Username காலியாக இருக்கக்கூடாது! (Username cannot be empty!)'
            ], 422);
        }

        if (strlen($username) < 3) {
            return response()->json([
                'success' => false,
                'message' => 'பயனர் ID குறைந்தது 3 எழுத்துகள் இருக்க வேண்டும்! (Username must be at least 3 characters!)'
            ], 422);
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'message' => 'சரியான மின்னஞ்சல் முகவரியை உள்ளிடவும்! (Please enter a valid email address!)'
            ], 422);
        }

        // If new password is provided, validate confirmation and length
        if (!empty($password)) {
            if (strlen($password) < 4) {
                return response()->json([
                    'success' => false,
                    'message' => 'கடவுச்சொல் குறைந்தது 4 எழுத்துகள் இருக்க வேண்டும்! (Password must be at least 4 characters!)'
                ], 422);
            }

            if ($password !== $passwordConfirmation) {
                return response()->json([
                    'success' => false,
                    'message' => 'கடவுச்சொற்கள் பொருந்தவில்லை! உறுதி செய்யும் கடவுச்சொல்லை சரியாக உள்ளிடவும். (Passwords do not match!)'
                ], 422);
            }
        }

        // Save username in MatrimonyMasterOption
        MatrimonyMasterOption::updateOrCreate(
            ['category' => 'admin_auth', 'name_ta' => 'admin_username'],
            ['name_en' => $username, 'sort_order' => 1]
        );

        // Save email in MatrimonyMasterOption
        if (!empty($email)) {
            MatrimonyMasterOption::updateOrCreate(
                ['category' => 'admin_auth', 'name_ta' => 'admin_email'],
                ['name_en' => strtolower($email), 'sort_order' => 1]
            );
        }

        // If password is provided, hash and save
        $currentPassword = 'password';
        $savedRawPass = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_raw_password')->first();
        if ($savedRawPass && !empty($savedRawPass->name_en)) {
            $currentPassword = $savedRawPass->name_en;
        }

        if (!empty($password)) {
            $hashed = Hash::make($password);
            MatrimonyMasterOption::updateOrCreate(
                ['category' => 'admin_auth', 'name_ta' => 'admin_password'],
                ['name_en' => $hashed, 'sort_order' => 1]
            );

            // Save raw password for display and reflection
            MatrimonyMasterOption::updateOrCreate(
                ['category' => 'admin_auth', 'name_ta' => 'admin_raw_password'],
                ['name_en' => $password, 'sort_order' => 1]
            );
            $currentPassword = $password;

            // Also sync to first User in users table if exists
            try {
                $userRecord = User::first();
                if ($userRecord) {
                    $userRecord->name = $username;
                    if (!empty($email)) $userRecord->email = strtolower($email);
                    $userRecord->password = $hashed;
                    $userRecord->save();
                }
            } catch (\Exception $e) {
                // Ignore User table sync errors if any
            }
        } elseif (!empty($email)) {
            try {
                $userRecord = User::first();
                if ($userRecord) {
                    $userRecord->name = $username;
                    $userRecord->email = strtolower($email);
                    $userRecord->save();
                }
            } catch (\Exception $e) {
                // Ignore User table sync errors if any
            }
        }

        // Update active session user
        session(['matrimony_user' => $username]);

        $savedEmailRow = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_email')->first();
        $currentEmail = ($savedEmailRow && !empty($savedEmailRow->name_en)) ? $savedEmailRow->name_en : 'anithar.12@gmail.com';

        return response()->json([
            'success' => true,
            'message' => 'நிர்வாக பயனர் ID, மின்னஞ்சல் & கடவுச்சொல் வெற்றிகரமாக மாற்றப்பட்டது! (Admin credentials updated successfully!)',
            'username' => $username,
            'email' => $currentEmail,
            'current_password' => $currentPassword,
        ]);
    }

    /**
     * Admin Auth Setting API: Reset admin credentials back to default admin / password
     */
    public function resetAdminAuthSetting()
    {
        MatrimonyMasterOption::where('category', 'admin_auth')->delete();

        try {
            $userRecord = User::first();
            if ($userRecord) {
                $userRecord->name = 'Admin';
                $userRecord->email = 'anithar.12@gmail.com';
                $userRecord->password = Hash::make('password');
                $userRecord->save();
            }
        } catch (\Exception $e) {}

        session(['matrimony_user' => 'admin']);

        return response()->json([
            'success' => true,
            'message' => 'நிர்வாக விபரங்கள் இயல்புநிலைக்கு (ID: admin, Password: password) மாற்றப்பட்டது! (Reset to default admin/password!)',
            'username' => 'admin',
            'email' => 'anithar.12@gmail.com',
            'current_password' => 'password',
        ]);
    }

    /**
     * Dynamically apply SMTP mail configuration from database or env
     */
    protected function applySmtpConfig()
    {
        $smtpHost = MatrimonyMasterOption::where('category', 'smtp_setting')->where('name_ta', 'smtp_host')->value('name_en');
        $smtpPort = MatrimonyMasterOption::where('category', 'smtp_setting')->where('name_ta', 'smtp_port')->value('name_en');
        $smtpUser = MatrimonyMasterOption::where('category', 'smtp_setting')->where('name_ta', 'smtp_username')->value('name_en');
        $smtpPass = MatrimonyMasterOption::where('category', 'smtp_setting')->where('name_ta', 'smtp_password')->value('name_en');
        $smtpEnc  = MatrimonyMasterOption::where('category', 'smtp_setting')->where('name_ta', 'smtp_encryption')->value('name_en');
        $fromAddr = MatrimonyMasterOption::where('category', 'smtp_setting')->where('name_ta', 'smtp_from_address')->value('name_en');
        $fromName = MatrimonyMasterOption::where('category', 'smtp_setting')->where('name_ta', 'smtp_from_name')->value('name_en');

        if (!empty($smtpHost) && !empty($smtpUser) && !empty($smtpPass)) {
            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.transport' => 'smtp',
                'mail.mailers.smtp.host' => trim($smtpHost),
                'mail.mailers.smtp.port' => (int)($smtpPort ?: 587),
                'mail.mailers.smtp.encryption' => ($smtpEnc && !empty(trim($smtpEnc))) ? trim($smtpEnc) : 'tls',
                'mail.mailers.smtp.username' => trim($smtpUser),
                'mail.mailers.smtp.password' => trim($smtpPass),
                'mail.from.address' => ($fromAddr && !empty(trim($fromAddr))) ? trim($fromAddr) : trim($smtpUser),
                'mail.from.name' => ($fromName && !empty(trim($fromName))) ? trim($fromName) : 'Master Matrimony',
            ]);
            return true;
        }
        return false;
    }

    /**
     * Deliver OTP email using multi-transport dispatch:
     * 1. Authenticated SMTP (database config or non-null .env)
     * 2. PHP native mail() with RFC 2822 UTF-8 headers, responsive HTML body & envelope sender (-f)
     */
    protected function deliverOtpEmail($toEmail, $otp, $adminUsername)
    {
        $subject = 'மாஸ்டர் மணமாலை (Master Matrimony) - நிர்வாக கடவுச்சொல் மீட்டெடுப்பு OTP: ' . $otp;
        $subjectEncoded = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $senderName = '=?UTF-8?B?' . base64_encode('மாஸ்டர் மணமாலை (Master Matrimony)') . '?=';

        $host = request()->getHost();
        $domain = (empty($host) || $host === 'localhost' || filter_var($host, FILTER_VALIDATE_IP))
            ? 'mastermatrimony.example'
            : preg_replace('/^www\./i', '', $host);

        $customFrom = MatrimonyMasterOption::where('category', 'smtp_setting')->where('name_ta', 'smtp_from_address')->value('name_en');
        $fromEmail = (!empty($customFrom) && filter_var($customFrom, FILTER_VALIDATE_EMAIL))
            ? trim($customFrom)
            : 'noreply@' . $domain;

        $htmlBody = '<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>நிர்வாக OTP குறியீடு</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 24px; color: #1e293b;">
  <div style="max-width: 520px; margin: 0 auto; background: #ffffff; border-radius: 14px; border: 2px solid #f59e0b; overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.08);">
    <div style="background: #0f172a; padding: 22px 20px; text-align: center; border-bottom: 2px solid #f59e0b;">
      <h2 style="color: #f59e0b; margin: 0; font-size: 20px; font-weight: 800;">மாஸ்டர் மணமாலை (Master Matrimony)</h2>
      <p style="color: #cbd5e1; margin: 6px 0 0; font-size: 13px;">திருமண தகவல் மையம் - நிர்வாக கடவுச்சொல் மீட்டெடுப்பு</p>
    </div>
    <div style="padding: 28px 24px; text-align: center;">
      <p style="color: #475569; font-size: 14.5px; line-height: 1.5; margin: 0 0 20px;">
        உங்கள் நிர்வாக கணக்கை மீட்டெடுப்பதற்கான 6-இலக்க ஒருமுறை கடவுச்சொல் (OTP) கீழே கொடுக்கப்பட்டுள்ளது:
      </p>
      <div style="display: inline-block; background: #fffbeb; border: 2px dashed #b45309; border-radius: 10px; padding: 14px 32px; margin-bottom: 22px;">
        <span style="font-size: 34px; font-weight: 800; letter-spacing: 8px; color: #881337; font-family: monospace;">' . htmlspecialchars($otp) . '</span>
      </div>
      <div style="background: #f1f5f9; border-radius: 8px; padding: 12px 16px; margin-bottom: 22px; font-size: 13.5px; color: #334155; text-align: left; display: inline-block; width: 100%; box-sizing: border-box;">
        <div><strong>நிர்வாக பயனர் ID:</strong> <span style="color: #881337; font-weight: 800; font-size: 15px;">' . htmlspecialchars($adminUsername) . '</span></div>
        <div style="margin-top: 4px; font-size: 12.5px; color: #64748b;">கடவுச்சொல் மீட்டமைத்த பின் Login பக்கத்தில் இந்த பயனர் ID-யை உள்ளிடவும்.</div>
      </div>
      <p style="color: #dc2626; font-size: 12.5px; font-weight: 700; margin: 0; line-height: 1.4;">
        ⚠️ இந்த OTP குறியீடு அடுத்த 10 நிமிடங்களுக்கு மட்டுமே செல்லுபடியாகும். இதை எவருடனும் பகிர வேண்டாம்.
      </p>
    </div>
    <div style="background: #f8fafc; padding: 14px 20px; text-align: center; font-size: 11.5px; color: #94a3b8; border-top: 1px solid #e2e8f0;">
      மாஸ்டர் மணமாலை திருமண தகவல் மையம் • Master Matrimony
    </div>
  </div>
</body>
</html>';

        $sent = false;

        // 1. Try SMTP if configured via database or non-empty in environment
        $hasCustomSmtp = $this->applySmtpConfig();
        $envUser = config('mail.mailers.smtp.username');
        $envPass = config('mail.mailers.smtp.password');

        if ($hasCustomSmtp || (!empty($envUser) && !empty($envPass) && $envUser !== 'null')) {
            try {
                \Illuminate\Support\Facades\Mail::html($htmlBody, function ($message) use ($toEmail, $subject, $fromEmail) {
                    $message->to($toEmail)
                        ->from($fromEmail, 'Master Matrimony')
                        ->subject($subject);
                });
                $sent = true;
            } catch (\Throwable $smtpErr) {
                \Illuminate\Support\Facades\Log::warning('SMTP dispatch failed: ' . $smtpErr->getMessage());
            }
        }

        // 2. Fallback to PHP native mail() with full MIME headers and envelope sender (-f)
        if (!$sent && function_exists('mail')) {
            try {
                $headers = [
                    'MIME-Version: 1.0',
                    'Content-Type: text/html; charset=UTF-8',
                    'Content-Transfer-Encoding: 8bit',
                    'From: ' . $senderName . ' <' . $fromEmail . '>',
                    'Reply-To: ' . $fromEmail,
                    'Return-Path: ' . $fromEmail,
                    'X-Mailer: PHP/' . phpversion(),
                    'X-Priority: 1 (Highest)',
                ];
                $headerStr = implode("\r\n", $headers);
                $additionalParams = '-f' . $fromEmail;

                $sent = @mail($toEmail, $subjectEncoded, $htmlBody, $headerStr, $additionalParams);
                if (!$sent) {
                    $sent = @mail($toEmail, $subjectEncoded, $htmlBody, $headerStr);
                }
            } catch (\Throwable $mailErr) {
                \Illuminate\Support\Facades\Log::warning('Native mail() dispatch failed: ' . $mailErr->getMessage());
            }
        }

        return $sent;
    }

    /**
     * Send 6-digit OTP for Forgot Password / ID Recovery via Email
     */
    public function sendForgotOtp(Request $request)
    {
        $inputEmail = strtolower(trim((string)$request->input('email', '')));
        if (empty($inputEmail) || !filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'success' => false,
                'message' => 'சரியான மின்னஞ்சல் முகவரியை உள்ளிடவும்! (Please enter a valid email address!)'
            ], 422);
        }

        // Fetch registered admin email and username
        $savedUser = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_username')->first();
        $savedEmail = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_email')->first();
        $currentUsername = ($savedUser && !empty(trim($savedUser->name_en))) ? trim($savedUser->name_en) : 'admin';
        $registeredEmail = ($savedEmail && !empty(trim($savedEmail->name_en))) ? strtolower(trim($savedEmail->name_en)) : 'anithar.12@gmail.com';

        // Check if entered email matches registered email or users table
        $userMatch = User::whereRaw('LOWER(email) = ?', [$inputEmail])->first();
        $isMatch = ($inputEmail === $registeredEmail || $userMatch !== null);

        if (!$isMatch) {
            return response()->json([
                'success' => false,
                'message' => 'பதிவு செய்யப்படாத மின்னஞ்சல் முகவரி! (This email is not registered for Admin access!)'
            ], 404);
        }

        // Generate fresh dynamic 6-digit numeric OTP every single time
        $otp = str_pad((string)random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        $expiresAt = now()->addMinutes(10);

        // Store OTP in database
        MatrimonyMasterOption::updateOrCreate(
            ['category' => 'admin_otp', 'name_ta' => $inputEmail],
            ['name_en' => $otp, 'sort_order' => $expiresAt->timestamp]
        );

        // Send OTP via SMTP or native mail()
        $emailSent = $this->deliverOtpEmail($inputEmail, $otp, $currentUsername);

        if (!$emailSent) {
            \Illuminate\Support\Facades\Log::warning("Failed to dispatch OTP email to {$inputEmail}.");
            return response()->json([
                'success' => false,
                'message' => 'மின்னஞ்சல் அனுப்புவதில் பிழை ஏற்பட்டது. தயவுசெய்து உங்கள் சர்வர் மின்னஞ்சல் அமைப்பை சரிபார்க்கவும்! (Failed to dispatch OTP email. Please check server email settings!)'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => '6-இலக்க OTP குறியீடு உங்கள் மின்னஞ்சலுக்கு அனுப்பப்பட்டுள்ளது! தயவுசெய்து Inbox அல்லது Spam ஃபோல்டரை சரிபார்க்கவும்.',
            'email' => $inputEmail,
        ]);
    }

    /**
     * Verify OTP and reset admin password
     */
    public function verifyForgotOtp(Request $request)
    {
        $inputEmail = strtolower(trim((string)$request->input('email', '')));
        $inputOtp = trim((string)$request->input('otp', ''));
        $newPassword = (string)$request->input('password', '');
        $confirmPassword = (string)$request->input('password_confirmation', '');

        if (empty($inputEmail) || empty($inputOtp)) {
            return response()->json([
                'success' => false,
                'message' => 'மின்னஞ்சல் மற்றும் OTP உள்ளிடவும்! (Email and OTP are required!)'
            ], 422);
        }

        if (empty($newPassword) || strlen($newPassword) < 4) {
            return response()->json([
                'success' => false,
                'message' => 'புதிய கடவுச்சொல் குறைந்தது 4 எழுத்துக்கள் இருக்க வேண்டும்! (Password must be at least 4 chars!)'
            ], 422);
        }

        if ($newPassword !== $confirmPassword) {
            return response()->json([
                'success' => false,
                'message' => 'கடவுச்சொற்கள் பொருந்தவில்லை! (Passwords do not match!)'
            ], 422);
        }

        // Verify OTP from database
        $otpRecord = MatrimonyMasterOption::where('category', 'admin_otp')->where('name_ta', $inputEmail)->first();
        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'OTP காணப்படவில்லை அல்லது காலாவதியானது! தயவுசெய்து மீண்டும் முயற்சிக்கவும். (OTP expired or not found!)'
            ], 400);
        }

        if (time() > (int)$otpRecord->sort_order) {
            $otpRecord->delete();
            return response()->json([
                'success' => false,
                'message' => 'OTP காலாவதியாகிவிட்டது! புதிய OTP பெறவும். (OTP has expired!)'
            ], 400);
        }

        if ($otpRecord->name_en !== $inputOtp) {
            return response()->json([
                'success' => false,
                'message' => 'தவறான OTP குறியீடு! மீண்டும் சரிபார்க்கவும். (Invalid OTP code!)'
            ], 400);
        }

        // OTP is valid! Hash new password and save
        $hashed = Hash::make($newPassword);
        MatrimonyMasterOption::updateOrCreate(
            ['category' => 'admin_auth', 'name_ta' => 'admin_password'],
            ['name_en' => $hashed, 'sort_order' => 1]
        );
        MatrimonyMasterOption::updateOrCreate(
            ['category' => 'admin_auth', 'name_ta' => 'admin_raw_password'],
            ['name_en' => $newPassword, 'sort_order' => 1]
        );

        // Also sync to User model if exists
        try {
            $userRecord = User::whereRaw('LOWER(email) = ?', [$inputEmail])->first() ?: User::first();
            if ($userRecord) {
                $userRecord->password = $hashed;
                $userRecord->save();
            }
        } catch (\Throwable $e) {}

        // Delete used OTP
        MatrimonyMasterOption::where('category', 'admin_otp')->where('name_ta', $inputEmail)->delete();

        // Get username for display
        $savedUser = MatrimonyMasterOption::where('category', 'admin_auth')->where('name_ta', 'admin_username')->first();
        $currentUsername = ($savedUser && !empty(trim($savedUser->name_en))) ? trim($savedUser->name_en) : 'admin';

        return response()->json([
            'success' => true,
            'message' => 'கடவுச்சொல் வெற்றிகரமாக மாற்றப்பட்டது! புதிய கடவுச்சொல்லுடன் உள்நுழையவும். (Password reset successfully!)',
            'username' => $currentUsername,
        ]);
    }
}
