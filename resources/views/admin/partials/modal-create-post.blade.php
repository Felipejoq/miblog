<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form action="{{route('admin.posts.store')}}" method="POST">
            {{  csrf_field() }}

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="exampleModalLabel">Crear publicación</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <input value="{{ old('title') }}" id="title" name="title" type="text" class="form-control" placeholder="Escribe el título del post..." required />
                        {!! $errors->first('title','<span class="help-block">:message</span>') !!}
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                    <button class="btn btn-primary"><i class="fa fa-plus"></i> Crear post</button>
                </div>
            </div>
        </form>

    </div>
</div>