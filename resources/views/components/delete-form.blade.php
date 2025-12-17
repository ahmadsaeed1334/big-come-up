@props([
    'action',
    'text' => 'Are you sure you want to delete this item?',
    'title' => 'Confirm Delete',
    'confirmButton' => 'Yes, delete',
    'cancelButton' => 'Cancel',
    'buttonLabel' => 'Delete',
    'buttonClass' => 'btn btn-sm btn-outline-danger',
])

<form method="POST" action="{{ $action }}" class="d-inline" data-confirm-delete="{{ $text }}"
    data-confirm-title="{{ $title }}" data-confirm-button="{{ $confirmButton }}"
    data-cancel-button="{{ $cancelButton }}">
    @csrf
    @method('DELETE')

    <button type="submit" class="{{ $buttonClass }}">
        {{ $buttonLabel }}
    </button>
</form>
