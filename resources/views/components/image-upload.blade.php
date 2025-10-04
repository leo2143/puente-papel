@props([
    'name' => 'image',
    'type' => 'products',
    'currentImage' => null,
    'required' => false,
    'multiple' => false,
    'maxFiles' => 5,
    'accept' => 'image/*',
    'class' => '',
    'previewClass' => 'w-full h-48',
    'showPreview' => true,
    'allowDelete' => true,
    'allowChange' => true,
    'folder' => null
])

@php
    $inputId = 'image-upload-' . uniqid();
    $containerClass = 'image-upload-container ' . $class;
    $hasCurrentImage = !empty($currentImage);
    $imageType = $folder ?? $type; // Usar folder si se especifica, sino usar type
@endphp

<div class="{{ $containerClass }}" x-data="imageUpload({
    name: '{{ $name }}',
    type: '{{ $imageType }}',
    currentImage: @js($currentImage),
    multiple: {{ $multiple ? 'true' : 'false' }},
    maxFiles: {{ $maxFiles }},
    hasCurrentImage: {{ $hasCurrentImage ? 'true' : 'false' }}
})">
    
    {{-- Input file oculto --}}
    <input 
        type="file" 
        id="{{ $inputId }}"
        name="{{ $multiple ? $name . '[]' : $name }}"
        class="image-upload-input"
        accept="{{ $accept }}"
        {{ $multiple ? 'multiple' : '' }}
        {{ $required ? 'required' : '' }}
        x-ref="fileInput"
        @change="handleFileSelect($event)"
        @dragover.prevent="handleDragOver($event)"
        @dragleave.prevent="handleDragLeave($event)"
        @drop.prevent="handleDrop($event)"
    >

    {{-- Vista de imagen actual (modo edición) --}}
    <div x-show="hasCurrentImage && !showUploadArea" class="image-existing-container">
        <img 
            :src="currentImageUrl" 
            :alt="'Imagen actual'"
            class="image-existing-preview {{ $previewClass }}"
        >
        
        <div class="image-existing-overlay">
            <div class="image-existing-actions">
                @if($allowChange)
                    <button 
                        type="button" 
                        class="image-existing-btn change"
                        @click="showUploadArea = true"
                    >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Cambiar
                    </button>
                @endif
                
                @if($allowDelete)
                    <button 
                        type="button" 
                        class="image-existing-btn remove"
                        @click="removeCurrentImage()"
                    >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Eliminar
                    </button>
                @endif
            </div>
        </div>
    </div>

    {{-- Área de upload --}}
    <div x-show="showUploadArea" class="image-upload-area">
        <label for="{{ $inputId }}" class="image-upload-label" :class="{ 'dragover': isDragOver }">
            <div class="image-upload-content">
                <svg class="image-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <p class="image-upload-text">
                    <span class="font-semibold">Haz clic para subir</span> o arrastra y suelta
                </p>
                <p class="image-upload-format">
                    PNG, JPG, GIF, WEBP hasta 5MB
                </p>
            </div>
        </label>
    </div>

    {{-- Preview de nueva imagen --}}
    <div x-show="previewUrl" class="image-preview-container mt-4">
        <img 
            :src="previewUrl" 
            :alt="'Vista previa'"
            class="image-preview {{ $previewClass }}"
        >
        
        <div class="image-preview-overlay">
            <div class="image-preview-actions">
                <button 
                    type="button" 
                    class="image-preview-btn edit"
                    @click="$refs.fileInput.click()"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Cambiar
                </button>
                
                <button 
                    type="button" 
                    class="image-preview-btn delete"
                    @click="clearPreview()"
                >
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Eliminar
                </button>
            </div>
        </div>
    </div>

    {{-- Campo hidden para mantener imagen existente --}}
    @if($hasCurrentImage)
        <input type="hidden" name="{{ $name }}_existing" :value="currentImage">
    @endif

    {{-- Campo hidden para eliminar imagen --}}
    <input type="hidden" name="{{ $name }}_delete" x-model="deleteImage">

    {{-- Mensajes de error --}}
    <div x-show="error" class="image-upload-error" x-text="error"></div>

    {{-- Mensajes de éxito --}}
    <div x-show="success" class="image-upload-success" x-text="success"></div>

    {{-- Progress bar --}}
    <div x-show="uploading" class="image-upload-progress">
        <div class="image-upload-progress-bar" :style="'width: ' + uploadProgress + '%'"></div>
    </div>
</div>

{{-- JavaScript para el componente --}}
<script>
function imageUpload(config) {
    return {
        name: config.name,
        type: config.type,
        currentImage: config.currentImage,
        multiple: config.multiple,
        maxFiles: config.maxFiles,
        hasCurrentImage: config.hasCurrentImage,
        
        // Estado reactivo
        showUploadArea: !config.hasCurrentImage,
        previewUrl: null,
        isDragOver: false,
        error: null,
        success: null,
        uploading: false,
        uploadProgress: 0,
        deleteImage: false,
        
        // Computed
        get currentImageUrl() {
            if (this.currentImage) {
                return `/storage/images/${this.type}/${this.currentImage}`;
            }
            return null;
        },
        
        // Métodos
        handleFileSelect(event) {
            const files = event.target.files;
            if (files.length > 0) {
                this.processFiles(files);
            }
        },
        
        handleDragOver(event) {
            event.preventDefault();
            this.isDragOver = true;
        },
        
        handleDragLeave(event) {
            event.preventDefault();
            this.isDragOver = false;
        },
        
        handleDrop(event) {
            event.preventDefault();
            this.isDragOver = false;
            
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                this.processFiles(files);
            }
        },
        
        processFiles(files) {
            if (files.length > this.maxFiles) {
                this.error = `Máximo ${this.maxFiles} archivos permitidos`;
                return;
            }
            
            const file = files[0];
            
            // Validar tipo de archivo
            if (!file.type.startsWith('image/')) {
                this.error = 'Solo se permiten archivos de imagen';
                return;
            }
            
            // Validar tamaño (5MB)
            if (file.size > 5 * 1024 * 1024) {
                this.error = 'El archivo es demasiado grande (máximo 5MB)';
                return;
            }
            
            // Limpiar errores
            this.error = null;
            this.success = null;
            
            // Crear preview
            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewUrl = e.target.result;
                this.showUploadArea = false;
            };
            reader.readAsDataURL(file);
        },
        
        clearPreview() {
            this.previewUrl = null;
            this.showUploadArea = true;
            this.$refs.fileInput.value = '';
        },
        
        removeCurrentImage() {
            this.deleteImage = true;
            this.currentImage = null;
            this.hasCurrentImage = false;
            this.showUploadArea = true;
        }
    }
}
</script>
