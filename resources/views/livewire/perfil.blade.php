<div class="container-fluid bg-white rounded-top shadow-lg p-0"
    style="margin-top: 25vh; min-height: calc(75vh - 68px); padding-bottom: 50px;">

    <div class="container-fluid">
        <div class="row justify-content-center">

            <div class="col-6 col-md-4 border border-black" style="margin-top: -80px;">
                <div class="card shadow border-0 text-center p-3 bg-slate-200 rounded-2">

                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('img/default-avatar.png') }}"
                        class="rounded-circle mx-auto img-thumbnail shadow-sm"
                        style="width: 120px; height: 120px; margin-top: -60px; object-fit: cover;">
                    <h4 class="mt-3 fw-bold">{{$user->name}}</h4>
                    <div class="d-flex justify-content-around text-muted sm mt-2">
                        <span><strong>{{$postagens->count()}}</strong> Postagens</span>
                        <span><strong>{{$seguidores->count()}}</strong> Seguidores</span>
                    </div>
                    <div class="d-flex justify-content-center mt-4 sm">
                        <a href="{{route('postagem')}}" class="btn btn-primary w-75" role='button'>+ Postagem</a>
                    </div>
                    <div class="mb-3 mt-4 text-start">
                        <label for="bio" class="form-label fw-bold fs-5">Bio</label>
                        <input type="text" class="form-control" wire:model.live="bio" placeholder="Escreva sua bio...">
                    </div>
                </div>
            </div>

            <div class="border border-black col-sm-6 col-md-8 mt-4 px-4 text-center">
                <div class="mb-4">
                    <h5 class="fw-bold">PROJETOS</h5>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 border-0 bg-light shadow-sm" style="min-height: 200px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>