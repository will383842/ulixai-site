	<div id="step10" class="hidden">
		<h2 class="font-bold mb-6 text-xl text-blue-900 text-center">Add your profile picture</h2>

		<div class="flex flex-col items-center mb-6">
			<!-- Profile Picture Preview -->
			<div class="w-32 h-32 rounded-full border-4 border-blue-400 flex items-center justify-center mb-4 overflow-hidden bg-gray-100 relative">
				<img id="profilePreview" src="" alt="Profile Preview" class="w-full h-full object-cover hidden">
				<canvas id="photoCanvas" class="hidden absolute w-full h-full object-cover"></canvas>
				<div id="profilePlaceholder" class="text-blue-400 text-center">
					<i class="fas fa-user text-4xl mb-2"></i>
					<p class="text-sm">No image</p>
				</div>
			</div>

			<!-- Upload & Camera Buttons -->
			<div class="flex gap-4">
				<label for="profileUpload" class="bg-blue-600 text-white px-6 py-2 rounded-lg cursor-pointer hover:bg-blue-700 transition-colors">
					<i class="fas fa-camera mr-2"></i>Choose Photo
				</label>
				<button onclick="openCamera()" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
					<i class="fas fa-video mr-2"></i>Take Photo
				</button>
			</div>
			<input type="file" id="profileUpload" accept="image/*" class="hidden">

			<!-- Camera Stream -->
			<div id="cameraSection" class="hidden mt-4 text-center">
				<video id="videoStream" autoplay class="w-32 h-32 rounded-full border-4 border-green-400 mx-auto mb-2"></video>
				<button onclick="capturePhoto()" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">Capture</button>
			</div>

			<!-- Note: Not obligatory but better for you -->
				<div class="w-full mb-4 rounded-lg bg-yellow-100 border-l-4 border-yellow-400 py-2 px-4 text-center">
					<span class="text-brown-700" style="color:#8B5C00;font-weight:500;"><strong>Verified photos</strong>  These photos are very important because they are visible to members <br>
					<strong>Conditions to follow : </strong> <br>
					Alone in the photo <br>
					No filter <br>
					face uncovered <br>
					face photo only 
				</span>
				</div>
		</div>

		<!-- Navigation -->
		<div class="flex justify-between items-center">
			<button id="backToStep9" class="text-blue-700 hover:underline">Back</button>
			<button id="nextStep10" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-full">Next</button>
		</div>
	</div>

    <script>
  const profileUpload = document.getElementById('profileUpload');
  const profilePreview = document.getElementById('profilePreview');
  const profilePlaceholder = document.getElementById('profilePlaceholder');
  const photoCanvas = document.getElementById('photoCanvas');
  const videoStream = document.getElementById('videoStream');
  const cameraSection = document.getElementById('cameraSection');

  profileUpload.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (event) {
      profilePreview.src = event.target.result;
      profilePreview.classList.remove('hidden');
      photoCanvas.classList.add('hidden');
      profilePlaceholder.classList.add('hidden');
    };
    reader.readAsDataURL(file);
  });

  function openCamera() {
    cameraSection.classList.remove('hidden');
    navigator.mediaDevices.getUserMedia({ video: true })
      .then((stream) => {
        videoStream.srcObject = stream;
      })
      .catch((err) => {
        alert('Unable to access camera');
        console.error(err);
      });
  }

  function capturePhoto() {
    const context = photoCanvas.getContext('2d');
    const video = videoStream;
    photoCanvas.width = video.videoWidth;
    photoCanvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

    photoCanvas.classList.remove('hidden');
    profilePreview.classList.add('hidden');
    profilePlaceholder.classList.add('hidden');

    // Stop the video stream
    const stream = video.srcObject;
    const tracks = stream.getTracks();
    tracks.forEach(track => track.stop());
    video.srcObject = null;
    cameraSection.classList.add('hidden');
  }
</script>