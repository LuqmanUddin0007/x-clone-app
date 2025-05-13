const token = localStorage.getItem('apiToken');
if (!token) window.location.href = '/';

const form = document.getElementById('editProfileForm');
const nameInput = document.getElementById('editName');
const emailInput = document.getElementById('editEmail');
const pictureInput = document.getElementById('editPicture');
const preview = document.getElementById('editPreview');

fetch('/api/profile', {
  headers: { Authorization: `Bearer ${token}` }
})
  .then(res => res.json())
  .then(data => {
    nameInput.value = data.user.name;
    emailInput.value = data.user.email;
    preview.src = data.user.profile_picture
      ? '/storage/' + data.user.profile_picture
      : 'https://via.placeholder.com/100';
  });

pictureInput.addEventListener('change', e => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = () => preview.src = reader.result;
    reader.readAsDataURL(file);
  }
});

form.addEventListener('submit', async e => {
  e.preventDefault();
  const formData = new FormData();
  formData.append('name', nameInput.value);
  formData.append('email', emailInput.value);
  if (pictureInput.files.length > 0) {
    formData.append('profile_picture', pictureInput.files[0]);
  }
  await fetch('/api/profile/update', {
    method: 'POST',
    headers: { Authorization: `Bearer ${token}` },
    body: formData
  });
  window.location.href = '/profile';
});