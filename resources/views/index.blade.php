@extends('layouts.app')

@section('title', trans('cape-api::messages.title'))

@push('footer-scripts')
    <script>
        const capeInput = document.getElementById('cape');
        capeInput.addEventListener('change', function () {
            if (!capeInput.files || !capeInput.files[0]) {
                return;
            }
            const file = capeInput.files[0];
            if (file.name !== undefined && file.name !== '') {
                document.getElementById('capeLabel').innerText = file.name;
            }
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('capePreview');
                preview.src = e.currentTarget.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(capeInput.files[0]);
        });
    </script>
    <script>
        const skinInput = document.getElementById('skin');
        skinInput.addEventListener('change', function () {
            if (!skinInput.files || !skinInput.files[0]) {
                return;
            }
            const file = skinInput.files[0];
            if (file.name !== undefined && file.name !== '') {
                document.getElementById('skinLabel').innerText = file.name;
            }
            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('skinPreview');
                preview.src = e.currentTarget.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(skinInput.files[0]);
        });
    </script>
@endpush

@section('content')
    <div class="container content">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('cape-api.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h2>{{ trans('cape-api::messages.change') }}</h2>

                    <div class="form-group">
                        <label for="cape">{{ trans('cape-api::messages.cape') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('cape') is-invalid @enderror" id="cape" name="cape" accept=".png" required>
                            <label class="custom-file-label" for="cape" data-browse="{{ trans('messages.actions.browse') }}" id="capeLabel">
                                {{ trans('messages.actions.choose-file') }}
                            </label>

                            @error('cape')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <img src="{{ $capeUrl }}" alt="{{ trans('cape-api::messages.cape') }}" id="capePreview" class="mt-3 img-fluid" style="image-rendering: pixelated; width: 350px">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ trans('messages.actions.save') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
    <div class="container content">
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('skin-api.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h2>{{ trans('skin-api::messages.change') }}</h2>

                    <div class="form-group">
                        <label for="skin">{{ trans('skin-api::messages.skin') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('skin') is-invalid @enderror" id="skin" name="skin" accept=".png" required>
                            <label class="custom-file-label" for="skin" data-browse="{{ trans('messages.actions.browse') }}" id="skinLabel">
                                {{ trans('messages.actions.choose-file') }}
                            </label>

                            @error('skin')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <img src="{{ $skinUrl }}" alt="{{ trans('skin-api::messages.skin') }}" id="skinPreview" class="mt-3 img-fluid" style="image-rendering: pixelated; width: 350px">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        {{ trans('messages.actions.save') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection