@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Fotografias {{ 'PTL'.str_repeat("0", 3 - strlen("$platillo->id") ).$platillo->id }}
@endsection

@section('content')
<div class="container">
    <form id="form-img" enctype="multipart/form-data" method="POST" action="{{ route('picture2.add', $platillo->id) }}" >
        {!! csrf_field() !!}
        <div class="input-group mb-2">
            <input type="file" class="form-control" id="img" name="img" placeholder="Imagen del platillo" accept="image/x-png,image/gif,image/jpeg" />
            <div class="input-group-prepend">
                <button type="submit" class="btn btn-success">Subir imagen</button>
            </div>
        </div>
    </form>

    <div class="card-columns">
        @foreach ($platillo->fotos as $foto)
            <div class="card">
                <img class="card-img-top" src="{{ asset('storage/'.$foto->foto) }}" alt="Card image cap">
                <div class="card-body p-0">
                    <form method="POST" action="{{ route('picture2.remove', $platillo->id) }}">
                        {!! csrf_field() !!}

                        <input type="hidden" name="id" value="{{ $foto->id }}">

                        <button type="submit" class="btn btn-danger w-100 m-0">Eliminar imagen</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#form-img').validate({
                rules: {
                    img: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection