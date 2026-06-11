<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Tugasku</title>
</head>
<body>

    <h1>Aplikasi Manajemen Tugas - Tugasku</h1>

    <h2>Tambah Tugas Baru</h2>
    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Nama Tugas" required>
        <input type="date" name="due_date" required>
        <button type="submit">Simpan Tugas</button>
    </form>

    <hr>

    <h2>Daftar Tugas Anda</h2>
    <ul>
        @foreach($tasks as $task)
            <li>
                @if($task->is_completed)
                    <del>{{ $task->title }} (Batas: {{ $task->due_date }})</del> <strong>[Selesai]</strong>
                @else
                    {{ $task->title }} (Batas: {{ $task->due_date }})
                    
                    <form action="/tasks/{{ $task->id }}/complete" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit">✔️ Selesai</button>
                    </form>
                @endif

                <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">❌ Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>

</body>
</html>