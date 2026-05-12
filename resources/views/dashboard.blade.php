<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReminderOS — Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=DM+Mono&display=swap" rel="stylesheet">
    @vite(['resources/css/dashboard.css', 'resources/js/app.js'])
</head>

<body>
    <div class="shell">

        {{-- ===== SIDEBAR ===== --}}
        <aside class="sidebar">

            <div class="sidebar-logo">
                <div class="logo-box">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                    </svg>
                </div>
                <span class="logo-text">Reminder<span>OS</span></span>
            </div>

            <div class="nav-group">
                <div class="nav-group-label">Main</div>
                <div class="nav-item active" onclick="setTab('all')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>
                    Dashboard
                    <span class="nav-badge" id="nb-overdue" style="display:none">0</span>
                </div>
                <div class="nav-item" onclick="setTab('upcoming')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                    </svg>
                    Akan Datang
                </div>
                <div class="nav-item" onclick="setTab('done')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Selesai
                </div>
                <div class="nav-item" onclick="setTab('overdue')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                    Terlewat
                </div>
            </div>

            <div class="nav-group">
                <div class="nav-group-label">Prioritas</div>
                <div class="nav-item" onclick="filterByPriority('high')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                    </svg>
                    High Priority
                </div>
                <div class="nav-item" onclick="filterByPriority('medium')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Medium Priority
                </div>
                <div class="nav-item" onclick="filterByPriority('low')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                    </svg>
                    Low Priority
                </div>
            </div>

            <div class="nav-group">
                <div class="nav-group-label">Sistem</div>
                <div class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
                    </svg>
                    Pengaturan
                </div>

                {{-- Logout — Breeze pakai POST --}}
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <div class="nav-item" onclick="document.getElementById('logout-form').submit()" style="cursor:pointer">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Logout
                    </div>
                </form>
            </div>

        </aside>

        {{-- ===== AREA KANAN ===== --}}
        <div class="main">

            <nav class="navbar">
                <div class="search-box">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="text" id="search-input" placeholder="Cari pengingat..." oninput="renderList()">
                </div>
                <div class="navbar-right">
                    <span class="clock" id="clock-display"></span>
                    <div class="notif-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/>
                        </svg>
                        <div class="notif-dot" id="notif-dot" style="display:none"></div>
                    </div>
                </div>
            </nav>

            <div class="content">

                <div class="page-header">
                    <h2>Selamat Datang, {{ Auth::user()->name }}</h2>
                    <p>Semua sistem berjalan lancar. Anda memiliki
                        <span id="overdue-text">0 pengingat terlewat.</span>
                    </p>
                </div>

                {{-- Flash session --}}
                @if (session('status'))
                    <div class="alert-bar" id="alert-bar" style="display:flex">
                        <div class="alert-icon">&#128276;</div>
                        <div class="alert-body">
                            <div class="alert-title">{{ session('status') }}</div>
                        </div>
                        <button class="alert-close" onclick="document.getElementById('alert-bar').style.display='none'">&#215;</button>
                    </div>
                @endif
                <div class="alert-bar" id="alert-bar-js" style="display:none">
                    <div class="alert-icon">&#128276;</div>
                    <div class="alert-body">
                        <div class="alert-title" id="alert-title"></div>
                        <div class="alert-sub" id="alert-sub"></div>
                    </div>
                    <button class="alert-close" onclick="tutupAlert()">&#215;</button>
                </div>

                <div class="stats-row">
                    <div class="stat-card card-blue" onclick="setTab('all')">
                        <div class="stat-label">Total Pengingat</div>
                        <div class="stat-num" id="sc-total">0</div>
                        <div class="stat-sub">semua kategori</div>
                        <div class="stat-deco"></div>
                    </div>
                    <div class="stat-card card-indigo" onclick="setTab('upcoming')">
                        <div class="stat-label">Akan Datang</div>
                        <div class="stat-num" id="sc-upcoming">0</div>
                        <div class="stat-sub">belum jatuh tempo</div>
                        <div class="stat-deco"></div>
                    </div>
                    <div class="stat-card card-green" onclick="setTab('done')">
                        <div class="stat-label">Selesai</div>
                        <div class="stat-num" id="sc-done">0</div>
                        <div class="stat-sub">berhasil diselesaikan</div>
                        <div class="stat-deco"></div>
                    </div>
                </div>

                <div class="main-grid">

                    <div class="panel">
                        <div class="panel-head">
                            <span class="panel-title" id="panel-title">Semua Pengingat</span>
                            <span class="panel-action" onclick="hapusSelesai()">Hapus selesai</span>
                        </div>

                        <div class="tab-bar">
                            <button class="tab-btn active" id="tab-all" onclick="setTab('all')">
                                Semua <span class="tab-count" id="tc-all">0</span>
                            </button>
                            <button class="tab-btn" id="tab-upcoming" onclick="setTab('upcoming')">
                                Akan Datang <span class="tab-count" id="tc-upcoming">0</span>
                            </button>
                            <button class="tab-btn" id="tab-done" onclick="setTab('done')">
                                Selesai <span class="tab-count" id="tc-done">0</span>
                            </button>
                            <button class="tab-btn" id="tab-overdue" onclick="setTab('overdue')">
                                Terlewat <span class="tab-count" id="tc-overdue">0</span>
                            </button>
                        </div>

                        <div class="progress-section">
                            <div class="prog-label">
                                <span>Progress penyelesaian</span>
                                <span id="prog-pct">0%</span>
                            </div>
                            <div class="prog-track">
                                <div class="prog-fill" id="prog-fill" style="width:0%"></div>
                            </div>
                        </div>

                        <div class="reminder-list" id="reminder-list">
                            <div class="empty-state"><p>Belum ada pengingat. Yuk, buat satu!</p></div>
                        </div>
                    </div>

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
                                        <span class="p-dot"></span>Low
                                    </button>
                                    <button class="p-btn p-medium" id="pb-medium" onclick="pilihPrioritas('medium')">
                                        <span class="p-dot"></span>Medium
                                    </button>
                                    <button class="p-btn p-high" id="pb-high" onclick="pilihPrioritas('high')">
                                        <span class="p-dot"></span>High
                                    </button>
                                </div>
                            </div>
                            <button class="submit-btn" onclick="tambahPengingat()">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="12" y1="5" x2="12" y2="19"/>
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                </svg>
                                Tambah Pengingat
                            </button>
                        </div>

                        <div class="overdue-card">
                            <div class="overdue-card-label">&#128680; Terlewat</div>
                            <div class="overdue-card-list" id="overdue-list">Tidak ada pengingat terlewat</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
    // Data disimpan per-user pakai user ID dari Laravel (aman per session)
    const STORAGE_KEY = 'ros_{{ Auth::id() }}';
    let reminders = JSON.parse(sessionStorage.getItem(STORAGE_KEY) || '[]');
    let currentTab = 'all';
    let currentPriority = null;
    let selectedPriority = 'low';

    function save() { sessionStorage.setItem(STORAGE_KEY, JSON.stringify(reminders)); }

    // Clock
    function updateClock() {
        const n = new Date(), p = x => String(x).padStart(2,'0');
        document.getElementById('clock-display').textContent =
            `${p(n.getHours())}:${p(n.getMinutes())} ${p(n.getDate())}-${p(n.getMonth()+1)}-${n.getFullYear()}`;
    }
    updateClock(); setInterval(updateClock, 1000);

    // Priority
    function pilihPrioritas(p) {
        selectedPriority = p;
        ['low','medium','high'].forEach(x => document.getElementById('pb-'+x).classList.toggle('sel', x===p));
    }

    // Tambah
    function tambahPengingat() {
        const title = document.getElementById('f-title').value.trim();
        if (!title) { showAlert('Judul wajib diisi!', ''); return; }
        const amount = parseInt(document.getElementById('f-amount').value)||30;
        const unit   = document.getElementById('f-unit').value;
        const ms     = {minute:60000, hour:3600000, day:86400000};
        const due    = new Date(Date.now() + amount * ms[unit]);
        reminders.unshift({ id:Date.now(), title, note:document.getElementById('f-note').value.trim()||null,
            due_date:due.toISOString(), priority:selectedPriority, status:'upcoming' });
        save();
        document.getElementById('f-title').value='';
        document.getElementById('f-note').value='';
        document.getElementById('f-amount').value=30;
        renderAll();
        showAlert('Pengingat ditambahkan!', `"${title}" berhasil disimpan.`);
        if (Notification.permission==='granted') setTimeout(()=>new Notification('ReminderOS',{body:title}), amount*ms[unit]);
        else if (Notification.permission!=='denied') Notification.requestPermission();
    }

    function updateStatus(id) {
        const r = reminders.find(x=>x.id===id); if(!r) return;
        r.status = r.status==='done' ? 'upcoming' : 'done'; save(); renderAll();
    }

    function hapusItem(id) { if(!confirm('Hapus pengingat ini?')) return; reminders=reminders.filter(x=>x.id!==id); save(); renderAll(); }
    function hapusSelesai() { if(!confirm('Hapus semua yang selesai?')) return; reminders=reminders.filter(r=>getStatus(r)!=='done'); save(); renderAll(); }

    function setTab(tab) {
        currentTab=tab; currentPriority=null;
        ['all','upcoming','done','overdue'].forEach(t=>document.getElementById('tab-'+t).classList.toggle('active',t===tab));
        const t={all:'Semua Pengingat',upcoming:'Akan Datang',done:'Selesai',overdue:'Terlewat'};
        document.getElementById('panel-title').textContent = t[tab]||'Semua Pengingat';
        // update active nav item
        document.querySelectorAll('.nav-item').forEach(el=>el.classList.remove('active'));
        renderList();
    }

    function filterByPriority(p) { currentPriority=p; currentTab='all'; renderList(); }
    function getStatus(r) { if(r.status==='done') return 'done'; return new Date(r.due_date)<new Date()?'overdue':'upcoming'; }

    function fmtDate(iso) {
        const d=new Date(iso), p=x=>String(x).padStart(2,'0');
        return `${p(d.getHours())}:${p(d.getMinutes())} ${p(d.getDate())}-${p(d.getMonth()+1)}-${d.getFullYear()}`;
    }

    function esc(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

    function renderList() {
        const q = document.getElementById('search-input').value.toLowerCase();
        const filtered = reminders.filter(r => {
            if (currentPriority && r.priority!==currentPriority) return false;
            if (q && !r.title.toLowerCase().includes(q)) return false;
            if (currentTab==='all') return true;
            return getStatus(r)===currentTab;
        });
        const el = document.getElementById('reminder-list');
        if (!filtered.length) { el.innerHTML='<div class="empty-state"><p>Tidak ada pengingat di sini.</p></div>'; return; }
        el.innerHTML = filtered.map(r => {
            const st=getStatus(r), done=st==='done', over=st==='overdue';
            const pc={high:'prio-high',medium:'prio-medium',low:'prio-low'}[r.priority]||'prio-low';
            return `<div class="reminder-item ${done?'item-done':''} ${over?'item-overdue':''}" data-id="${r.id}">
                <div class="item-left">
                    <div class="custom-checkbox ${done?'checked':''}" onclick="updateStatus(${r.id})">${done?'✓':''}</div>
                    <div class="item-info">
                        <h4 class="item-title">${esc(r.title)}</h4>
                        <p class="item-note">${esc(r.note||'Tidak ada catatan')}</p>
                        <div class="item-meta">
                            <span class="meta-time">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                </svg>
                                ${fmtDate(r.due_date)}
                            </span>
                            <span class="badge ${pc}">${r.priority.toUpperCase()}</span>
                            ${over?'<span class="badge prio-high">TERLEWAT</span>':''}
                        </div>
                    </div>
                </div>
                <div class="item-actions">
                    <button class="btn-delete" onclick="hapusItem(${r.id})">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                        </svg>
                    </button>
                </div>
            </div>`;
        }).join('');
    }

    function renderStats() {
        const total=reminders.length, done=reminders.filter(r=>getStatus(r)==='done').length,
              upcoming=reminders.filter(r=>getStatus(r)==='upcoming').length,
              overdue=reminders.filter(r=>getStatus(r)==='overdue').length,
              pct=total?Math.round(done/total*100):0;
        document.getElementById('sc-total').textContent=total;
        document.getElementById('sc-upcoming').textContent=upcoming;
        document.getElementById('sc-done').textContent=done;
        document.getElementById('tc-all').textContent=total;
        document.getElementById('tc-upcoming').textContent=upcoming;
        document.getElementById('tc-done').textContent=done;
        document.getElementById('tc-overdue').textContent=overdue;
        document.getElementById('prog-pct').textContent=pct+'%';
        document.getElementById('prog-fill').style.width=pct+'%';
        document.getElementById('overdue-text').textContent=overdue+' pengingat terlewat.';
        const nb=document.getElementById('nb-overdue');
        nb.textContent=overdue; nb.style.display=overdue?'inline-flex':'none';
        document.getElementById('notif-dot').style.display=overdue?'block':'none';
        const ov=reminders.filter(r=>getStatus(r)==='overdue');
        document.getElementById('overdue-list').innerHTML=ov.length
            ? ov.map(r=>`<div class="overdue-item">• ${esc(r.title)}</div>`).join('')
            : 'Tidak ada pengingat terlewat';
    }

    function renderAll() { renderStats(); renderList(); }

    function showAlert(title, sub) {
        document.getElementById('alert-title').textContent=title;
        document.getElementById('alert-sub').textContent=sub;
        document.getElementById('alert-bar-js').style.display='flex';
        setTimeout(tutupAlert, 4000);
    }
    function tutupAlert() { document.getElementById('alert-bar-js').style.display='none'; }

    renderAll();
    setInterval(renderAll, 30000);
    </script>
</body>
</html>