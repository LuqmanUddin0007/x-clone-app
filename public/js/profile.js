const token = localStorage.getItem('apiToken');
if (!token) window.location.href = '/';

const nameInput = document.getElementById('profileNameInput');
const emailInput = document.getElementById('profileEmailInput');
const pictureInput = document.getElementById('profilePicture');
const picturePreview = document.getElementById('profilePicturePreview');
const form = document.getElementById('updateProfileForm');

fetch('/api/profile', {
  headers: { Authorization: `Bearer ${token}` }
})
  .then(res => res.json())
  .then(data => {
    nameInput.value = data.user.name;
    emailInput.value = data.user.email;
    picturePreview.src = data.user.profile_picture ? '/storage/' + data.user.profile_picture : 'https://via.placeholder.com/100';
  });

pictureInput.addEventListener('change', e => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = () => {
      picturePreview.src = reader.result;
    };
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

  const res = await fetch('/api/profile/update', {
    method: 'POST',
    headers: { Authorization: `Bearer ${token}` },
    body: formData
  });

  if (res.ok) {
    alert('Profile updated!');
    window.location.href = '/dashboard';
  } else {
    alert('Failed to update');
  }
});
