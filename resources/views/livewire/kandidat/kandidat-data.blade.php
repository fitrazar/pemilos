<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">Pilih Kandidat</div>
                    <div class="card-body">
                        @if ($pilihan)
                        <p class="card-text text-center fw-bold">Anda Sudah Melakukan Pemilihan!</p>
                        @else
                        <form class="d-flex align-items-start justify-content-center" wire:submit.prevent="storeKandidat">
                                <div class="mb-3">
                                    <select class="me-3 form-select @error('kandidat_id') is-invalid @enderror" id="kandidat_id" wire:model="kandidat_id">
                                        <option selected value="">-- Pilih Kandidat --</option>
                                        @foreach ($kandidats as $kandidat)
                                            <option value="{{ $kandidat->id }}" {{ old('kandidat_id') == $kandidat->id ? ' selected' : ' ' }}>{{ $kandidat->kandidat }}</option>
                                        @endforeach
                                    </select>
                                    @error('kandidat_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="ms-2 mb-3 btn btn-primary" wire:loading.remove>Pilih</button>
                                <div class="ms-2 mb-3 spinner-border text-primary" role="status" wire:loading>
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="card p-3 shadow">
                    <h2 class="text-center p-3">Kandidat</h2>
                    <nav>
                        <div class="nav nav-fill nav-tabs mb-3" id="nav-tab" role="tablist">
                            @foreach ($kandidats as $kandidat)
                            <button class="nav-link {{ $kandidat->kandidat == 'Kandidat 1' ? 'active' : '' }}" id="nav-{{ $kandidat->id }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $kandidat->id }}" type="button" role="tab" aria-controls="nav-{{ $kandidat->id }}" aria-selected="true">{{ $kandidat->kandidat }}</button>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content p-3 border bg-light" id="nav-tabContent">
                        @foreach ($kandidats as $kandidat)
                        <div class="tab-pane fade {{ $kandidat->kandidat == 'Kandidat 1' ? 'active' : '' }} show" id="nav-{{ $kandidat->id }}" role="tabpanel" aria-labelledby="nav-{{ $kandidat->id }}-tab" wire:loading>
                            <h1 class="text-center"><strong>{{ $kandidat->nama }}</strong></h1>
                            <center><img src="{{ asset('storage/' . $kandidat->foto) }}" class="rounded img-fluid d-block mb-3" style="width: 50%" alt={{ $kandidat->nama }}></center>
                            <h2 class="text-center">VISI</h2>
                            {!! $kandidat->visi !!}
                            <h2 class="text-center">MISI</h2>
                            {!! $kandidat->misi !!}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
