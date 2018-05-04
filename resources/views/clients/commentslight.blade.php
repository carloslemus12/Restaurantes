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