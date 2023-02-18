<!-- Modal Create -->
<div wire:ignore.self class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createLabel">Create Kandidat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close" wire:loading.attr="hidden" wire:submit="storeKandidat"></button>
        </div>
        <form wire:submit.prevent="storeKandidat">
            <div class="modal-body">
                <div class="mb-3">
                    <div x-data="{ isUploading: false, progress: 5 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false; progress = 5"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" wire:model.defer="foto">
                        <div x-show.transition="isUploading" class="progress mt-2" style="height: 10px" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" x-bind:style="`width: ${progress}%`"></div>
                        </div>
                        @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                {{-- @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="rounded img-fluid d-block mb-3" style="width: 50%" alt="">
                @endif --}}
                <div class="mb-3">
                    <label for="kandidat" class="form-label">Kandidat</label>
                    <input type="text" class="form-control @error('kandidat') is-invalid @enderror" id="kandidat" wire:model.defer="kandidat">
                    @error('kandidat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" wire:model.defer="nama">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3" wire:ignore>
                    <label for="visi" class="form-label">Visi</label>
                    <textarea id="visi" class="form-control @error('visi') is-invalid @enderror"></textarea>
                    @error('visi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3" wire:ignore>
                    <label for="misi" class="form-label">Misi</label>
                    <textarea id="misi" class="form-control @error('misi') is-invalid @enderror"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal" wire:loading.attr="hidden" wire:submit="storeKandidat">Close</button>
              <button type="submit" class="btn btn-primary" wire:loading.attr="hidden">Create</button>
                <div class="mb-3" wire:loading.class="spinner-border text-primary d-block" wire:click="storeKandidat">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>

<!-- Modal Edit -->
<div wire:ignore.self class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editLabel">Edit Kandidat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close" wire:loading.attr="hidden" wire:submit="updateKandidat"></button>
        </div>
        <form wire:submit.prevent="updateKandidat">
            <div class="modal-body">
                <div class="mb-3">
                    <div x-data="{ isUploading: false, progress: 5 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false; progress = 5"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="hidden" id="oldImage" wire:model.defer="oldImage">
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" wire:model.defer="foto">
                        <div x-show.transition="isUploading" class="progress mt-2" style="height: 10px" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" x-bind:style="`width: ${progress}%`"></div>
                        </div>
                        @error('foto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                @if ($foto)
                    <img src="{{ asset('storage/' . $foto) }}" class="rounded img-fluid d-block mb-3" style="width: 50%" alt="">
                @endif
                {{-- @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="rounded img-fluid d-block mb-3" style="width: 50%" alt="">
                @endif --}}
                <div class="mb-3">
                    <label for="kandidat" class="form-label">Kandidat</label>
                    <input type="text" class="form-control @error('kandidat') is-invalid @enderror" id="kandidat" wire:model.defer="kandidat">
                    @error('kandidat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" wire:model.defer="nama">
                    @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3" wire:ignore>
                    <label for="visi" class="form-label">Visi</label>
                    <textarea id="visiE">{!! $visi !!}</textarea>
                    @error('visi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3" wire:ignore>
                    <label for="misi" class="form-label">Misi</label>
                    <textarea id="misiE">{!! $misi !!}</textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal" wire:loading.attr="hidden" wire:submit="updateKandidat">Close</button>
              <button type="submit" id="mysubmit" class="btn btn-primary" wire:loading.attr="hidden">Update</button>
                <div class="mb-3" wire:loading.class="spinner-border text-primary d-block" wire:click="updateKandidat">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
    .create(document.querySelector('#visi'))
    .then(editor => {
        editor.model.document.on('change:data', () => {
            @this.set('visi', editor.getData());
        })
    })
    .catch(error => {
        console.error(error);
    });
    ClassicEditor
    .create(document.querySelector('#misi'))
    .then(editor => {
        editor.model.document.on('change:data', () => {
            @this.set('misi', editor.getData());
        })
    })
    .catch(error => {
        console.error(error);
    });
    // Edit
    ClassicEditor
    .create(document.querySelector('#visiE'))
    .then(editor => {
        editor.model.document.on('change:data', () => {
            @this.set('visi', editor.getData());
        })
    })
    .catch(error => {
        console.error(error);
    });
    ClassicEditor
    .create(document.querySelector('#misiE'))
    .then(editor => {
        editor.model.document.on('change:data', () => {
            @this.set('misi', editor.getData());
        })
    })
    .catch(error => {
        console.error(error);
    });
</script>
@endpush