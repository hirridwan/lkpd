<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualisasi Sorting Algoritma</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .description {
            color: #7f8c8d;
            margin-bottom: 20px;
            text-align: center;
            max-width: 600px;
        }

        .controls {
            background-color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #3498db;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #2980b9;
        }

        button:disabled {
            background-color: #bdc3c7;
            cursor: not-allowed;
        }

        .btn-generate {
            background-color: #e67e22;
        }

        .btn-generate:hover {
            background-color: #d35400;
        }

        #container {
            display: flex;
            align-items: flex-end;
            justify-content: center;
            height: 300px;
            width: 100%;
            max-width: 800px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            gap: 5px;
        }

        .bar {
            width: 40px;
            background-color: #3498db;
            color: white;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 10px;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
            transition: height 0.2s ease, background-color 0.2s ease;
        }

        .legend {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            background-color: white;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
        }

        .box {
            width: 15px;
            height: 15px;
            border-radius: 3px;
        }

        #info-panel {
            margin-top: 20px;
            background-color: #e8f4f8;
            padding: 15px;
            border-left: 5px solid #3498db;
            border-radius: 0 5px 5px 0;
            max-width: 800px;
            display: none;
        }
        
        .slider-container {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            justify-content: center;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

    <h1>Visualisasi Sorting</h1>
    <p class="description">Mari amati bagaimana komputer membandingkan dan memindahkan data!</p>

    <div class="controls">
        <button class="btn-generate" onclick="generateArray()" id="btn-gen">Acak Data Baru</button>
        <button onclick="startSort('bubble')" class="btn-sort">Bubble Sort</button>
        <button onclick="startSort('selection')" class="btn-sort">Selection Sort</button>
        <button onclick="startSort('insertion')" class="btn-sort">Insertion Sort</button>
        
        <div class="slider-container">
            <label for="speed-slider" style="font-weight: bold; font-size: 14px; color: #2c3e50;">Kecepatan:</label>
            <span style="font-size: 12px; color: #7f8c8d;">Lambat</span>
            <input type="range" id="speed-slider" min="10" max="1000" value="400" style="direction: rtl; cursor: pointer;">
            <span style="font-size: 12px; color: #7f8c8d;">Cepat</span>
        </div>
    </div>

    <div id="container"></div>

    <div class="legend">
        <div class="legend-item"><div class="box" style="background-color: #3498db;"></div> Belum Terurut</div>
        <div class="legend-item"><div class="box" style="background-color: #e74c3c;"></div> Sedang Dibandingkan</div>
        <div class="legend-item"><div class="box" style="background-color: #f1c40f;"></div> Target / Terkecil</div>
        <div class="legend-item"><div class="box" style="background-color: #2ecc71;"></div> Sudah Terurut</div>
    </div>

    <div id="info-panel">
        <h3 id="info-title" style="margin-top:0;"></h3>
        <p id="info-text" style="margin-bottom:0; line-height: 1.5;"></p>
    </div>

<script>
    const container = document.getElementById('container');
    const infoPanel = document.getElementById('info-panel');
    const infoTitle = document.getElementById('info-title');
    const infoText = document.getElementById('info-text');
    
    const speedSlider = document.getElementById('speed-slider');
    let delay = speedSlider.value; 

    speedSlider.addEventListener('input', function() {
        delay = this.value;
    });

    function generateArray(size = 12) {
        container.innerHTML = '';
        infoPanel.style.display = 'none';
        enableButtons();
        
        for (let i = 0; i < size; i++) {
            const value = Math.floor(Math.random() * 80) + 15; 
            const bar = document.createElement('div');
            bar.classList.add('bar');
            bar.style.height = `${value * 2.5}px`;
            bar.innerHTML = value;
            container.appendChild(bar);
        }
    }

    const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));

    function disableButtons() {
        document.getElementById('btn-gen').disabled = true;
        document.querySelectorAll('.btn-sort').forEach(btn => btn.disabled = true);
        speedSlider.disabled = true;
    }

    function enableButtons() {
        document.getElementById('btn-gen').disabled = false;
        document.querySelectorAll('.btn-sort').forEach(btn => btn.disabled = false);
        speedSlider.disabled = false;
    }

    function showInfo(algo) {
        infoPanel.style.display = 'block';
        if(algo === 'bubble') {
            infoTitle.innerText = 'Mekanisme Bubble Sort';
            infoText.innerText = 'Mengecek dua data bersebelahan dari kiri ke kanan. Jika data di kiri lebih besar dari kanan, mereka ditukar (warna merah). Angka terbesar akan perlahan "mengapung" ke sisi paling kanan (warna hijau).';
        } else if(algo === 'selection') {
            infoTitle.innerText = 'Mekanisme Selection Sort';
            infoText.innerText = 'Mencari angka paling kecil di antara data yang belum terurut (ditandai warna kuning). Setelah ketemu, angka kecil tersebut ditukar ke posisi paling depan dari kelompok yang belum terurut.';
        } else if(algo === 'insertion') {
            infoTitle.innerText = 'Mekanisme Insertion Sort';
            infoText.innerText = 'Mengambil satu angka, lalu menyisipkannya ke posisi yang tepat di sebelah kirinya yang sudah dianggap terurut. Mirip seperti cara kita mengurutkan kartu remi di tangan.';
        }
    }

    async function bubbleSort() {
        let bars = document.querySelectorAll('.bar');
        for (let i = 0; i < bars.length - 1; i++) {
            for (let j = 0; j < bars.length - i - 1; j++) {
                bars[j].style.backgroundColor = '#e74c3c'; 
                bars[j+1].style.backgroundColor = '#e74c3c';
                await sleep(delay);

                let val1 = parseInt(bars[j].innerHTML);
                let val2 = parseInt(bars[j+1].innerHTML);

                if (val1 > val2) {
                    let tempHeight = bars[j].style.height;
                    bars[j].style.height = bars[j+1].style.height;
                    bars[j+1].style.height = tempHeight;
                    
                    bars[j].innerHTML = val2;
                    bars[j+1].innerHTML = val1;
                }
                bars[j].style.backgroundColor = '#3498db'; 
                bars[j+1].style.backgroundColor = '#3498db';
            }
            bars[bars.length - 1 - i].style.backgroundColor = '#2ecc71'; 
        }
        bars[0].style.backgroundColor = '#2ecc71';
    }

    async function selectionSort() {
        let bars = document.querySelectorAll('.bar');
        for (let i = 0; i < bars.length; i++) {
            let min_idx = i;
            bars[min_idx].style.backgroundColor = '#f1c40f'; 
            
            for (let j = i + 1; j < bars.length; j++) {
                bars[j].style.backgroundColor = '#e74c3c'; 
                await sleep(delay);

                let valMin = parseInt(bars[min_idx].innerHTML);
                let valCur = parseInt(bars[j].innerHTML);

                if (valCur < valMin) {
                    if (min_idx !== i) bars[min_idx].style.backgroundColor = '#3498db'; 
                    min_idx = j;
                    bars[min_idx].style.backgroundColor = '#f1c40f'; 
                } else {
                    bars[j].style.backgroundColor = '#3498db';
                }
            }

            let tempHeight = bars[min_idx].style.height;
            let tempVal = bars[min_idx].innerHTML;
            bars[min_idx].style.height = bars[i].style.height;
            bars[min_idx].innerHTML = bars[i].innerHTML;
            bars[i].style.height = tempHeight;
            bars[i].innerHTML = tempVal;

            bars[min_idx].style.backgroundColor = '#3498db';
            bars[i].style.backgroundColor = '#2ecc71'; 
        }
    }

    async function insertionSort() {
        let bars = document.querySelectorAll('.bar');
        bars[0].style.backgroundColor = '#2ecc71'; 

        for (let i = 1; i < bars.length; i++) {
            let j = i;
            bars[j].style.backgroundColor = '#f1c40f'; 
            await sleep(delay);

            while (j > 0 && parseInt(bars[j - 1].innerHTML) > parseInt(bars[j].innerHTML)) {
                bars[j].style.backgroundColor = '#e74c3c'; 
                bars[j-1].style.backgroundColor = '#e74c3c';
                await sleep(delay);

                let tempHeight = bars[j].style.height;
                let tempVal = bars[j].innerHTML;
                bars[j].style.height = bars[j-1].style.height;
                bars[j].innerHTML = bars[j-1].innerHTML;
                bars[j-1].style.height = tempHeight;
                bars[j-1].innerHTML = tempVal;

                bars[j].style.backgroundColor = '#2ecc71'; 
                j--;
            }
            bars[j].style.backgroundColor = '#2ecc71'; 
        }
    }

    async function startSort(algo) {
        disableButtons();
        showInfo(algo);
        if (algo === 'bubble') await bubbleSort();
        if (algo === 'selection') await selectionSort();
        if (algo === 'insertion') await insertionSort();
        enableButtons();
    }

    generateArray();
</script>

</body>
</html>