<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kandidat;
use App\Models\Pilihan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminKandidat extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'destroyKandidat'
    ];
    public $search = '';

    public $kandidat, $nama, $foto, $visi, $misi, $oldImage, $kandidat_id;

    public function render()
    {
        $this->authorize('admin');
        $k1 = Pilihan::where('kandidat_id', 2)->count();
        $k2 = Pilihan::where('kandidat_id', 3)->count();
        // $k3 = Pilihan::where('kandidat_id', 2)->count();

        $p1 = $k1 / ($k1 + $k2) * 100;
        $kandidats = Kandidat::latest()
        ->where('nama', 'like', '%'.$this->search.'%')
        ->paginate(3);
        return view('livewire.admin.admin-kandidat', [
            'kandidats' => $kandidats,
            'k1' => $k1,
            'p1' => $p1
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->kandidat = '';
        $this->nama = '';
        $this->foto = '';
        $this->visi = '';
        $this->misi = '';
    }

    public function closeModal()
    {
        $this->resetInput();
        $this->resetErrorBag();
    }

    protected $rules = [
        'kandidat' => 'required',
        'nama' => 'required',
        'foto' => 'max:2048',
        'visi' => 'required',
        'misi' => 'required'
    ];

    protected $messages = [
        'foto.max' => ':attribute maksimal 2MB',
        'nama.required' => ':attribute wajib diisi',
        'kandidat.required' => ':attribute wajib diisi',
        'visi.required' => ':attribute wajib diisi',
        'misi.required' => ':attribute wajib diisi',
    ];

    protected $validationAttributes = [
        'foto' => 'Foto',
        'nama' => 'Nama',
        'kandidat' => 'Kandidat',
        'visi' => 'Visi',
        'misi' => 'Misi',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function storeKandidat()
    {
        $validatedData = $this->validate();
        if(!empty($this->foto)) {
            $filename = $this->foto->store('images','public');
 
            $validatedData['foto'] = $filename;
        }

        Kandidat::create($validatedData);
        $this->alert('success', 'Kandidat Berhasil Ditambahkan.', [
            'position' => 'top-end',
            'toast' => true,
            'timer' => 4000,
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editKandidat($kandidat_id)
    {
        $kandidat = Kandidat::find($kandidat_id);
        if ($kandidat) {
            $this->kandidat_id = $kandidat->id;
            $this->foto = $kandidat->foto;
            $this->oldImage = $kandidat->foto;
            $this->nama = $kandidat->nama;
            $this->kandidat = $kandidat->kandidat;
            $this->visi = $kandidat->visi;
            $this->misi = $kandidat->misi;
        } else {
            return redirect()->to('/admin/kandidat');
        }
    }

    public function updateKandidat()
    {
        $validatedData = $this->validate();

        if($this->foto != $this->oldImage) {
            $validatedData['foto'] = $this->foto->store('images','public');
            if($this->oldImage) {
                Storage::delete($this->oldImage);
            }
            // $filename = $this->image->store('images','public');
            // $validatedData['image'] = $filename;
        } else {
            $validatedData['foto'] = $this->oldImage;
        }


        Kandidat::where('id', $this->kandidat_id)->update([
            'foto' => $validatedData['foto'],
            'nama' => $validatedData['nama'],
            'kandidat' => $validatedData['kandidat'],
            'visi' => $validatedData['visi'],
            'misi' => $validatedData['misi'],
        ]);
        $this->alert('success', 'Kandidat Berhasil Diupdate.', [
            'position' => 'top-end',
            'toast' => true,
            'timer' => 4000,
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteKandidat($kandidat_id)
    {
        $this->alert('question', 'Yakin data ini ingin dihapus?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'position' => 'center',
            'toast' => false,
            'timer' => 0,
            'confirmButtonText' => 'Yakin',
            'cancelButtonText' => 'Tidak',
            'onConfirmed' => 'destroyKandidat' 
        ]);
        $kandidat = Kandidat::find($kandidat_id);
        $this->kandidat_id = $kandidat_id;
        $this->foto = $kandidat->foto;
    }

    public function destroyKandidat()
    {
        if($this->foto) {
            Storage::delete($this->foto);
        }
        Kandidat::find($this->kandidat_id)->delete();
        $this->alert('success', 'Kandidat Berhasil Dihapus.', [
            'position' => 'top-end',
            'toast' => true,
            'timer' => 4000,
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
}
