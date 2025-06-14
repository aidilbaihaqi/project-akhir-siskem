<script>
    const tagsInput = document.getElementById('discussionTags');
    const tagsField = document.getElementById('hiddenTags');
    const tagsContainer = document.getElementById('tagsContainer');
    const tagSuggestions = document.getElementById('tagSuggestions');

    let selectedTags = [];

    // Helper untuk render tag
    function renderTags() {
        tagsContainer.innerHTML = '';
        selectedTags.forEach((tag, i) => {
            const tagElem = document.createElement('span');
            tagElem.className = 'badge bg-primary text-white me-2 mb-2 d-flex align-items-center';
            tagElem.innerHTML = tag +
                `<button type="button" data-index="${i}" class="btn btn-sm btn-close ms-2" aria-label="Remove"></button>`;
            tagsContainer.appendChild(tagElem);
        });
        tagsField.value = selectedTags.join(','); // Untuk dikirim ke server
    }

    // Hapus tag saat tombol close diklik
    tagsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-close')) {
            const idx = e.target.getAttribute('data-index');
            selectedTags.splice(idx, 1);
            renderTags();
        }
    });

    // Tambah tag dari input
    function addTag(tag) {
        tag = tag.trim().toLowerCase().replace(/[^a-z0-9\-]/gi, '');
        if (!tag || selectedTags.includes(tag)) return;
        if (tag.length > 15) {
            alert('Setiap tag maksimal 15 karakter!');
            return;
        }
        if (selectedTags.length >= 5) {
            alert('Maksimal 5 tag!');
            return;
        }
        selectedTags.push(tag);
        renderTags();
    }

    // Event: Enter/Koma di input tag
    tagsInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            addTag(tagsInput.value);
            tagsInput.value = '';
            tagSuggestions.innerHTML = '';
        }
    });

    // Autocomplete saat mengetik
    tagsInput.addEventListener('input', function(e) {
        const val = tagsInput.value.trim();
        if (val.length === 0) {
            tagSuggestions.innerHTML = '';
            return;
        }
        // AJAX get
        fetch(`/tags/autocomplete?query=${encodeURIComponent(val)}`)
            .then(r => r.json())
            .then(tags => {
                tagSuggestions.innerHTML = '';
                tags.forEach(tag => {
                    if (!selectedTags.includes(tag.toLowerCase())) {
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

    // Pastikan value hiddenTags selalu update saat submit
    document.getElementById('createDiscussionForm').addEventListener('submit', function(e) {
        tagsField.value = selectedTags.join(',');
    });
</script>
