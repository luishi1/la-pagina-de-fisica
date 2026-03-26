<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Página de Física</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
</head>
<body class="flex flex-col p-4 gap-4 h-screen w-screen border-box" x-data="physicsApp()">

    <header class="flex flex-col glass-panel overflow-hidden shrink-0">
        <div class="p-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 w-10 h-10 rounded-xl flex items-center justify-center font-black text-xl text-white shadow-lg">ΣF</div>
                <div class="flex flex-col">
                    <h1 class="font-black text-lg uppercase text-white leading-none">La Página de Física</h1>
                    <p class="text-[9px] text-blue-400 font-bold uppercase tracking-widest mt-1">Simulador & Resolutor CBC</p>
                </div>
            </div>
            <button class="bg-[#4CAF50] hover:bg-green-600 text-white px-8 py-2 rounded-xl font-black text-xs uppercase transition-all shadow-lg">
                Resolver
            </button>
        </div>
        <div class="bg-black/20 px-4 py-2 flex flex-wrap gap-2 border-t border-white/5">
            <template x-for="m in ['Cinematica 1D', 'Cinematica 2D', 'Dinamica', 'Trabajo y Energia', 'Fluidos']">
                <button @click="changeModule(m)" 
                    :class="module === m ? 'bg-[#2E7D32] text-white border-green-400' : 'bg-[#252538] text-slate-400 border-transparent'"
                    class="px-4 py-1.5 rounded-lg text-[10px] font-bold uppercase border transition-all" x-text="m"></button>
            </template>
        </div>
    </header>

    <div class="flex-1 grid grid-cols-12 gap-4 min-h-0">
        <aside class="col-span-1 glass-panel p-2 flex flex-col items-center gap-3">
            <template x-for="i in [1,2,3,4]">
                <button class="w-10 h-10 bg-black/40 border border-slate-700 rounded-lg hover:border-blue-500 text-white flex items-center justify-center italic text-xs">It</button>
            </template>
            <div class="flex-1"></div>
            <button class="w-10 h-10 bg-red-900/20 text-red-500 rounded-lg border border-red-500/20">🗑</button>
        </aside>

        <main class="col-span-8 flex flex-col min-h-0">
            <div id="canvas-container" class="flex-1 bg-[#3A3A55] rounded-[2rem] border-[6px] border-[#1B1B2E] relative overflow-hidden shadow-inner flex items-center justify-center">
                <canvas id="physicsCanvas"></canvas>
                <div class="absolute top-4 left-4 bg-black/40 backdrop-blur-md px-3 py-1 rounded-full border border-white/10 text-[9px] font-bold uppercase text-white">
                    Escenario: <span class="text-blue-400" x-text="module"></span>
                </div>
            </div>
        </main>

        <aside class="col-span-3 glass-panel flex flex-col overflow-hidden min-h-0">
            <div class="bg-black/20 p-3 border-b border-white/5 flex justify-between items-center text-xs font-bold text-slate-400 uppercase tracking-widest">
                Propiedades <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            </div>
            <div class="flex-1 flex items-center justify-center p-6 opacity-30 italic text-[10px] text-center">
                Seleccione un objeto para editar sus variables
            </div>
        </aside>
    </div>

    <footer class="h-32 glass-panel p-4 flex flex-col shrink-0">
        <div class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-2">> Terminal</div>
        <div class="flex-1 overflow-y-auto custom-scroll font-mono text-xs text-blue-300 space-y-1">
            <template x-for="line in terminalLines">
                <p x-text="line"></p>
            </template>
            <p class="animate-pulse text-white">_</p>
        </div>
    </footer>

</body>
</html>