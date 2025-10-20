@extends('dashboard.layouts.master')
@section('title', 'Identity Documents')

@section('content')
<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Main Content -->
    <main class="flex-1 p-4 sm:p-6 lg:p-10 flex justify-center items-start">
        <div class="bg-white rounded-3xl shadow-lg p-6 sm:p-8 max-w-3xl w-full space-y-6">
            <h2 class="text-blue-900 font-bold text-lg sm:text-xl">MY IDENTITY DOCUMENTS</h2>
            <p class="text-sm text-blue-600">Click on the document you are going to send us</p>

            <!-- Document Buttons -->
            <div class="space-y-4">
                <button onclick="openModal('european_id')" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium w-full py-3 rounded-xl transition">
                    European identity card
                </button>
                <button onclick="openModal('passport')" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium w-full py-3 rounded-xl transition">
                    Passport
                </button>
                <button onclick="openModal('license')" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium w-full py-3 rounded-xl transition">
                    Driver’s license
                </button>
            </div>

            <!-- Progress Bar -->
            <div class="pt-4">
                <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-blue-500 rounded-full" style="width: 25%;"></div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Modal for Document Upload -->
<div id="documentModal" class="fixed inset-0 z-50 hidden bg-black/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[95vh] overflow-y-auto relative p-6">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        <div id="documentStep" class="step-content">
            <h3 class="text-blue-900 font-bold text-md mb-4 uppercase">I Send My Document</h3>
            <div class="flex flex-col sm:flex-row gap-6 justify-center" id="documentFields">
                <!-- Dynamic Content will be inserted here -->
            </div>
            <div class="flex justify-end mt-6">
                <button onclick="submitDocument()" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    let currentDocType = '';

    function openModal(docType) {
        currentDocType = docType;  // Store the selected document type
        document.getElementById('documentModal').classList.remove('hidden');
        const documentFields = document.getElementById('documentFields');
        
        // Clear previous content
        documentFields.innerHTML = '';

        // Dynamically generate form fields based on document type
        if (docType === 'passport' || docType === 'license') {
            documentFields.innerHTML = `
                <div class="text-center">
                    <p class="text-sm text-gray-700 mb-1">Front</p>
                    <label class="border-2 border-blue-400 rounded-xl w-40 h-40 flex flex-col items-center justify-center cursor-pointer">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="w-10 h-10 mb-1 opacity-70" />
                        <span class="text-blue-400 text-sm">Upload photo</span>
                        <input type="file" class="hidden" id="front-${docType}">
                    </label>
                </div>
                <div class="text-center">
                    <p class="text-sm text-gray-700 mb-1">Back</p>
                    <label class="border-2 border-blue-400 rounded-xl w-40 h-40 flex flex-col items-center justify-center cursor-pointer">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="w-10 h-10 mb-1 opacity-70" />
                        <span class="text-blue-400 text-sm">Upload photo</span>
                        <input type="file" class="hidden" id="back-${docType}">
                    </label>
                </div>
            `;
        } else if (docType === 'european_id') {
            documentFields.innerHTML = `
                <div class="text-center">
                    <p class="text-sm text-gray-700 mb-1">Front</p>
                    <label class="border-2 border-blue-400 rounded-xl w-40 h-40 flex flex-col items-center justify-center cursor-pointer">
                        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="w-10 h-10 mb-1 opacity-70" />
                        <span class="text-blue-400 text-sm">Upload photo</span>
                        <input type="file" class="hidden" id="front-${docType}">
                    </label>
                </div>
            `;
        }
    }

    function closeModal() {
        document.getElementById('documentModal').classList.add('hidden');
    }

    function submitDocument() {
        const formData = new FormData();
        const frontFile = document.getElementById(`front-${currentDocType}`).files[0];
        const backFile = document.getElementById(`back-${currentDocType}`)?.files[0];

        if (!frontFile) {
            alert('Please upload the front photo!');
            return;
        }

        formData.append('document_type', currentDocType);
        formData.append('front', frontFile);
        if (backFile) formData.append('back', backFile);

        fetch('{{ route('provider.upload.document') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
              toastr.success('Document uploaded successfully!', 'Success')
                closeModal();
                setTimeout(() => {
                  window.location.href = '/account';
                }, 3000);

            } else {
              toastr.error('Failed to upload document.', 'Error')
            }
        })
        .catch(err => {
            console.error(err);
            toastr.error('Error occurred while uploading.', 'Error')
        });
    }
</script>
@endsection
