<div>
    @include('livewire.admin.modal')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">Hasil / Persentase</div>
                    <div class="card-body">
                        <div class="card-text">
                            <p>Kandidat 1 - {{ $k1 }} Suara / {{ $p1 }}%</p>
                            
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Data Kandidat</div>
                    <div class="card-body">
                        {{-- @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif --}}
                        <input class="form-control me-2 mb-3" type="search" placeholder="Search..." wire:model="search">
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#create" wire:loading.remove>
                            Create
                        </button>
                        <button type="button" class="btn btn-primary disabled placeholder col-2 mb-3" wire:loading>
                        </button>
                        <div wire:loading.block>
                            <p class="placeholder-glow">
                                <span class="placeholder col-12"></span>
                                <span class="placeholder col-12 placeholder-lg"></span>
                                <span class="placeholder col-12 placeholder-xs"></span>
                                <span class="placeholder col-12 placeholder-lg"></span>
                                <span class="placeholder col-12 placeholder-sm"></span>
                            </p>
                        </div>
                        <table class="table table-bordered table-striped" wire:loading.remove>
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kandidat</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @forelse ($kandidats as $kandidat)
                                <tr>
                                  <th scope="row">{{ ($kandidats->currentpage()-1) * $kandidats->perpage() + $loop->index + 1 }}</th>
                                  <td>{{ $kandidat->kandidat }}</td>
                                  <td>{{ $kandidat->nama }}</td>
                                  <td>
                                    <button type="button" class="btn btn-warning" wire:click="editKandidat({{ $kandidat->id }})" data-bs-toggle="modal" data-bs-target="#edit">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger" wire:click="deleteKandidat({{ $kandidat->id }})" >
                                        Delete
                                    </button>
                                  </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No Data Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                          </table>
                          <div>
                            {{ $kandidats->links() }}
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
