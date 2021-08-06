<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
   protected $table         = 'orang';
   protected $useTimestamps = true;
   protected $allowedFields = ['nama', 'alamat'];

   public function search($keyword)
   {
      // $orang = $this->table('orang');
      // $orang->like('nama', $keyword);
      // return $orang;
      return $this->table('orang')->like('nama', $keyword)->orLike('alamat', $keyword);
   }
}
