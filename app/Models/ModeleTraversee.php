<?php
namespace App\Models;
use CodeIgniter\Model;

class ModeleTraversee extends Model
{
    protected $table = 'traversee trv'; 
    protected $primaryKey = 'notraversee';
    protected $useAutoIncrement = true;
    protected $returnType = 'object'; 
    protected $allowedFields = ['noliaison','nobateau','dateheuredepart','dateheurearrivee','clotureembarquement'];

    public function getAllTraverseeLiaisons($noLiason, $datedebut)
    {
        $conditon = ['trv.nolaison =' => $noLiason];

        return $this->join('bateau','trv.nobateau = bateau.nobateau','inner')
        ->join('contenir','bateau.nobateau = contenir.nobateau','inner')
        ->join('categorie','contenir.lettrecategorie = categorie.lettrecategorie','inner')
        ->where($conditon)
        ->like('trv.dateheuredepart', $datedebut, 'after')
        ->select('trv.notraversee as noTraversee, trv.dateheuredepart as dateheuredepart, bateau.nom as nomBateau, categorie.lettrecategorie as lettre, categorie.libelle as libelle')
        ->get()->getResult();
    }

    public function getAllPlacesTraversee($noLiason, $datedebut)
    {
        $conditon = ['trv.nolaison =' => $noLiason];

        return $this->join('reservation','trv.notraversee = reservation.notraversee','inner')
        ->join('enregistrer','reservation.noreservation = enregistrer.noreservation','inner')
        ->where($conditon)
        ->like('trv.dateheuredepart', $datedebut, 'after')
        ->select('reservation.notraversee as noTraversee, enregistrer.lettrecategorie as lettreCategorie, enregistrer.quantitereservee as quantReservee')
        ->get->getResult();
    }
}