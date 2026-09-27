<!-- Menampilkan error validasi jika ada -->
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/submit" method="POST">
    @csrf
    
    <label for="name">Nama:</label>
    <input type="text" name="name" id="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="password_confirmation">Konfirmasi Password:</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required><br><br>

    <button type="submit">Kirim</button>
</form>