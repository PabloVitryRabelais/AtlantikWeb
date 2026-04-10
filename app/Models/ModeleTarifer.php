<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleTarifer extends Model
{
    protected $table = 'tarifer'; 
    protected $primaryKey = 'noperiode, lettrecategorie, notype, noliaison';
    protected $useAutoIncrement = false;
    protected $returnType = 'object'; 
    protected $allowedFields = ['noperiode, lettrecategorie, notype, noliaison, tarif'];

    public function getAllTarifPeriode($datedebut)
    {
        $this->join('periode','tarifer.noperiode = periode.noperiode','inner')
        ->where('periode.datedebut =', $datedebut)
        ->select('lettrecategorie, notype, noliaison, tarif')
        ->get()->getResult();
    }
}
