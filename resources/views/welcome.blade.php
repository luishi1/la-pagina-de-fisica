<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>La Página de Física | Simulador CBC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
</head>
<body class="h-full bg-[#0F0F1A] text-slate-300 flex flex-col p-2 md:p-4 gap-3 overflow-hidden" x-data="physicsApp()">

    <header class="flex flex-col shrink-0 shadow-2xl z-[100] relative">
        <div class="bg-[#1B1B2E] rounded-t-3xl border-t border-x border-white/5 px-4 md:px-6 py-3 md:py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 w-10 h-10 md:w-12 md:h-12 rounded-2xl flex items-center justify-center font-black text-xl md:text-2xl text-white shadow-[0_0_15px_rgba(37,99,235,0.3)]">ΣF</div>
                <div class="flex flex-col">
                    <h1 class="font-black text-sm md:text-xl uppercase text-white leading-none tracking-tight">La Página de Física</h1>
                    <p class="hidden sm:block text-[9px] text-blue-400 font-bold uppercase tracking-widest mt-1">Simulador Interactivo y Resolutor Paso a Paso</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button class="bg-[#4CAF50] hover:bg-green-500 text-white px-6 py-2 md:px-10 md:py-2.5 rounded-2xl font-black text-[10px] md:text-sm uppercase transition-all shadow-lg active:scale-95 border border-white/10">
                    Resolver
                </button>
                <button @click.stop="mobileMenu = !mobileMenu" class="md:hidden p-2.5 bg-white/5 rounded-xl text-white border border-white/5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>

        <nav x-show="mobileMenu" x-transition x-cloak @click.away="mobileMenu = false" class="md:hidden bg-[#161625] border-x border-b border-white/5 p-2 flex flex-col gap-1 rounded-b-3xl shadow-2xl">
            <template x-for="m in ['Cinematica 1D', 'Cinematica 2D', 'Dinamica', 'Trabajo y Energia', 'Fluidos']">
                <button @click="changeModule(m); mobileMenu = false" 
                        :class="module === m ? 'bg-blue-600/20 text-blue-400 border-blue-500/40' : 'bg-transparent text-slate-500 border-transparent'"
                        class="w-full py-3 px-4 rounded-xl text-[10px] font-black uppercase text-left border transition-all" x-text="m">
                </button>
            </template>
        </nav>

        <nav class="hidden md:flex bg-[#161625] rounded-b-3xl border-b border-x border-white/5 p-2 justify-between gap-2 shadow-xl">
            <template x-for="m in ['Cinematica 1D', 'Cinematica 2D', 'Dinamica', 'Trabajo y Energia', 'Fluidos']">
                <button @click="changeModule(m)" 
                        :class="module === m ? 'bg-blue-600/10 text-blue-400 border-blue-500/40 shadow-[0_0_15px_rgba(59,130,246,0.1)]' : 'bg-[#252538]/30 text-slate-500 border-transparent'"
                        class="flex-1 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all border" x-text="m">
                </button>
            </template>
        </nav>
    </header>

    <div class="flex-1 flex gap-3 min-h-0 relative">
        
        <aside 
            x-cloak
            @click.away="if(window.innerWidth < 768) showItems = false"
            :class="showItems ? 'translate-x-0' : '-translate-x-[120%] md:translate-x-0'"
            class="fixed md:relative z-[90] left-3 md:left-0 top-[150px] md:top-0 bottom-3 md:bottom-0 w-[80px] bg-[#1B1B2E] rounded-[2.5rem] p-3 flex flex-col items-center gap-4 border border-white/10 shadow-2xl transition-all duration-500 shrink-0">
            
            <button @click="showItems = false" class="md:hidden w-10 h-10 flex items-center justify-center bg-white/5 rounded-full text-red-500 p-2 mb-2">✕</button>
            
            <div class="w-full flex flex-col gap-3 overflow-y-auto no-scrollbar">
                <template x-for="i in [1,2,3,4,5]">
                    <button @click="addObject('box')" class="w-full aspect-square bg-[#11111d] border border-white/5 rounded-2xl flex items-center justify-center text-[11px] font-bold italic text-slate-500 hover:text-blue-400 hover:border-blue-500/30 transition-all active:scale-90">
                        It
                    </button>
                </template>
            </div>
            
            <div class="flex-1"></div>
            
            <button class="w-full aspect-square bg-red-900/20 text-red-500 rounded-2xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-lg border border-red-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </aside>

        <main class="flex-1 flex flex-col min-h-0 relative z-10">
            <div class="md:hidden absolute top-4 left-0 right-0 px-4 flex justify-between z-[80] pointer-events-none">
                <button x-show="!showItems" x-transition @click.stop="showItems = true" class="pointer-events-auto w-14 h-14 bg-blue-600 text-white rounded-2xl shadow-xl flex items-center justify-center active:scale-90 border border-white/20">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </button>
                <button x-show="!showProps" x-transition @click.stop="showProps = true" class="pointer-events-auto w-14 h-14 bg-slate-700 text-white rounded-2xl shadow-xl flex items-center justify-center active:scale-90 border border-white/10">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                </button>
            </div>

            <div id="canvas-container" class="flex-1 canvas-grid rounded-[2.5rem] border-[10px] md:border-[16px] border-[#1B1B2E] relative overflow-hidden flex items-center justify-center shadow-inner">
                <canvas id="physicsCanvas" class="touch-none z-10"></canvas>
                <div class="hidden sm:block absolute top-6 left-8 bg-black/40 backdrop-blur-md px-4 py-2 rounded-2xl border border-white/5 text-[10px] font-black text-white uppercase tracking-widest shadow-2xl">
                    Escenario: <span class="text-blue-400" x-text="module"></span>
                </div>
            </div>
        </main>

        <aside 
            x-cloak
            @click.away="if(window.innerWidth < 768) showProps = false"
            :class="showProps ? 'translate-x-0' : 'translate-x-[120%] md:translate-x-0'"
            class="fixed md:relative z-[90] right-3 md:right-0 top-[150px] md:top-0 bottom-3 md:bottom-0 w-[320px] bg-[#1B1B2E] rounded-[2.5rem] flex flex-col border border-white/10 shadow-2xl transition-all duration-500 overflow-hidden shrink-0">
            
            <div class="bg-black/20 p-6 border-b border-white/5 flex justify-between items-center">
                <h2 class="font-black text-[10px] uppercase text-slate-400 tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Propiedades
                </h2>
                <button @click="showProps = false" class="md:hidden w-10 h-10 flex items-center justify-center bg-white/5 rounded-full text-slate-500">✕</button>
            </div>
            
            <div class="flex-1 p-8 flex flex-col items-center justify-center text-center opacity-40">
                <svg class="w-10 h-10 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                <p class="text-[10px] font-bold uppercase text-slate-500 leading-relaxed tracking-wider">Seleccione algún objeto para editar variables físicas</p>
            </div>
        </aside>
    </div>

    <footer class="h-28 md:h-32 bg-[#141424] rounded-3xl border border-white/5 shadow-2xl flex flex-col overflow-hidden shrink-0">
        <div class="px-5 py-2 bg-black/40 border-b border-white/5 text-[9px] font-black text-slate-500 uppercase tracking-widest">Terminal de Salida</div>
        <div class="flex-1 font-mono text-[11px] bg-[#05050a] p-5 space-y-1 overflow-y-auto custom-scroll">
            <div class="flex gap-2 text-slate-600"><span>>></span><p>Motor de física inicializado...</p></div>
            <div class="flex gap-2 text-green-500/80 font-bold animate-pulse"><span>>></span><p>Sistema listo.</p></div>
            <div class="flex gap-2 text-blue-400/80"><span>>></span><p x-text="'Cambiando a ' + module + ' ...'"></p></div>
        </div>
    </footer>

</body>
</html>