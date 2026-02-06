<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Lomba Pelajar</title>
    <!-- Bootstrap Grid -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap-grid.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #030303;
            --text-color: #ffffff;
            --primary: #00f2fe;
            --card-bg: #0a0a0a;
            --input-bg: #111;
            --border-color: #333;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: default; 
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        /* CARD DESIGN */
        .main-container {
            position: relative;
            width: 90%;
            max-width: 850px;
            background: var(--card-bg);
            border-radius: 24px;
            padding: 3px;
            z-index: 10;
            box-shadow: 0 50px 100px -20px rgba(0,0,0,0.8);
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .main-container::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 24px;
            padding: 2px;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0), rgba(0, 242, 254, 0.4));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .card-content {
            background: var(--card-bg);
            border-radius: 22px;
            padding: 50px;
            height: 100%;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .card-content::after {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 30%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
            opacity: 0.5;
        }

        h2 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-top: 0;
            margin-bottom: 15px;
            color: #fff;
            letter-spacing: -0.5px;
        }

        h2 span { color: var(--primary); }

        p.subtitle { color: #888; font-size: 1rem; line-height: 1.6; max-width: 600px; margin: 0 auto 40px auto; }

        .custom-input-group { position: relative; margin-bottom: 25px; }

        .form-label {
            position: absolute;
            top: -10px;
            left: 15px;
            background: var(--card-bg);
            padding: 0 5px;
            font-size: 0.8rem;
            color: #666;
            z-index: 5;
            transition: 0.3s;
        }
        
        .custom-input-group:focus-within .form-label { color: var(--primary); }

        .custom-input {
            width: 100%;
            background: var(--input-bg);
            border: 1px solid #222;
            border-radius: 12px;
            padding: 18px 20px 18px 50px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Outfit', sans-serif;
            appearance: none; 
        }

        .input-icon {
            position: absolute;
            left: 20px; top: 50%; transform: translateY(-50%);
            color: #444; transition: 0.3s; pointer-events: none; z-index: 4;
        }

        .custom-input:focus {
            outline: none; background: #161616; border-color: var(--primary);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .custom-input:focus + .input-icon { color: var(--primary); }

        .select-wrapper::after {
            content: '\f107'; font-family: 'Font Awesome 6 Free'; font-weight: 900;
            position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: #666; pointer-events: none;
        }
        select.custom-input option { background-color: #111; padding: 10px; }

        .btn-submit {
            width: 100%; padding: 20px; background: #fff; color: #000; border: none; border-radius: 14px;
            font-weight: 700; font-size: 1.1rem; cursor: pointer; transition: all 0.3s; margin-top: 20px;
            text-transform: uppercase; letter-spacing: 1px;
        }
        .btn-submit:hover {
            transform: translateY(-3px); box-shadow: 0 0 30px rgba(255,255,255,0.2); background: var(--primary);
        }

        /* --- CUSTOM DATE PICKER STYLES --- */
        .date-picker-overlay {
            display: none; position: absolute; top: 100%; left: 0; width: 100%; z-index: 100; margin-top: 5px;
        }
        .date-picker-modal {
            background: #fff; /* Light theme matching screenshot */
            color: #333;
            border-radius: 8px;
            padding: 15px;
            width: 300px; /* Fixed width for standard look */
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
            font-family: 'Outfit', sans-serif;
            user-select: none;
        }
        /* Mobile adjustment */
        @media (max-width: 768px) {
            .date-picker-modal { width: 100%; }
        }

        .dp-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;
        }
        .dp-nav { cursor: pointer; padding: 5px 10px; color: #666; font-weight: bold; }
        .dp-nav:hover { color: #000; }
        .dp-dropdowns { display: flex; gap: 10px; }
        .dp-select {
            padding: 5px; border: 1px solid #ddd; border-radius: 4px; background: #fff; color: #333;
            font-family: inherit; font-size: 0.9rem; cursor: pointer;
        }

        .dp-weekdays {
            display: grid; grid-template-columns: repeat(7, 1fr); text-align: center;
            font-weight: 600; font-size: 0.8rem; color: #888; margin-bottom: 10px;
        }
        .dp-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; }
        .dp-day {
            text-align: center; padding: 10px; font-size: 0.9rem; border-radius: 4px; cursor: pointer;
        }
        .dp-day:hover { background: #f0f0f0; }
        .dp-day.active { background: #007bff; color: white; font-weight: bold; } /* Blue highlight */
        .dp-day.empty { cursor: default; }
        .dp-day.empty:hover { background: none; }

        .dp-footer {
            display: flex; justify-content: space-between; margin-top: 15px; padding-top: 10px;
            border-top: 1px solid #eee;
        }
        .dp-btn-small {
            background: none; border: 1px solid #ddd; border-radius: 4px; padding: 5px 15px; 
            font-size: 0.8rem; cursor: pointer; color: #555;
        }
        .dp-btn-small:hover { border-color: #aaa; color: #000; }
    </style>
</head>
<body>

    <canvas id="canvas"></canvas>

    <div class="main-container">
        <div class="card-content">
            <div class="text-center">
                <h2>DIGITAL <span>TALENT</span> 2026</h2>
                <p class="subtitle">Ajang pembuktian kreativitas siswa SD, SMP, SMA/SMK se-Indonesia.</p>
            </div>

            <form action="pendaftaran.php" method="POST" autocomplete="off">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="custom-input-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="custom-input" name="nama" placeholder="Tulis nama lengkapmu" required>
                            <i class="far fa-user input-icon"></i>
                        </div>
                        <div class="custom-input-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="custom-input" name="email" placeholder="contoh@email.com" required>
                            <i class="far fa-envelope input-icon"></i>
                        </div>
                        
                        <!-- CUSTOM DATE PICKER INPUT -->
                        <div class="custom-input-group" style="position: relative;">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="text" class="custom-input" id="dateInput" name="tgl_lahir" placeholder="YYYY-MM-DD" required readonly style="cursor: pointer;">
                            <i class="far fa-calendar-alt input-icon"></i>

                            <!-- The Modal Structure -->
                            <div class="date-picker-overlay" id="datePicker">
                                <div class="date-picker-modal">
                                    <div class="dp-header">
                                        <div class="dp-nav" id="prevMonth">&lt;</div>
                                        <div class="dp-dropdowns">
                                            <select class="dp-select" id="monthSelect"></select>
                                            <select class="dp-select" id="yearSelect"></select>
                                        </div>
                                        <div class="dp-nav" id="nextMonth">&gt;</div>
                                    </div>
                                    <div class="dp-weekdays">
                                        <div>SUN</div><div>MON</div><div>TUE</div><div>WED</div><div>THU</div><div>FRI</div><div>SAT</div>
                                    </div>
                                    <div class="dp-grid" id="daysGrid"></div>
                                    <div class="dp-footer">
                                        <button type="button" class="dp-btn-small" id="clearDate">Clear</button>
                                        <button type="button" class="dp-btn-small" id="todayDate">Today</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="custom-input-group select-wrapper">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="custom-input" name="gender" required>
                                <option value="" disabled selected hidden></option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <i class="fas fa-venus-mars input-icon"></i>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="custom-input-group select-wrapper">
                            <label class="form-label">Kategori Lomba</label>
                            <select class="custom-input" name="lomba" required>
                                <option value="" disabled selected hidden>Pilih Minatmu</option>
                                <option value="Web Design">Web Design</option>
                                <option value="Programming">Programmer</option>
                                <option value="Graphic Design">Graphic Design</option>
                            </select>
                            <i class="fas fa-trophy input-icon"></i>
                        </div>
                        <div class="custom-input-group">
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" class="custom-input" name="sekolah" placeholder="Contoh: SMKN 6 Tangsel" required>
                            <i class="fas fa-school input-icon"></i>
                        </div>
                        <div class="custom-input-group">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" class="custom-input" name="whatsapp" placeholder="08xxxxxxxxxx" required>
                            <i class="fab fa-whatsapp input-icon"></i>
                        </div>
                        <div class="custom-input-group">
                            <label class="form-label">Alamat Lengkap</label>
                            <input type="text" class="custom-input" name="alamat" placeholder="Kota, Domisili" required>
                            <i class="fas fa-map-marker-alt input-icon"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit" name="daftar">
                    DAFTAR SEKARANG
                </button>
            </form>
        </div>
    </div>

    <!-- Background Script (Maintained) -->
    <script>
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        let width, height; const mouse = { x: window.innerWidth/2, y: window.innerHeight/2 }; const cursor = { x: window.innerWidth/2, y: window.innerHeight/2 }; 
        function resize() { width = canvas.width = window.innerWidth; height = canvas.height = window.innerHeight; }
        window.addEventListener('resize', resize); resize();
        window.addEventListener('mousemove', e => { mouse.x = e.clientX; mouse.y = e.clientY; });
        class WaveShape {
            constructor(r, c, s, o) { this.r=r; this.c=c; this.s=s; this.o=o; this.p=[]; for(let i=0;i<60;i++) this.p.push({a:(Math.PI*2*i)/60}); }
            draw(cx, cy, t) {
                ctx.beginPath(); ctx.strokeStyle=this.c; ctx.lineWidth=2;
                for (let i=0; i<=60; i++) {
                    const idx=i%60; const w=Math.sin(this.p[idx].a*3+t*this.s+this.o)*10 + Math.cos(this.p[idx].a*5-t*(this.s*0.5))*10;
                    const rd=this.r+w; ctx[i===0?'moveTo':'lineTo'](cx+Math.cos(this.p[idx].a)*rd, cy+Math.sin(this.p[idx].a)*rd);
                } ctx.stroke();
            }
        }
        class Particle {
            constructor() { this.reset(); }
            reset() { const a=Math.random()*6.28; const d=30+Math.random()*80; this.x=cursor.x+Math.cos(a)*d; this.y=cursor.y+Math.sin(a)*d; this.s=Math.random()*2; this.l=0; this.ml=50+Math.random()*50; }
            update() { this.l++; this.a = this.l<20 ? this.l/20 : (this.l>this.ml-20 ? (this.ml-this.l)/20 : 1); if(this.l>=this.ml) this.reset(); this.x+=(cursor.x-this.x)*0.02; this.y+=(cursor.y-this.y)*0.02; }
            draw() { ctx.globalAlpha=this.a; ctx.fillStyle='#fff'; ctx.beginPath(); ctx.arc(this.x, this.y, this.s, 0, 6.28); ctx.fill(); ctx.globalAlpha=1; }
        }
        const waves = [new WaveShape(40,'rgba(0,242,254,0.3)',2,0), new WaveShape(60,'rgba(0,242,254,0.5)',1.5,1), new WaveShape(80,'rgba(0,242,254,0.2)',1,2)];
        const parts = Array(30).fill().map(() => new Particle()); let time=0;
        function animate() {
            cursor.x+=(mouse.x-cursor.x)*0.1; cursor.y+=(mouse.y-cursor.y)*0.1; ctx.clearRect(0,0,width,height); time+=0.05;
            parts.forEach(p=>{p.update();p.draw();}); waves.forEach(w=>w.draw(cursor.x, cursor.y, time)); requestAnimationFrame(animate);
        } animate();
    </script>

    <!-- CUSTOM DATE PICKER LOGIC -->
    <script>
        const input = document.getElementById('dateInput');
        const picker = document.getElementById('datePicker');
        const monthSelect = document.getElementById('monthSelect');
        const yearSelect = document.getElementById('yearSelect');
        const daysGrid = document.getElementById('daysGrid');
        
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        let currentDate = new Date();
        let selectedDate = null;

        // Populate Dropdowns
        months.forEach((m, i) => {
            const opt = document.createElement('option'); opt.value = i; opt.innerText = m; monthSelect.appendChild(opt);
        });
        const currentYear = new Date().getFullYear();
        for (let y = currentYear; y >= 1950; y--) {
            const opt = document.createElement('option'); opt.value = y; opt.innerText = y; yearSelect.appendChild(opt);
        }

        function renderCalendar() {
            const y = currentDate.getFullYear();
            const m = currentDate.getMonth();
            
            monthSelect.value = m;
            yearSelect.value = y;

            const firstDay = new Date(y, m, 1).getDay();
            const daysInMonth = new Date(y, m + 1, 0).getDate();
            
            daysGrid.innerHTML = '';

            // Empty slots
            for (let i = 0; i < firstDay; i++) {
                const div = document.createElement('div'); div.className = 'dp-day empty'; daysGrid.appendChild(div);
            }

            // Days
            for (let d = 1; d <= daysInMonth; d++) {
                const div = document.createElement('div');
                div.className = 'dp-day';
                div.innerText = d;
                
                // Highlight Selected
                if (selectedDate && 
                    selectedDate.getDate() === d && 
                    selectedDate.getMonth() === m && 
                    selectedDate.getFullYear() === y) {
                    div.classList.add('active');
                }

                div.onclick = () => {
                    selectedDate = new Date(y, m, d);
                    // Fix: Use local date components to avoid timezone shift (off-by-one bug)
                    const year = selectedDate.getFullYear();
                    const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
                    const day = String(selectedDate.getDate()).padStart(2, '0');
                    input.value = `${year}-${month}-${day}`;
                    renderCalendar(); // Refresh to show highlight
                    setTimeout(() => picker.style.display = 'none', 150); // Close after click
                };
                daysGrid.appendChild(div);
            }
        }

        // Event Listeners
        input.addEventListener('click', (e) => {
            e.stopPropagation();
            picker.style.display = 'block';
        });

        // Close on clicking outside
        document.addEventListener('click', (e) => {
            if (!input.contains(e.target) && !picker.contains(e.target)) {
                picker.style.display = 'none';
            }
        });

        monthSelect.onchange = () => { currentDate.setMonth(monthSelect.value); renderCalendar(); };
        yearSelect.onchange = () => { currentDate.setFullYear(yearSelect.value); renderCalendar(); };
        document.getElementById('prevMonth').onclick = () => { currentDate.setMonth(currentDate.getMonth() - 1); renderCalendar(); };
        document.getElementById('nextMonth').onclick = () => { currentDate.setMonth(currentDate.getMonth() + 1); renderCalendar(); };
        
        document.getElementById('todayDate').onclick = () => {
            currentDate = new Date();
            selectedDate = new Date();
            // Fix: Use local formatting
            const year = selectedDate.getFullYear();
            const month = String(selectedDate.getMonth() + 1).padStart(2, '0');
            const day = String(selectedDate.getDate()).padStart(2, '0');
            input.value = `${year}-${month}-${day}`;
            renderCalendar();
            picker.style.display = 'none';
        };

        document.getElementById('clearDate').onclick = () => {
            selectedDate = null;
            input.value = '';
            renderCalendar();
        };

        // Init
        renderCalendar();
    </script>
</body>
</html>
