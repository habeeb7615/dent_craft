@props(['errors'])

@if ($errors->any())
    <div class="alert alert-info border-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="icofont icofont-close-line-circled"></i>
        </button>
        <code style='color:green;'>
            @foreach ($errors->all() as $error)
                --{{ $error }} <br>
            @endforeach
        </code>
    </div>
@endif
