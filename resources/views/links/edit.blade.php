<h1>Edit Link</h1>

<form action="{{ route('links.update', $link) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="url" name="original_url" value="{{ $link->original_url }}" required>
    <button type="submit">Update Link</button>
</form>
