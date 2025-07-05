<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'menu';
    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
        'gambar',
        'kategori',
    ];
    
    // app/Models/MenuItem.php

    // ... (kode lain di dalam class MenuItem)

    /**
     * Relasi many-to-many antara MenuItem dan Package.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function packages()
    {
        /**
         * return $this->belongsToMany(
         * RelatedModel::class, 
         * 'nama_tabel_pivot', 
         * 'foreign_key_model_ini_di_pivot', 
         * 'foreign_key_model_terkait_di_pivot'
         * );
         */
        return $this->belongsToMany(Package::class, 'menu_item_package', 'menu_item_id', 'package_id');
    }
}
