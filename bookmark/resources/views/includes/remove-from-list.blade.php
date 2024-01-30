<form method='POST' action='/list/{{ $book->slug }}/destroy'>
    {{ csrf_field() }}
    {{ method_field('delete') }}

    <button type='submit' class='button-link' test='{{ $book->slug }}-remove-from-list-button'>
        <i class='fa fa-minus-circle'></i> Remove from list
    </button>
</form>
