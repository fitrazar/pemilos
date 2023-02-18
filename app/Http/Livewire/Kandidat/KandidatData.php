<?php

namespace App\Http\Livewire\Kandidat;

use App\Models\Kandidat;
use App\Models\Pilihan;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class KandidatData extends Component
{
    use LivewireAlert;

    public $kandidat_id, $user_id;

    public function render()
    {
        $kandidats = Kandidat::all();
        
        $pilihan = Pilihan::where('user_id', Auth::user()->id)->first();
        // dd($pilihan);
        return view('livewire.kandidat.kandidat-data', [
            'kandidats' => $kandidats,
            'pilihan' => $pilihan
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->kandidat_id = '';
    }

    public function closeModal()
    {
        $this->resetInput();
        $this->resetErrorBag();
    }

    protected $rules = [
        'kandidat_id' => 'required|not_in:""',
        'user_id' => 'required'
    ];

    protected $messages = [
        'kandidat_id.required' => ':attribute wajib diisi',
    ];

    protected $validationAttributes = [
        'kandidat_id' => 'Kandidat',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function storeKandidat()
    {
        $this->user_id = Auth::user()->id;
        $validatedData = $this->validate();

        Pilihan::create($validatedData);
        $this->alert('success', 'Terima Kasih Sudah Memilih.', [
            'position' => 'top-end',
            'toast' => true,
            'timer' => 7000,
        ]);
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
}
