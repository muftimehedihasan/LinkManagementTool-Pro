<h1>Create a New Link</h1>

<form action="{{ route('links.store') }}" method="POST">
    @csrf
    <input type="url" name="original_url" placeholder="Enter Original URL" required>
    <button type="submit">Create Shortened URL</button>
</form>
