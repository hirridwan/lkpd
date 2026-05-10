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
            height: 350px; 
            width: 100%;
            max-width: 1050px; /* Lebar container ditambah agar orang tidak meluber */
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            gap: 10px; /* Jarak sedikit dirapatkan */
        }

        /* Kontainer untuk satu 'orang' */
        .person {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end; 
            transition: transform 0.2s ease; 
        }

        /* Gambar Siluet */
        .person-img {
            background-color: #3498db; 
            -webkit-mask-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'%3E%3Cpath d='M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z'/%3E%3C/svg%3E");
            mask-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'%3E%3Cpath d='M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z'/%3E%3C/svg%3E");
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-position: bottom center;
            mask-position: bottom center;
            transition: background-color 0.2s ease; 
        }

        /* Label Tinggi Badan (cm) */
        .person-height {
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
        }

        .legend {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            background-color: white;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 1050px; /* Disesuaikan dengan container */
            justify-content: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .legend-box-person {
            width: 15px;
            height: 30px;
            background-color: inherit; 
            -webkit-mask-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'%3E%3Cpath d='M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z'/%3E%3C/svg%3E");
            mask-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'%3E%3Cpath d='M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z'/%3E%3C/svg%3E");
            -webkit-mask-size: contain;
            mask-size: contain;
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-position: center;
            mask-position: center;
        }

        #info-panel {
            margin-top: 20px;
            background-color: #e8f4f8;
            padding: 15px;
            border-left: 5px solid #3498db;
            border-radius: 0 5px 5px 0;
            max-width: 1050px; /* Disesuaikan dengan container */
            display: none;
            width: 100%;
        }

        /* Penjelasan Tambahan untuk Anak SMA */
        #penjelasan-algoritma {
            margin-top: 20px;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 1000px; /* Disesuaikan agar sejajar */
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
    <p class="description">Mari amati bagaimana komputer membandingkan dan mengurutkan orang berdasarkan tinggi badan!</p>

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
        <div class="legend-item"><div class="legend-box-person" style="background-color: #3498db;"></div> Belum Terurut</div>
        <div class="legend-item"><div class="legend-box-person" style="background-color: #e74c3c;"></div> Sedang Dibandingkan</div>
        <div class="legend-item"><div class="legend-box-person" style="background-color: #f1c40f;"></div> Target / Terkecil</div>
        <div class="legend-item"><div class="legend-box-person" style="background-color: #2ecc71;"></div> Sudah Terurut</div>
    </div>

    <div id="info-panel">
        <h3 id="info-title" style="margin-top:0;"></h3>
        <p id="info-text" style="margin-bottom:0; line-height: 1.5;"></p>
    </div>

    <div id="penjelasan-algoritma">
        <h2 style="color: #2c3e50; margin-top: 0; margin-bottom: 15px; font-size: 22px; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px;">Penjelasan Algoritma (Bahasa Simpel)</h2>
        
        <div style="margin-bottom: 20px;">
            <h4 style="color: #d35400; margin: 0 0 5px 0; font-size: 16px;">1. Bubble Sort (Sortir Gelembung)</h4>
            <p style="margin: 0; color: #555; line-height: 1.6; font-size: 15px;">
                Bayangkan gelembung udara yang naik ke permukaan air. Cara kerjanya: bandingkan dua orang bersebelahan. Kalau orang di kiri lebih tinggi dari yang kanan, mereka <b>bertukar posisi</b>. Terus digeser ke kanan sampai orang yang paling tinggi "mengapung" ke ujung paling akhir. Ulangi lagi dari awal untuk sisa barisannya.
            </p>
        </div>

        <div style="margin-bottom: 20px;">
            <h4 style="color: #2980b9; margin: 0 0 5px 0; font-size: 16px;">2. Selection Sort (Sortir Pilihan)</h4>
            <p style="margin: 0; color: #555; line-height: 1.6; font-size: 15px;">
                Kayak lagi milih orang untuk masuk tim baris-berbaris. Cara kerjanya: dari barisan yang acak, komputer <b>mencari satu orang yang paling pendek</b>. Setelah ketemu, orang tersebut langsung disuruh pindah ke ujung paling kiri barisan. Habis itu, cari lagi orang terpendek kedua dari sisa orang yang ada, dan ditaruh di sebelahnya. Begitu seterusnya.
            </p>
        </div>

        <div>
            <h4 style="color: #27ae60; margin: 0 0 5px 0; font-size: 16px;">3. Insertion Sort (Sortir Sisipan)</h4>
            <p style="margin: 0; color: #555; line-height: 1.6; font-size: 15px;">
                Persis seperti caramu mengurutkan kartu remi di tangan! Cara kerjanya: anggap orang pertama sudah di posisi yang benar. Lalu ambil orang kedua, dan <b>sisipkan</b> ia ke posisi yang pas di sebelah kirinya. Ambil orang ketiga, sisipkan lagi ke posisi yang tepat di antara barisan kiri yang sudah rapi. Begitu terus sampai semuanya masuk barisan.
            </p>
        </div>
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
            const value = Math.floor(Math.random() * 61) + 140; 

            const person = document.createElement('div');
            person.classList.add('person');
            person.dataset.height = value; 

            const img = document.createElement('div');
            img.classList.add('person-img');
            // PENGUBAHAN: Skala dikecilkan sedikit agar muat di dalam container yang baru
            img.style.height = `${value * 1.1}px`; 
            img.style.width = `${value * 0.4}px`; 

            const span = document.createElement('span');
            span.classList.add('person-height');
            span.innerHTML = `${value} cm`;

            person.appendChild(img);
            person.appendChild(span);
            container.appendChild(person);
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
            infoText.innerText = 'Mengecek dua orang bersebelahan dari kiri ke kanan. Jika orang di kiri lebih tinggi dari kanan, mereka bertukar posisi (warna merah). Orang tertinggi akan perlahan "mengapung" ke posisi paling kanan (warna hijau).';
        } else if(algo === 'selection') {
            infoTitle.innerText = 'Mekanisme Selection Sort';
            infoText.innerText = 'Mencari orang paling pendek di antara yang belum terurut (ditandai warna kuning). Setelah ketemu, orang pendek tersebut ditukar ke posisi paling depan dari kelompok yang belum terurut.';
        } else if(algo === 'insertion') {
            infoTitle.innerText = 'Mekanisme Insertion Sort';
            infoText.innerText = 'Mengambil satu orang, lalu menyisipkannya ke posisi yang tepat di sebelah kirinya yang sudah dianggap terurut. Mirip seperti cara kita mengurutkan kartu remi di tangan.';
        }
    }

    function getPersonImg(el) { return el.querySelector('.person-img'); }

    async function bubbleSort() {
        let people = document.querySelectorAll('.person');
        for (let i = 0; i < people.length - 1; i++) {
            for (let j = 0; j < people.length - i - 1; j++) {
                people = document.querySelectorAll('.person');
                let person1 = people[j];
                let person2 = people[j+1];

                getPersonImg(person1).style.backgroundColor = '#e74c3c'; 
                getPersonImg(person2).style.backgroundColor = '#e74c3c';
                await sleep(delay);

                let val1 = parseInt(person1.dataset.height);
                let val2 = parseInt(person2.dataset.height);

                if (val1 > val2) {
                    container.insertBefore(person2, person1); 
                }

                people = document.querySelectorAll('.person');
                getPersonImg(people[j]).style.backgroundColor = '#3498db'; 
                getPersonImg(people[j+1]).style.backgroundColor = '#3498db';
            }
            getPersonImg(document.querySelectorAll('.person')[people.length - 1 - i]).style.backgroundColor = '#2ecc71'; 
        }
        getPersonImg(document.querySelectorAll('.person')[0]).style.backgroundColor = '#2ecc71';
    }

    async function selectionSort() {
        let people = document.querySelectorAll('.person');
        for (let i = 0; i < people.length; i++) {
            let people = document.querySelectorAll('.person'); 
            let min_idx = i;
            getPersonImg(people[min_idx]).style.backgroundColor = '#f1c40f'; 
            
            for (let j = i + 1; j < people.length; j++) {
                getPersonImg(people[j]).style.backgroundColor = '#e74c3c'; 
                await sleep(delay);

                let valMin = parseInt(people[min_idx].dataset.height);
                let valCur = parseInt(people[j].dataset.height);

                if (valCur < valMin) {
                    if (min_idx !== i) getPersonImg(people[min_idx]).style.backgroundColor = '#3498db'; 
                    min_idx = j;
                    getPersonImg(people[min_idx]).style.backgroundColor = '#f1c40f'; 
                } else {
                    getPersonImg(people[j]).style.backgroundColor = '#3498db';
                }
            }

            if (min_idx !== i) {
                let person1 = people[min_idx];
                let person2 = people[i];
                let img1 = getPersonImg(person1);
                let img2 = getPersonImg(person2);
                
                let tempImgHeight = img1.style.height;
                let tempImgWidth = img1.style.width;
                let tempVal = person1.dataset.height;
                
                img1.style.height = img2.style.height;
                img1.style.width = img2.style.width;
                person1.dataset.height = person2.dataset.height;
                person1.querySelector('.person-height').innerHTML = `${person2.dataset.height} cm`;
                
                img2.style.height = tempImgHeight;
                img2.style.width = tempImgWidth;
                person2.dataset.height = tempVal;
                person2.querySelector('.person-height').innerHTML = `${tempVal} cm`;
            }

            let sortedPeople = document.querySelectorAll('.person'); 
            getPersonImg(sortedPeople[min_idx]).style.backgroundColor = '#3498db';
            getPersonImg(sortedPeople[i]).style.backgroundColor = '#2ecc71'; 
        }
    }

    async function insertionSort() {
        let people = document.querySelectorAll('.person');
        getPersonImg(people[0]).style.backgroundColor = '#2ecc71'; 

        for (let i = 1; i < people.length; i++) {
            let people = document.querySelectorAll('.person');
            let j = i;
            getPersonImg(people[j]).style.backgroundColor = '#f1c40f'; 
            await sleep(delay);

            while (j > 0 && parseInt(document.querySelectorAll('.person')[j - 1].dataset.height) > parseInt(document.querySelectorAll('.person')[j].dataset.height)) {
                people = document.querySelectorAll('.person');
                let person1 = people[j];
                let person2 = people[j-1];

                getPersonImg(person1).style.backgroundColor = '#e74c3c'; 
                getPersonImg(person2).style.backgroundColor = '#e74c3c';
                await sleep(delay);

                container.insertBefore(person1, person2); 
                
                people = document.querySelectorAll('.person');
                getPersonImg(people[j]).style.backgroundColor = '#2ecc71'; 
                j--;
            }
            getPersonImg(document.querySelectorAll('.person')[j]).style.backgroundColor = '#2ecc71'; 
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