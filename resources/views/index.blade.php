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
                document.getElementById('capeabel').innerText = file.name;
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
@endsection