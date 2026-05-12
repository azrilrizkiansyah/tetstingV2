<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReminderOS — Smart Reminder</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="shell">

        <!--  SIDEBAR  -->
        <aside class="sidebar">

            <!-- Logo -->
            <div class="sidebar-logo">
                <div class="logo-box">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z" />
                    </svg>
                </div>
                <span class="logo-text">Reminder<span>OS</span></span>
            </div>

            <!-- Menu Utama -->
            <div class="nav-group">
                <div class="nav-group-label">Main</div>

                <div class="nav-item active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" rx="1" />
                        <rect x="14" y="3" width="7" height="7" rx="1" />
                        <rect x="3" y="14" width="7" height="7" rx="1" />
                        <rect x="14" y="14" width="7" height="7" rx="1" />
                    </svg>
                    Dashboard
                    <span class="nav-badge" id="nb-overdue" style="display:none">0</span>
                </div>

                <div class="nav-item" onclick="setTab('upcoming')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    Akan Datang
                </div>

                <div class="nav-item" onclick="setTab('done')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    Selesai
                </div>

                <div class="nav-item" onclick="setTab('overdue')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                        <line x1="12" y1="9" x2="12" y2="13" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                    Terlewat
                </div>
            </div>

            <!-- Menu Filter Prioritas -->
            <div class="nav-group">
                <div class="nav-group-label">Prioritas</div>
                <div class="nav-item" onclick="filterByPriority('high')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                    High Priority
                </div>
                <div class="nav-item" onclick="filterByPriority('medium')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    Medium Priority
                </div>
                <div class="nav-item" onclick="filterByPriority('low')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                    Low Priority
                </div>
            </div>

            <!-- Menu Sistem -->
            <div class="nav-group">
                <div class="nav-group-label">Sistem</div>
                <div class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14" />
                    </svg>
                    Pengaturan
                </div>
                <div class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Logout
                </div>
            </div>

        </aside>


        <!-- /SIDEBAR -->
        <!--  AREA KANAN  -->
        <div class="main">

            <!-- NAVBAR -->
            <nav class="navbar">
                <div class="search-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" id="search-input" placeholder="Cari pengingat..." oninput="renderList()">
                </div>
                <div class="navbar-right">
                    <span class="clock" id="clock-display"><?php
                    
                    date_default_timezone_set('Asia/Jakarta');
                    echo date('H:i d-m-Y');
                    ?></span>
                    <div class="notif-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0" />
                        </svg>
                        <div class="notif-dot" id="notif-dot"></div>
                    </div>

                </div>
            </nav>

            <!-- KONTEN -->
            <div class="content">

                <!-- Header halaman -->
                @foreach ($Admins as $admin)
                    <div class="page-header">
                        <h2>Selamat Datang,{{ $admin->username }}</h2>
                        <p>Semua sistem berjalan lancar. Anda memiliki
                            <span id="overdue-text">{{ $overdue ?? 0 }} pengingat terlewat.</span>
                        </p>
                    </div>
                @endforeach

                <!-- Alert notifikasi (tampil otomatis via JS) -->
                <div class="alert-bar" id="alert-bar">
                    <div class="alert-icon">&#128276;</div>
                    <div class="alert-body">
                        <div class="alert-title" id="alert-title"></div>
                        <div class="alert-sub" id="alert-sub"></div>
                    </div>
                    <button class="alert-close" onclick="tutupAlert()">&#215;</button>
                </div>

                <!-- 3 Kartu statistik -->
                <div class="stats-row">
                    <div class="stat-card card-blue" onclick="setTab('all')">
                        <div class="stat-label">Total Pengingat</div>
                        <div class="stat-num" id="sc-total">{{ $total ?? 0 }}</div>
                        <div class="stat-sub">semua kategori</div>
                        <div class="stat-deco"></div>
                    </div>
                    <div class="stat-card card-indigo" onclick="setTab('upcoming')">
                        <div class="stat-label">Akan Datang</div>
                        <div class="stat-num" id="sc-upcoming">{{ $upcoming ?? 0 }}</div>
                        <div class="stat-sub">belum jatuh tempo</div>
                        <div class="stat-deco"></div>
                    </div>
                    <div class="stat-card card-green" onclick="setTab('done')">
                        <div class="stat-label">Selesai</div>
                        <div class="stat-num" id="sc-done">{{ $done ?? 0 }}</div>
                        <div class="stat-sub">berhasil diselesaikan</div>
                        <div class="stat-deco"></div>
                    </div>
                </div>

                <!-- Grid utama: daftar + form -->
                <div class="main-grid">

                    <!-- PANEL KIRI: Daftar Pengingat -->
                    <div class="panel">
                        <div class="panel-head">
                            <span class="panel-title" id="panel-title">Semua Pengingat</span>
                            <span class="panel-action" onclick="hapusSelesai()">Hapus selesai</span>
                        </div>

                        <!-- Tab filter -->
                        <div class="tab-bar">
                            <button class="tab-btn active" id="tab-all" onclick="setTab('all')"> Semua <span
                                    class="tab-count" id="tc-all">{{ $total ?? 0 }}</span></button>
                            <button class="tab-btn" id="tab-upcoming" onclick="setTab('upcoming')"> Akan Datang <span
                                    class="tab-count" id="tc-upcoming">{{ $upcoming ?? 0 }}</span></button>
                            <button class="tab-btn" id="tab-done" onclick="setTab('done')"> Selesai <span
                                    class="tab-count" id="tc-done">{{ $done ?? 0 }}</span></button>
                            <button class="tab-btn" id="tab-overdue" onclick="setTab('overdue')"> Terlewat <span
                                    class="tab-count" id="tc-overdue">{{ $overdue ?? 0 }}</span></button>
                        </div>

                        <!-- Progress bar -->
                        <div class="progress-section">
                            <div class="prog-label">
                                <span>Progress penyelesaian</span>
                                <span id="prog-pct">0%</span>
                            </div>
                            <div class="prog-track">
                                <div class="prog-fill" id="prog-fill" style="width: 0%"></div>
                            </div>
                        </div>

                        <!-- List item pengingat -->
                        <div class="reminder-list" id="reminder-list">
                            @forelse ($jadwal as $item)
                                <div class="reminder-item {{ $item->status === 'done' ? 'item-done' : '' }}"
                                    data-id="{{ $item->id }}">
                                    <div class="item-left">
                                        <div class="custom-checkbox {{ $item->status === 'done' ? 'checked' : '' }}"
                                            onclick="updateStatus({{ $item->id }})">
                                            @if ($item->status === 'done')
                                                ✓
                                            @endif
                                        </div>

                                        <div class="item-info">
                                            <h4 class="item-title">{{ $item->title }}</h4>
                                            <p class="item-note">{{ $item->note ?? 'Tidak ada catatan' }}</p>

                                            <div class="item-meta">
                                                <span class="meta-time">
                                                    <svg width="12" height="12" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2">
                                                        <circle cx="12" cy="12" r="10" />
                                                        <polyline points="12 6 12 12 16 14" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($item->due_date)->format('H:i d-m-Y') }}
                                                </span>

                                                @php
                                                    $prioClass =
                                                        [
                                                            'high' => 'prio-high',
                                                            'medium' => 'prio-medium',
                                                            'low' => 'prio-low',
                                                        ][$item->priority] ?? 'prio-low';
                                                @endphp
                                                <span
                                                    class="badge {{ $prioClass }}">{{ strtoupper($item->priority) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item-actions">
                                        <form action="{{ route('reminder.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"
                                                onclick="return confirm('Hapus pengingat ini?')">
                                                <svg width="18" height="18" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <p>Belum ada pengingat. Yuk, buat satu!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- PANEL KANAN: Form Tambah -->
                    <div class="add-panel">
                        <div class="add-head">
                            <div class="add-title">Tambah Pengingat</div>
                            <div class="add-sub">Atur waktu, prioritas, dan detail tugas</div>
                        </div>
                        <div class="form-body">

                            <div class="field">
                                <label>Judul Pengingat *</label>
                                <input type="text" id="f-title" placeholder="Contoh: Meeting dengan tim dev...">
                            </div>

                            <div class="field">
                                <label>Catatan (opsional)</label>
                                <textarea id="f-note" placeholder="Detail tambahan..."></textarea>
                            </div>

                            <div class="field">
                                <label>Ingatkan Dalam</label>
                                <div class="time-row">
                                    <input type="number" id="f-amount" value="30" min="1">
                                    <select id="f-unit">
                                        <option value="minute">Menit</option>
                                        <option value="hour">Jam</option>
                                        <option value="day">Hari</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label>Tingkat Kepentingan</label>
                                <div class="priority-row">
                                    <button class="p-btn p-low sel" id="pb-low" onclick="pilihPrioritas('low')">
                                        <span class="p-dot"></span>Low</button>
                                    <button class="p-btn p-medium" id="pb-medium"
                                        onclick="pilihPrioritas('medium')"><span class="p-dot"></span>Medium</button>
                                    <button class="p-btn p-high" id="pb-high" onclick="pilihPrioritas('high')">
                                        <span class="p-dot"></span>High</button>
                                </div>
                            </div>

                            <button class="submit-btn" onclick="tambahPengingat()">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                Tambah Pengingat
                            </button>

                        </div>

                        <!-- Ringkasan item terlewat -->
                        <div class="overdue-card">
                            <div class="overdue-card-label">&#128680; Terlewat</div>
                            <div class="overdue-card-list" id="overdue-list">Tidak ada pengingat terlewat</div>
                        </div>
                    </div>

                </div><!-- /main-grid -->
            </div><!-- /content -->
        </div><!-- /main -->
    </div><!-- /shell -->

</body>
<script src=""></script>

</html>
