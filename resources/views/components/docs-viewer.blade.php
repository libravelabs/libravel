@props([
    'url' => '',
])

@push('styles')
    <style>
        .no-spinner::-webkit-inner-spin-button,
        .no-spinner::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .no-spinner {
            -moz-appearance: textfield;
        }
    </style>
@endpush

<!-- Hacker Jangan Menyerang -->
<div x-data="pdfViewer('{{ $url }}')" class="relative p-6 rounded-lg shadow-md min-h-screen h-full w-full max-w-4xl mx-auto">
    <!-- Hacker Jangan Menyerang -->
    <div class="flex flex-col items-center justify-center">
        <canvas id="pdf-canvas" class="rounded-lg shadow h-full max-w-[450px] lg:max-w-full"></canvas>

        <div
            class="absolute bottom-10 flex items-center justify-center bg-black/70 text-white mt-4 px-4 py-2 rounded-full">
            <div class="flex items-center gap-2 text-sm">
                <span>Page</span>
                <button @click="prevPage" class="p-1 rounded-md transition">−</button>
                <input type="text" x-model="pageInput" @input.debounce.500ms="goToPage"
                    class="bg-transparent w-12 h-7 text-center rounded-md focus:ring focus:ring-blue-300" />
                <span>/</span>
                <span x-text="totalPages"></span>
                <button @click="nextPage" class="p-2 rounded-md transition">+</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.3.200/build/pdf.min.js"></script>
    <script>
        function pdfViewer(url) {
            return {
                url: url,
                pdfDoc: null,
                pageNum: 1,
                totalPages: 0,
                scale: 1.3,
                pageInput: 1,

                async loadPdf() {
                    this.pdfDoc = await pdfjsLib.getDocument(this.url).promise;
                    this.totalPages = this.pdfDoc.numPages;
                    this.pageInput = this.pageNum;
                    this.renderPage();
                },

                async renderPage() {
                    let page = await this.pdfDoc.getPage(this.pageNum);
                    let viewport = page.getViewport({
                        scale: this.scale
                    });

                    let canvas = document.getElementById("pdf-canvas");
                    let ctx = canvas.getContext("2d");
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    let renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    page.render(renderContext);
                },

                nextPage() {
                    if (this.pageNum < this.totalPages) {
                        this.pageNum++;
                        this.pageInput = this.pageNum;
                        this.renderPage();
                    }
                },

                prevPage() {
                    if (this.pageNum > 1) {
                        this.pageNum--;
                        this.pageInput = this.pageNum;
                        this.renderPage();
                    }
                },
                zoomIn() {
                    this.scale += 0.2;
                    this.renderPage();
                },
                zoomOut() {
                    if (this.scale > 0.6) {
                        this.scale -= 0.2;
                        this.renderPage();
                    }
                },
                goToPage() {
                    let page = parseInt(this.pageInput);
                    if (!isNaN(page) && page >= 1 && page <= this.totalPages) {
                        this.pageNum = page;
                        this.renderPage();
                    } else {
                        this.pageInput = this.pageNum; // Reset input jika invalid
                    }
                },

                init() {
                    this.loadPdf();
                }
            };
        }
    </script>
@endpush
