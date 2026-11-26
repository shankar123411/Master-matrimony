<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Varan extends Model
{
    protected $fillable = [
        'varan_type',
        'reg_no',
        'reg_date',
        'name',
        'community',
        'dob',
        'birth_time',
        'birth_place',
        'education',
        'job_title',
        'company_details',
        'monthly_income',
        'height',
        'weight',
        'complexion',
        'kuladeivam',
        'gothram',
        'kootam',
        'father_name',
        'father_job',
        'father_mobile',
        'father_native',
        'mother_name',
        'mother_job',
        'mother_mobile',
        'mother_native',
        'address',
        'family_wealth',
        'siblings_details',
        'brothers',
        'sisters',
        'tamil_month',
        'tamil_year',
        'rasi',
        'natchathiram',
        'lagnam',
        'dosham',
        'rasi_chart',
        'navamsam_chart',
        'marriage_type',
        'divorce_details',
        'thisai_iruppu',
        'expectations',
        'blood_group',
        'email',
        'photo_path',
    ];

    protected $casts = [
        'dob' => 'date',
        'reg_date' => 'date',
        'rasi_chart' => 'array',
        'navamsam_chart' => 'array',
    ];

    protected $appends = ['photo_url'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($varan) {
            if (empty($varan->reg_date)) {
                $varan->reg_date = date('Y-m-d');
            }
            if (empty($varan->reg_no)) {
                $varan->reg_no = static::generateRegNo();
            }
            if (empty($varan->marriage_type)) {
                $varan->marriage_type = 'mudhal_manama';
            }
        });

        static::updating(function ($varan) {
            if (empty($varan->marriage_type)) {
                $varan->marriage_type = 'mudhal_manama';
            }
        });
    }

    public function getPhotoUrlAttribute()
    {
        if (empty($this->photo_path)) {
            return null;
        }
        if (str_starts_with($this->photo_path, 'http')) {
            return $this->photo_path;
        }
        $rel = ltrim($this->photo_path, '/');
        // If file exists in public/ folder but not at root, and web server runs from project root
        if (!file_exists(base_path($rel)) && file_exists(base_path('public/' . $rel))) {
            return asset('public/' . $rel);
        }
        return asset($rel);
    }

    /**
     * Get Reg No auto-generation configuration
     */
    public static function getRegNoConfig(): array
    {
        $default = [
            'prefix' => 'SAM',
            'separator' => '-',
            'middle' => '{YEAR}',
            'digits' => 4,
            'suffix' => '',
        ];

        try {
            $setting = MatrimonyMasterOption::where('category', 'reg_no_setting')->first();
            if ($setting && !empty($setting->name_en)) {
                $decoded = json_decode($setting->name_en, true);
                if (is_array($decoded)) {
                    return array_merge($default, $decoded);
                }
            }
        } catch (\Exception $e) {
            // fallback
        }

        return $default;
    }

    /**
     * Generate next Reg No based on configuration
     */
    public static function generateRegNo(): string
    {
        $config = static::getRegNoConfig();
        $nextId = (static::max('id') ?? 0) + 1;
        return static::formatRegNoWithConfig($nextId, $config);
    }

    /**
     * Format Reg No with given ID and config
     */
    public static function formatRegNoWithConfig($id, array $config): string
    {
        $prefix = isset($config['prefix']) && $config['prefix'] !== '' ? trim((string)$config['prefix']) : 'SAM';
        $separator = isset($config['separator']) ? (string)$config['separator'] : '-';
        $middle = isset($config['middle']) && $config['middle'] !== '' ? trim((string)$config['middle']) : '{YEAR}';
        $digits = isset($config['digits']) && is_numeric($config['digits']) ? (int)$config['digits'] : 4;
        $suffix = isset($config['suffix']) ? trim((string)$config['suffix']) : '';

        $year = date('Y');
        $twoYear = date('y');

        if ($middle === 'NONE') {
            $middleResolved = '';
        } else {
            $middleResolved = str_replace(
                ['{YEAR}', '{year}', '{YY}', '{yy}'],
                [$year, $year, $twoYear, $twoYear],
                $middle
            );
        }

        $numberFormatted = $digits > 0 ? str_pad((string)$id, $digits, '0', STR_PAD_LEFT) : (string)$id;

        $parts = [];
        if ($prefix !== '') $parts[] = $prefix;
        if ($middleResolved !== '') $parts[] = $middleResolved;
        if ($numberFormatted !== '') $parts[] = $numberFormatted;

        $res = implode($separator, $parts);
        if ($suffix !== '') {
            $res .= ($separator !== '' ? $separator : '') . $suffix;
        }

        return $res;
    }
}
