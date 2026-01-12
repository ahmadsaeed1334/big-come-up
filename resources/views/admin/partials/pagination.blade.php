{{-- @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator && $items->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            Showing {{ $items->firstItem() }} to {{ $items->lastItem() }}
            of {{ $items->total() }} entries
        </div>

        <nav>
            {{ $items->links('pagination::bootstrap-5') }}
        </nav>
    </div>
@endif --}}
{{-- @if ($items instanceof \Illuminate\Pagination\LengthAwarePaginator && $items->hasPages())
    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mx-3 mt-3">
        <div class="text-muted">
            Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of
            {{ $items->total() }} entries
        </div>
        <div>
            {{ $items->links() }}

        </div>
    </div>
@endif --}}
<!-- Pagination -->
<div class="pt-0 pb-0">
    <div class="d-flex justify-content-between align-items-center px-4 py-3">
        <div>
            <p class="text-sm text-muted mb-0">
                Showing <strong>{{ $items->firstItem() }}</strong> to
                <strong>{{ $items->lastItem() }}</strong> of
                <strong>{{ $items->total() }}</strong> entries
            </p>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0">
                {{ $items->links('pagination::bootstrap-4') }}
            </ul>
        </nav>
    </div>
</div>
