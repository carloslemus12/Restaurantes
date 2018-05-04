<ul id="list-comments" class="list-group">
@foreach ($restaurante->comentarios as $comentario)
    @if ($comentario->usuario_id == auth()->user()->id)
    <li class="list-group-item d-flex justify-content-between">{{ $comentario->comentario }}<img comentario={{ $comentario->id }} id="btn_delete" src="{{ asset('img/quit.png') }}" /></li>
    @else
    <li class="list-group-item left-align">{{ $comentario->comentario }}</li>
    @endif
@endforeach
<script>
    $('#btn_delete').on('click', function(){
        var comentario = $('#coment').val();

        var url = "{{ url('/cli/restaurant/comment/delete') }}/"+$(this).attr("comentario");
        
        $.post(url, { _token:"{{ csrf_token() }}" },function(){
            $( "#list-comments" ).load( "{{ route('cli.commentslight', $restaurante->id) }}");
        });
    });
</script>
</ul>

<div class="input-group mb-3">
    <input id="coment" type="text" class="form-control" placeholder="Comentario" aria-label="Comentario" aria-describedby="basic-addon2">
    <div class="input-group-append">
        <button id="comentario" class="btn btn-outline-dark" type="button"><img src="{{ asset('img/send.png') }}" /></button>
    </div>
</div>

<script>
    $('#comentario').on('click', function(){
        var comentario = $('#coment').val();

        var url = "{{ route('cli.restaurantComment', $restaurante->id) }}";
        
        $.post(url, { usuario: {{ auth()->user()->id }}, comentario:comentario, _token:"{{ csrf_token() }}" }, function(){
            $( "#list-comments" ).load( "{{ route('cli.commentslight', $restaurante->id) }}");
            $('#coment').val("");
        });
    });
</script>