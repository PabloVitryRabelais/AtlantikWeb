<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleCategorie extends Model
{
    protected $table = 'categorie'; 
    protected $primaryKey = 'lettrecategorie';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = ['lettrecategorie', 'libelle'];

    public function getAllCategorieType()
    {
        return $this->join('type','categorie.lettrecategorie = type.lettrecategorie','inner')
        ->select('categorie.lettrecategorie as lettre, categorie.libelle as lettreLibelle , notype as type, type.libelle as typeLibelle')
        ->get()->getResult();
    }
}