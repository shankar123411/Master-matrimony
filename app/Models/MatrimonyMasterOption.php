<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatrimonyMasterOption extends Model
{
    protected $table = 'matrimony_master_options';

    protected $fillable = [
        'category',
        'name_ta',
        'name_en',
        'sort_order',
    ];

    /**
     * Get options array by category and lang
     */
    public static function getOptionsForCategory(string $category, string $lang = 'ta'): array
    {
        $records = self::where('category', $category)->orderBy('sort_order')->orderBy('id')->get();
        if ($records->isEmpty()) {
            return [];
        }

        $result = [];
        foreach ($records as $rec) {
            $val = $rec->name_ta;
            $label = $lang === 'en' ? ($rec->name_en ?: $rec->name_ta) : $rec->name_ta;
            $result[$val] = $label;
        }

        return $result;
    }
}
