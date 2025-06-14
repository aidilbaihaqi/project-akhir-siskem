@extends('layouts.main')

@section('inline-style')
    <style>
        .editor-toolbar {
            background-color: #f8f9fa;
            padding: 0.5rem;
            border-radius: 0.25rem 0.25rem 0 0;
            border: 1px solid #ced4da;
            display: flex;
            flex-wrap: wrap;
            gap: 0.25rem;
        }

        .editor-toolbar button {
            background: none;
            border: none;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
        }

        .editor-toolbar button:hover {
            background-color: #e9ecef;
        }

        .editor-content {
            min-height: 200px;
            border: 1px solid #ced4da;
            border-top: none;
            border-radius: 0 0 0.25rem 0.25rem;
            padding: 1rem;
            outline: none;
        }

        .editor-content:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .tag {
            display: inline-flex;
            align-items: center;
            background-color: #e9ecef;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .tag-remove {
            margin-left: 0.5rem;
            cursor: pointer;
            color: #6c757d;
        }

        .tag-remove:hover {
            color: #dc3545;
        }

        .form-section {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 2rem;
        }

        .preview-content {
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 1rem;
            min-height: 200px;
        }

        .character-count {
            font-size: 0.8rem;
            color: #6c757d;
            text-align: right;
        }

        .character-count.warning {
            color: #fd7e14;
        }

        .character-count.danger {
            color: #dc3545;
        }
    </style>
@endsection

@section('content')
    {{-- Main Content --}}
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route("home.index") }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Buat Diskusi</li>
                            </ol>
                        </nav>
                        <h1 class="h2 mb-0">Buat Diskusi Baru</h1>
                    </div>
                    <a href="{{ route("home.index") }}" class="btn btn-outline-secondary">Batal</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="form-section mb-5">
                    <form id="createDiscussionForm" method="POST" action="{{ route('topics.store') }}">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="discussionTitle" class="form-label fw-bold">
                                Judul Diskusi <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="discussionTitle" name="title" maxlength="100"
                                value="{{ old('title') }}" placeholder="Masukkan judul diskusi yang jelas dan deskriptif" required>
                            <div class="form-text">Contoh: "Bagaimana menyikapi kenaikan harga BBM untuk mahasiswa?"</div>
                            <div class="character-count mt-1">
                                <span id="titleCount">{{ strlen(old('title')) }}</span>/100 karakter
                            </div>
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="discussionCategory" class="form-label fw-bold">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" id="discussionCategory" name="category_id" required>
                                <option value="" selected disabled>Pilih kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id?'selected':'' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                Konten Diskusi <span class="text-danger">*</span>
                            </label>
                            <!-- Editor Toolbar, opsional, bisa diisi tombol bold/italic dsb jika ada script JS editor -->
                            <div class="editor-toolbar mb-0">
                                <!-- Contoh toolbar, butuh JS untuk aktif -->
                                <button type="button" data-command="bold" title="Bold"><i class="bi bi-type-bold"></i></button>
                                <button type="button" data-command="italic" title="Italic"><i class="bi bi-type-italic"></i></button>
                            </div>
                            <textarea class="form-control" id="discussionContent" name="content" rows="8"
                                maxlength="5000" required
                                placeholder="Tulis isi diskusi Anda di sini...">{{ old('content') }}</textarea>
                            <div class="character-count mt-1">
                                <span id="contentCount">{{ strlen(old('content')) }}</span>/5000 karakter
                            </div>
                            @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Tags -->
                        <div class="mb-4 position-relative">
                            <label for="discussionTags" class="form-label fw-bold">Tag</label>
                            <input type="text" class="form-control" id="discussionTags" placeholder="Tambahkan tag...">
                            <div class="form-text">
                                Maksimal 5 tag, setiap tag maksimal 15 karakter. Pisahkan dengan koma atau tekan enter.
                            </div>
                            <div id="tagSuggestions" class="list-group position-absolute" style="z-index:10;"></div>
                            <div class="tags-container mt-2 d-flex flex-wrap" id="tagsContainer"></div>
                            <input type="hidden" id="hiddenTags" name="tags" value="{{ old('tags') }}">
                            @error('tags') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Publikasikan Diskusi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div
@endsection

@section('script-file')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Character counters
            const titleInput = document.getElementById('discussionTitle');
            const contentEditable = document.getElementById('discussionContent');
            const titleCount = document.getElementById('titleCount');
            const contentCount = document.getElementById('contentCount');
            
            // Tags functionality & autocomplete
            const tagsInput = document.getElementById('discussionTags');
            const tagsContainer = document.getElementById('tagsContainer');
            const hiddenTags = document.getElementById('hiddenTags');
            const tagSuggestions = document.createElement('div');
            tagSuggestions.id = 'tagSuggestions';
            tagSuggestions.className = 'list-group position-absolute';
            tagSuggestions.style.zIndex = 10;
            tagsInput.parentNode.insertBefore(tagSuggestions, tagsInput.nextSibling);

            let tags = [];
            
            // Preview elements
            const previewTitle = document.getElementById('previewTitle');
            const previewBody = document.getElementById('previewBody');
            const previewTags = document.getElementById('previewTags');
            const previewContent = document.getElementById('previewContent');
            const togglePreview = document.getElementById('togglePreview');
            
            // Form submission
            const createDiscussionForm = document.getElementById('createDiscussionForm');
            const hiddenContent = document.getElementById('hiddenContent');
            
            // Title character counter
            titleInput.addEventListener('input', function() {
                const count = this.value.length;
                titleCount.textContent = count;
                if (count > 80) titleCount.classList.add('warning');
                else titleCount.classList.remove('warning');
                if (count >= 100) {
                    this.value = this.value.substring(0, 100);
                    titleCount.textContent = 100;
                }
                previewTitle.textContent = this.value;
            });

            // Content character counter
            contentEditable.addEventListener('input', function() {
                const count = this.textContent.length;
                contentCount.textContent = count;
                if (count > 4000) contentCount.classList.add('warning');
                else if (count > 4500) contentCount.classList.add('danger');
                else contentCount.classList.remove('warning', 'danger');
                hiddenContent.value = this.innerHTML;
                previewBody.innerHTML = this.innerHTML;
            });

            // Tag input keydown: add tag on Enter/comma
            tagsInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    addTag(this.value.trim().replace(',', ''));
                    this.value = '';
                    tagSuggestions.innerHTML = '';
                }
            });

            // Tag input autocomplete
            tagsInput.addEventListener('input', function(e) {
                const val = tagsInput.value.trim();
                if (val.length === 0) {
                    tagSuggestions.innerHTML = '';
                    return;
                }
                fetch(`/tags/autocomplete?query=${encodeURIComponent(val)}`)
                    .then(r => r.json())
                    .then(tagList => {
                        tagSuggestions.innerHTML = '';
                        tagList.forEach(tag => {
                            if (!tags.includes(tag.toLowerCase())) {
                                const item = document.createElement('button');
                                item.type = 'button';
                                item.className = 'list-group-item list-group-item-action';
                                item.textContent = tag;
                                item.onclick = function() {
                                    addTag(tag);
                                    tagsInput.value = '';
                                    tagSuggestions.innerHTML = '';
                                };
                                tagSuggestions.appendChild(item);
                            }
                        });
                    });
            });

            // Blur input tag, auto-commit jika ada sisa
            tagsInput.addEventListener('blur', function() {
                if (tagsInput.value.trim()) {
                    addTag(tagsInput.value);
                    tagsInput.value = '';
                    tagSuggestions.innerHTML = '';
                }
            });

            // Add tag function (with validation)
            function addTag(tagText) {
                tagText = tagText.trim().toLowerCase().replace(/[^a-z0-9\-]/gi, '');
                if (!tagText || tags.includes(tagText)) return;
                if (tagText.length < 2) return;
                if (tagText.length > 15) {
                    alert('Setiap tag maksimal 15 karakter!');
                    return;
                }
                if (tags.length >= 5) {
                    alert('Maksimal 5 tag!');
                    return;
                }
                tags.push(tagText);
                updateTagsDisplay();
            }

            function removeTag(tagText) {
                tags = tags.filter(tag => tag !== tagText);
                updateTagsDisplay();
            }

            function updateTagsDisplay() {
                tagsContainer.innerHTML = '';
                tags.forEach(tag => {
                    const tagElement = document.createElement('div');
                    tagElement.className = 'tag badge bg-primary text-white me-2 mb-2 d-inline-flex align-items-center';
                    tagElement.innerHTML = `
                        ${tag}
                        <span class="tag-remove ms-2" style="cursor:pointer;" data-tag="${tag}">
                            <i class="bi bi-x"></i>
                        </span>
                    `;
                    tagsContainer.appendChild(tagElement);
                });
                hiddenTags.value = tags.join(',');
                previewTags.innerHTML = tags.map(tag =>
                    `<span class="badge bg-secondary me-1">${tag}</span>`
                ).join('');
                // Add event listeners for remove
                tagsContainer.querySelectorAll('.tag-remove').forEach(button => {
                    button.addEventListener('click', function() {
                        removeTag(this.getAttribute('data-tag'));
                    });
                });
            }

            // Rich text editor functionality
            document.querySelectorAll('.editor-toolbar button').forEach(button => {
                button.addEventListener('click', function() {
                    const command = this.getAttribute('data-command');
                    if (command === 'createLink') {
                        const url = prompt('Masukkan URL:');
                        if (url) document.execCommand(command, false, url);
                    } else if (command === 'insertImage') {
                        const url = prompt('Masukkan URL gambar:');
                        if (url) document.execCommand(command, false, url);
                    } else {
                        document.execCommand(command, false, null);
                    }
                    contentEditable.focus();
                });
            });

            // Toggle preview
            togglePreview.addEventListener('click', function() {
                previewContent.style.display = previewContent.style.display === 'none' ? 'block' : 'none';
            });

            // Save draft
            document.getElementById('saveDraft').addEventListener('click', function() {
                alert('Draft berhasil disimpan!');
                // In a real app, save to local storage or send to server
            });

            // Form submission
            createDiscussionForm.addEventListener('submit', function(e) {
                // Cek required JS-side
                if (!titleInput.value.trim()) {
                    alert('Judul diskusi harus diisi');
                    e.preventDefault();
                    return;
                }
                if (!contentEditable.textContent.trim()) {
                    alert('Konten diskusi harus diisi');
                    e.preventDefault();
                    return;
                }
                if (tags.length > 5) {
                    alert('Maksimal 5 tag!');
                    e.preventDefault();
                    return;
                }
                // Tag validasi backend juga tetap harus ada
                hiddenTags.value = tags.join(',');
            });

            // Inisialisasi preview
            previewTitle.textContent = titleInput.value;
            previewBody.innerHTML = contentEditable.innerHTML;
            updateTagsDisplay();
        });
        </script>
@endsection