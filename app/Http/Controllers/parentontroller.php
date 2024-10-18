<?php

namespace App\Http\Controllers;

use App\Models\Blood;
use App\Models\Nationalities;
use App\Models\parent_file;
use App\Models\parents;
use App\Models\student;
use Illuminate\Http\Request;

use function Livewire\store;
use App\Repository\ParentRepositoryInterface;
class parentontroller extends Controller
{
    //
    protected $parent;
    public function __construct(ParentRepositoryInterface $parent)
    {
        $this->parent =$parent;
    }
    public function index()
    {

        $my_parents = parents::all();

        return view('parents.index', compact('my_parents'));
        // $this->parent->get_all_parents();
    }

    public function create()
    {
        $Nationalities = Nationalities::all();
        $Type_Bloods = Blood::all();
        $Religions = Blood::all();
        return view('parents.create', compact('Nationalities', 'Type_Bloods', 'Religions'));
        $this->parent->Create_parents();
    }

    public function store(Request $request)
    {
        $this->parent->store_parents($request);
    }

    public function edit( $id)
    {
        $this->parent->edit_parents($id);
    }
    
    public function update(Request $request)
    {
        $this->parent->update_parents($request);
    }
    
        public function delete( $id)
        {
            $this->parent->delete_parents($id);
        }
    
}
