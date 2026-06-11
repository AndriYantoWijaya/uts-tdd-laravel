<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugasku - Aplikasi Manajemen Tugas</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #16a34a;
            --danger: #dc2626;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: var(--card);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 24px;
            color: var(--primary);
            text-align: center;
        }

        h2 {
            font-size: 16px;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-group {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        input[type="text"] {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus {
            border-color: var(--primary);
        }

        input[type="date"] {
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            color: var(--text-muted);
        }

        button.btn-submit {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button.btn-submit:hover {
            background-color: var(--primary-hover);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            background: var(--bg);
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #f1f5f9;
        }

        .task-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .task-title {
            font-weight: 500;
            font-size: 15px;
        }

        .task-date {
            font-size: 12px;
            color: var(--text-muted);
        }

        .completed .task-title {
            text-decoration: line-through;
            color: var(--text-muted);
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }

        .btn-complete:hover {
            background-color: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .btn-complete {
            color: var(--success);
        }
        .btn-complete:hover {
            background-color: #f0fdf4;
            border-color: var(--success);
        }

        .btn-delete {
            color: var(--danger);
        }
        .btn-delete:hover {
            background-color: #fef2f2;
            border-color: var(--danger);
        }

        .badge-success {
            background: #dcfce7;
            color: #15803d;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            align-self: flex-start;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Tugasku</h1>

        <h2>Tambah Tugas Baru</h2>
        <form action="/tasks" method="POST" class="form-group">
            @csrf
            <input type="text" name="title" placeholder="Apa yang ingin dikerjakan?" required>
            <input type="date" name="due_date" required>
            <button type="submit" class="btn-submit">Simpan</button>
        </form>

        <h2>Daftar Tugas</h2>
        <ul>
            @foreach($tasks as $task)
                <li class="{{ $task->is_completed ? 'completed' : '' }}">
                    <div class="task-info">
                        <span class="task-title">{{ $task->title }}</span>
                        <span class="task-date">📅 Batas waktu: {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</span>
                        @if($task->is_completed)
                            <span class="badge-success">Selesai</span>
                        @endif
                    </div>
                    
                    <div class="actions">
                        @if(!$task->is_completed)
                            <form action="/tasks/{{ $task->id }}/complete" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-action btn-complete">✔️ Selesai</button>
                            </form>
                        @endif

                        <form action="/tasks/{{ $task->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus tugas ini?')">❌ Hapus</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>