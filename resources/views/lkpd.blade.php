<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LKPD Digital - Algoritma Sorting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg-color: #f0f4f8;
            --card-bg: #ffffff;
            --primary: #1e293b;
            --accent: #3b82f6;
            --success: #10b981;
            --error: #ef4444;
            --warning: #f59e0b;
            --text-main: #334155;
            --text-muted: #64748b;
        }

        * { box-sizing: border-box; transition: all 0.3s ease; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 20px 15px;
            line-height: 1.6;
        }

        .container { max-width: 1000px; margin: auto; }

        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 35px 20px;
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        header h1 { font-family: 'Poppins'; font-size: 26px; margin: 0; letter-spacing: -1px; }

        /* Dashboard Stats */
        .stats-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-bottom: 25px; }

        .stat-card { background: white; padding: 20px; border-radius: 16px; border: 1px solid #e2e8f0; text-align: center; display: flex; flex-direction: column; justify-content: center; }
        .stat-card h3 { font-size: 11px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px; font-weight: 700; }
        .stat-value { font-size: 36px; font-weight: 700; color: var(--accent); font-family: 'Poppins'; }
        
        .leaderboard-card { background: white; padding: 20px; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; }
        .leaderboard-table-wrapper { overflow-x: auto; }
        .leaderboard-table { width: 100%; border-collapse: collapse; font-size: 12px; min-width: 400px; }
        .leaderboard-table th { text-align: left; padding: 10px; color: var(--text-muted); border-bottom: 2px solid #f1f5f9; text-transform: uppercase; }
        .leaderboard-table td { padding: 10px; border-bottom: 1px solid #f1f5f9; }
        .rank-badge { background: var(--warning); color: white; padding: 2px 8px; border-radius: 6px; font-weight: 700; font-size: 11px; }

        .info-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 16px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }

        .input-group label { display: block; font-size: 10px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 6px; }
        .input-group input { width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; outline: none; }

        /* Missions */
        .mission-card { background: var(--card-bg); border-radius: 20px; padding: 25px 20px; margin-bottom: 25px; border: 1px solid #e2e8f0; }
        .mission-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .mission-icon { width: 40px; height: 40px; background: #eff6ff; color: var(--accent); display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 18px; }
        .mission-card h2 { font-family: 'Poppins'; margin: 0; font-size: 18px; color: var(--primary); }
        .scenario-box { background: #f8fafc; padding: 15px; border-radius: 12px; border-left: 4px solid var(--accent); margin-bottom: 20px; font-size: 13px; }

        .table-wrapper { overflow-x: auto; margin: 20px 0; border-radius: 8px; border: 1px solid #f1f5f9; }
        table { width: 100%; border-collapse: separate; border-spacing: 0; min-width: 500px; }
        th { background: #f1f5f9; padding: 12px; text-align: left; font-size: 11px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; }
        td { padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px; }

        .input-small { width: 55px; padding: 8px; border: 2px solid var(--accent); border-radius: 6px; text-align: center; font-weight: bold; background: #f0f7ff; outline: none; }

        .btn-verify { background: var(--primary); color: white; border: none; padding: 12px; border-radius: 10px; cursor: pointer; font-weight: 600; font-size: 13px; width: 100%; }

        /* REVISI: Refleksi Diri Responsif */
        .reflection-card { background: white; padding: 30px 20px; border-radius: 20px; text-align: center; border: 1px solid #e2e8f0; }
        .emoji-container { 
            display: flex; 
            justify-content: center; 
            flex-wrap: wrap; /* Memungkinkan emoji turun jika layar terlalu sempit */
            gap: 15px; 
            margin: 25px 0; 
        }
        .emoji-item { 
            cursor: pointer; 
            filter: grayscale(1); 
            opacity: 0.4; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            min-width: 80px; /* Menjaga lebar tetap konsisten */
        }
        .emoji-item span:first-child { font-size: 40px; }
        .emoji-item .emoji-label { font-size: 11px; font-weight: 700; margin-top: 8px; text-transform: uppercase; color: var(--text-muted); }
        .emoji-item.active { filter: grayscale(0); opacity: 1; transform: scale(1.1); }
        .emoji-item.active .emoji-label { color: var(--accent); }

        textarea { width: 100%; height: 110px; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px; outline: none; resize: none; margin-top: 15px; font-family: inherit; font-size: 14px; }

        .btn-submit { background: var(--success); color: white; border: none; width: 100%; padding: 20px; border-radius: 15px; font-size: 17px; font-weight: 700; cursor: pointer; margin-top: 30px; display: flex; align-items: center; justify-content: center; gap: 10px; }

        /* Media Queries */
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            header h1 { font-size: 22px; }
            .stat-value { font-size: 32px; }
            .emoji-item { min-width: 70px; }
            .emoji-item span:first-child { font-size: 34px; }
        }

        footer { text-align: center; margin-top: 30px; color: var(--text-muted); font-size: 11px; }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>🔍 LKPD Digital: Detektif Algoritma</h1>
        <p style="font-size: 13px; margin-top: 8px; opacity: 0.9;">Fase E - Informatika | SMAN 1 Bandung</p>
    </header>

    <div class="stats-grid">
        <div class="stat-card">
            <h3>Akurasi Kelas</h3>
            <div class="stat-value" id="avg-class">0%</div>
        </div>
        <div class="leaderboard-card">
            <div class="leaderboard-table-wrapper">
                <table class="leaderboard-table">
                    <thead><tr><th>Rank</th><th>Nama</th><th>Misi</th><th>Akurasi</th></tr></thead>
                    <tbody id="leaderboard-body">
                        <tr><td colspan="4" style="text-align:center; padding:15px;">Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="info-card">
        <div class="input-group">
            <label>Nama Peserta Didik / Nama Kelompok</label>
            <input type="text" id="student-name" placeholder="Ketik nama lengkap...">
        </div>
        <div class="input-group">
            <label>NISN / NIM</label>
            <input type="text" id="student-class" placeholder="Contoh: X-1 / 01">
        </div>
        <div class="input-group">
            <label>Instansi</label>
            <input type="text" value="SMAN 1 BANDUNG" readonly>
        </div>
    </div>

    <div class="mission-card">
        <div class="mission-header">
            <div class="mission-icon"><i class="fa-solid fa-soap"></i></div>
            <h2>Misi 1: Strategi Bubble Sort</h2>
        </div>
        <div class="scenario-box">
            Bandingkan angka bersebelahan. Jika kiri > kanan, <b>Tukar</b> posisi. Data: <b>[85, 70, 92, 65]</b>.
        </div>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>Tahap</th><th>Proses</th><th>Tindakan</th><th>Hasil Susunan Baru</th></tr></thead>
                <tbody>
                    <tr><td>1</td><td>85 vs 70</td><td>TUKAR</td><td>[ 70, 85, 92, 65 ]</td></tr>
                    <tr><td>2</td><td>85 vs 92</td><td>TETAP</td><td>[ 70, 85, 92, 65 ]</td></tr>
                    <tr><td>3</td><td>92 vs 65</td><td>TUKAR</td><td>[ 70, 85, <input type="text" id="b1" class="input-small">, <input type="text" id="b2" class="input-small"> ]</td></tr>
                </tbody>
            </table>
        </div>
        <button class="btn-verify" onclick="checkBubble()"><i class="fa-solid fa-check"></i> Verifikasi Misi 1</button>
        <div id="alert-bubble" class="alert"></div>
    </div>

    <div class="mission-card">
        <div class="mission-header">
            <div class="mission-icon"><i class="fa-solid fa-hand-pointer"></i></div>
            <h2>Misi 2: Strategi Selection Sort</h2>
        </div>
        <div class="scenario-box">
            Cari nilai <b>paling kecil</b>, lalu tukar ke posisi terdepan. Data: <b>[50, 30, 80, 20]</b>.
        </div>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>Putaran</th><th>Terkecil</th><th>Metode</th><th>Hasil Susunan Baru</th></tr></thead>
                <tbody>
                    <tr><td>1</td><td>20</td><td>Tukar ke Pos 1</td><td>[ 20, 30, 80, 50 ]</td></tr>
                    <tr><td>2</td><td>30</td><td>Tetap</td><td>[ 20, 30, 80, 50 ]</td></tr>
                    <tr><td>3</td><td><input type="text" id="s1" class="input-small"></td><td>Tukar ke Pos 3</td><td>[ 20, 30, <input type="text" id="s2" class="input-small">, <input type="text" id="s3" class="input-small"> ]</td></tr>
                </tbody>
            </table>
        </div>
        <button class="btn-verify" onclick="checkSelection()"><i class="fa-solid fa-check"></i> Verifikasi Misi 2</button>
        <div id="alert-selection" class="alert"></div>
    </div>

    <div class="mission-card">
        <div class="mission-header">
            <div class="mission-icon"><i class="fa-solid fa-clone"></i></div>
            <h2>Misi 3: Strategi Insertion Sort</h2>
        </div>
        <div class="scenario-box">
            Ambil data, sisipkan ke posisi tepat di sebelah kirinya. Data: <b>[7, 4, 9, 2]</b>.
        </div>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>Ambil Data</th><th>Proses</th><th>Hasil Susunan Baru</th></tr></thead>
                <tbody>
                    <tr><td>4</td><td>Sisip Depan</td><td>[ 4, 7, 9, 2 ]</td></tr>
                    <tr><td>9</td><td>Tetap</td><td>[ 4, 7, 9, 2 ]</td></tr>
                    <tr><td>2</td><td>Sisip ke Awal</td><td>[ <input type="text" id="i1" class="input-small">, <input type="text" id="i2" class="input-small">, <input type="text" id="i3" class="input-small">, <input type="text" id="i4" class="input-small"> ]</td></tr>
                </tbody>
            </table>
        </div>
        <button class="btn-verify" onclick="checkInsertion()"><i class="fa-solid fa-check"></i> Verifikasi Misi 3</button>
        <div id="alert-insertion" class="alert"></div>
    </div>

    <div class="reflection-card">
        <h2 style="font-family: 'Poppins'; font-size: 20px; color: var(--primary);">Refleksi Diri</h2>
        <div class="emoji-container">
            <div class="emoji-item" onclick="setEmoji(this, 'Bingung')">
                <span>😕</span>
                <span class="emoji-label">Bingung</span>
            </div>
            <div class="emoji-item" onclick="setEmoji(this, 'Biasa')">
                <span>😐</span>
                <span class="emoji-label">Biasa</span>
            </div>
            <div class="emoji-item" onclick="setEmoji(this, 'Paham')">
                <span>😄</span>
                <span class="emoji-label">Paham</span>
            </div>
        </div>
        <textarea id="reflection-text" placeholder="Ceritakan pengalaman belajarmu hari ini..."></textarea>
    </div>

    <button class="btn-submit" onclick="submitFinal()">
        <i class="fa-solid fa-paper-plane"></i> KIRIM LAPORAN KE GURU
    </button>
    <footer>© 2026 Ridwan Maulana, S.Kom. | SMAN 1 Bandung</footer>
</div>

<script>
    let selectedEmoji = "";
    window.onload = loadStats;

    async function loadStats() {
        try {
            const response = await fetch("{{ route('sorting.stats') }}");
            const data = await response.json();
            document.getElementById('avg-class').innerText = data.rata_rata_kelas + "%";
            const body = document.getElementById('leaderboard-body');
            body.innerHTML = data.leaderboard.map((s, i) => `
                <tr>
                    <td><span class="rank-badge">#${i+1}</span></td>
                    <td><b>${s.nama}</b></td>
                    <td>${s.total_benar}/3</td>
                    <td>${s.akurasi}%</td>
                </tr>
            `).join('');
        } catch (e) { console.error("Gagal memuat statistik"); }
    }

    function setEmoji(el, label) { 
        document.querySelectorAll('.emoji-item').forEach(e => e.classList.remove('active')); 
        el.classList.add('active'); 
        selectedEmoji = label; 
    }

    function checkBubble() {
        const alert = document.getElementById('alert-bubble');
        alert.style.display = 'flex';
        if(document.getElementById('b1').value == "65" && document.getElementById('b2').value == "92") {
            alert.className = "alert alert-success"; alert.innerHTML = "<i class='fa-solid fa-circle-check'></i> Berhasil!";
        } else {
            alert.className = "alert alert-error"; alert.innerHTML = "<i class='fa-solid fa-circle-xmark'></i> Salah!";
        }
    }

    function checkSelection() {
        const alert = document.getElementById('alert-selection');
        alert.style.display = 'flex';
        if(document.getElementById('s1').value == "50" && document.getElementById('s2').value == "50") {
            alert.className = "alert alert-success"; alert.innerHTML = "<i class='fa-solid fa-circle-check'></i> Berhasil!";
        } else {
            alert.className = "alert alert-error"; alert.innerHTML = "<i class='fa-solid fa-circle-xmark'></i> Salah!";
        }
    }

    function checkInsertion() {
        const alert = document.getElementById('alert-insertion');
        alert.style.display = 'flex';
        if(document.getElementById('i1').value == "2" && document.getElementById('i4').value == "9") {
            alert.className = "alert alert-success"; alert.innerHTML = "<i class='fa-solid fa-circle-check'></i> Berhasil!";
        } else {
            alert.className = "alert alert-error"; alert.innerHTML = "<i class='fa-solid fa-circle-xmark'></i> Salah!";
        }
    }

    async function submitFinal() {
        const payload = {
            nama: document.getElementById('student-name').value,
            kelas: document.getElementById('student-class').value,
            skor: {
                bubble: document.getElementById('b1').value == "65",
                selection: document.getElementById('s1').value == "50",
                insertion: document.getElementById('i1').value == "2"
            },
            refleksi: { emoji: selectedEmoji, teks: document.getElementById('reflection-text').value }
        };

        if(!payload.nama || !payload.kelas) { alert("Lengkapi identitas!"); return; }

        try {
            const response = await fetch("{{ route('sorting.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(payload)
            });
            const result = await response.json();
            alert(result.message);
            loadStats();
        } catch (error) { alert("Gagal terhubung ke server!"); }
    }
</script>
</body>
</html>