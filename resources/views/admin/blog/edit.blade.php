<x-layouts.admin>
    <x-slot:title>Editar Post</x-slot:title>
    
    @php
        $breadcrumbs = [
            ['name' => 'Blog', 'url' => route('admin.blog.index'), 'active' => false],
            ['name' => 'Editar Post', 'url' => '#', 'active' => true]
        ];
    @endphp

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Editar Post</h1>
            <p class="text-gray-600 mt-2">Modifica el contenido del post</p>
        </div>
        <a href="{{ route('admin.blog.index') }}" 
           class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Volver al listado</span>
        </a>
    </div>

    {{-- Debug temporal --}}
    @if(!isset($post) || !$post)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Error:</strong> Variable $post no está disponible o está vacía.
            <br>Debug: isset($post) = {{ isset($post) ? 'true' : 'false' }}
            <br>Debug: $post = {{ $post ?? 'null' }}
        </div>
    @else
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <strong>Debug:</strong> Variable $post está disponible.
            <br>ID: {{ $post->id ?? 'null' }}
            <br>Título: {{ $post->title ?? 'null' }}
        </div>
    @endif

    {{-- Formulario --}}
    <div class="bg-pink-50 px-8 py-6 rounded-2xl max-w-2xl mx-auto">
        <form action="{{ route('admin.blog.update', $post) }}" method="POST" enctype="multipart/form-data" id="blog-form">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                {{-- Título --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-800 mb-2">
                        Título del Post *
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $post->title) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-lg"
                           placeholder="Escribe un título atractivo..."
                           required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Editor Markdown --}}
                <div>
                    <label class="block text-sm font-medium text-gray-800 mb-2">
                        Contenido del Post *
                    </label>
                    <div class="border border-gray-300 rounded-lg overflow-hidden">
                        <div id="editor" class="min-h-[500px]"></div>
                    </div>
                    <input type="hidden" id="content" name="content" value="{{ old('content', $post->content) }}">
                    @error('content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Estado --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-800 mb-2">
                        Estado
                    </label>
                    <select id="status" name="status" 
                            class="w-full px-4 py-3 bg-pink-100 border-2 border-pink-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 text-gray-800 transition-all duration-300">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Borrador</option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Publicado</option>
                    </select>
                    @error('status')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Imagen destacada --}}
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-800 mb-2">
                        Imagen Destacada
                    </label>
                    <x-image-upload 
                        name="featured_image" 
                        type="blog" 
                        :currentImage="$post->featured_image"
                        class="w-full"
                    />
                </div>

                {{-- Acciones --}}
                <div class="pt-4 space-y-3">
                    <button type="submit" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 hover:shadow-lg">
                        Actualizar Post
                    </button>
                    
                    <button type="button" 
                            id="preview-btn"
                            class="w-full bg-pink-100 hover:bg-pink-200 text-gray-800 font-medium py-3 px-6 rounded-xl transition-all duration-300 border-2 border-pink-300">
                        Vista Previa
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Scripts para Editor Markdown --}}
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cargar contenido existente
            let existingContent = null;
            try {
                existingContent = @json($post->content ? json_decode($post->content) : null);
            } catch (e) {
                console.log('Error al cargar contenido existente:', e);
            }

            // Inicializar Editor.js
            const editor = new EditorJS({
                holder: 'editor',
                placeholder: 'Escribe tu contenido aquí... Usa Markdown para formatear el texto.',
                tools: {
                    header: {
                        class: Header,
                        config: {
                            placeholder: 'Escribe un encabezado',
                            levels: [1, 2, 3, 4, 5, 6],
                            defaultLevel: 2
                        }
                    },
                    list: {
                        class: List,
                        inlineToolbar: true,
                        config: {
                            defaultStyle: 'unordered'
                        }
                    },
                    quote: {
                        class: Quote,
                        inlineToolbar: true,
                        config: {
                            quotePlaceholder: 'Escribe una cita',
                            captionPlaceholder: 'Autor de la cita',
                        }
                    },
                    code: {
                        class: CodeTool,
                        config: {
                            placeholder: 'Escribe tu código aquí...'
                        }
                    },
                    marker: {
                        class: Marker,
                        shortcut: 'CMD+SHIFT+M'
                    },
                    delimiter: Delimiter,
                    table: {
                        class: Table,
                        inlineToolbar: true,
                        config: {
                            rows: 2,
                            cols: 3,
                        }
                    },
                    warning: {
                        class: Warning,
                        inlineToolbar: true,
                        config: {
                            titlePlaceholder: 'Título',
                            messagePlaceholder: 'Mensaje',
                        }
                    }
                },
                data: existingContent
            });

            // Vista previa de imagen
            document.getElementById('featured_image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview-img').src = e.target.result;
                        document.getElementById('image-preview').classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Guardar contenido antes de enviar
            document.getElementById('blog-form').addEventListener('submit', function(e) {
                editor.save().then((outputData) => {
                    document.getElementById('content').value = JSON.stringify(outputData);
                }).catch((error) => {
                    console.log('Error al guardar:', error);
                    alert('Error al guardar el contenido. Intenta nuevamente.');
                });
            });

            // Vista previa
            document.getElementById('preview-btn').addEventListener('click', function() {
                editor.save().then((outputData) => {
                    // Convertir a HTML para vista previa
                    const htmlContent = convertToHTML(outputData);
                    
                    // Crear ventana de vista previa
                    const previewWindow = window.open('', '_blank', 'width=800,height=600');
                    previewWindow.document.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <title>Vista Previa - ${document.getElementById('title').value}</title>
                            <style>
                                body { 
                                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
                                    max-width: 800px; 
                                    margin: 0 auto; 
                                    padding: 20px; 
                                    line-height: 1.6;
                                    color: #333;
                                }
                                h1, h2, h3, h4, h5, h6 { 
                                    color: #2d3748; 
                                    margin-top: 2rem;
                                    margin-bottom: 1rem;
                                }
                                h1 { font-size: 2.5rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem; }
                                h2 { font-size: 2rem; }
                                h3 { font-size: 1.5rem; }
                                blockquote { 
                                    border-left: 4px solid #4299e1; 
                                    padding-left: 16px; 
                                    margin: 16px 0; 
                                    background: #f7fafc;
                                    padding: 16px;
                                    border-radius: 4px;
                                }
                                code { 
                                    background: #f1f5f9; 
                                    padding: 2px 6px; 
                                    border-radius: 4px; 
                                    font-family: 'Monaco', 'Menlo', monospace;
                                    font-size: 0.9em;
                                }
                                pre { 
                                    background: #2d3748; 
                                    color: #e2e8f0;
                                    padding: 16px; 
                                    border-radius: 8px; 
                                    overflow-x: auto; 
                                    margin: 16px 0;
                                }
                                pre code {
                                    background: none;
                                    color: inherit;
                                    padding: 0;
                                }
                                ul, ol {
                                    padding-left: 2rem;
                                    margin: 1rem 0;
                                }
                                li {
                                    margin: 0.5rem 0;
                                }
                                table {
                                    border-collapse: collapse;
                                    width: 100%;
                                    margin: 16px 0;
                                }
                                th, td {
                                    border: 1px solid #e2e8f0;
                                    padding: 8px 12px;
                                    text-align: left;
                                }
                                th {
                                    background: #f7fafc;
                                    font-weight: 600;
                                }
                                .warning {
                                    background: #fef5e7;
                                    border: 1px solid #f6ad55;
                                    padding: 16px;
                                    border-radius: 8px;
                                    margin: 16px 0;
                                }
                                .warning strong {
                                    color: #c05621;
                                }
                                hr {
                                    border: none;
                                    border-top: 2px solid #e2e8f0;
                                    margin: 2rem 0;
                                }
                            </style>
                        </head>
                        <body>
                            <h1>${document.getElementById('title').value}</h1>
                            ${htmlContent}
                        </body>
                        </html>
                    `);
                });
            });

            // Función para convertir Editor.js a HTML
            function convertToHTML(blocks) {
                let html = '';
                
                blocks.blocks.forEach(block => {
                    switch(block.type) {
                        case 'header':
                            html += `<h${block.data.level}>${block.data.text}</h${block.data.level}>`;
                            break;
                        case 'paragraph':
                            html += `<p>${block.data.text}</p>`;
                            break;
                        case 'list':
                            const listTag = block.data.style === 'ordered' ? 'ol' : 'ul';
                            html += `<${listTag}>`;
                            block.data.items.forEach(item => {
                                html += `<li>${item}</li>`;
                            });
                            html += `</${listTag}>`;
                            break;
                        case 'quote':
                            html += `<blockquote><p>${block.data.text}</p><cite>${block.data.caption}</cite></blockquote>`;
                            break;
                        case 'code':
                            html += `<pre><code>${block.data.code}</code></pre>`;
                            break;
                        case 'delimiter':
                            html += '<hr>';
                            break;
                        case 'table':
                            html += '<table>';
                            block.data.content.forEach((row, index) => {
                                const tag = index === 0 ? 'th' : 'td';
                                html += '<tr>';
                                row.forEach(cell => {
                                    html += `<${tag}>${cell}</${tag}>`;
                                });
                                html += '</tr>';
                            });
                            html += '</table>';
                            break;
                        case 'warning':
                            html += `<div class="warning">
                                        <strong>${block.data.title}</strong><br>
                                        ${block.data.message}
                                     </div>`;
                            break;
                    }
                });
                
                return html;
            }
        });
    </script>
</x-layouts.admin>
