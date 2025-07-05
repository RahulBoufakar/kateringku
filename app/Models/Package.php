<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Package.php
class Package extends Model
{
    use HasFactory;
    protected $guarded = []; // Izinkan mass assignment

    /**
     * Relasi many-to-many antara Package dan MenuItem.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menuItems()
    {
        /**
         * return $this->belongsToMany(
         * RelatedModel::class, 
         * 'nama_tabel_pivot', 
         * 'foreign_key_model_ini_di_pivot', 
         * 'foreign_key_model_terkait_di_pivot'
         * );
         */
        return $this->belongsToMany(menu::class, 'menu_item_package', 'package_id', 'menu_item_id');

    }
}